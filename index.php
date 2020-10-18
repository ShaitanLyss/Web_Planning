<?php
session_start();

if(!file_exists("config.php")){
	copy("config.php.temp", "config.php");
}
include("config.php");

$discordOAuthAuthorizeURL = 'https://discordapp.com/api/oauth2/authorize?'.http_build_query([
	'response_type' => 'code',
	'client_id' => CLIENT_ID,
	'redirect_uri' => REDIRECT_URI,
	'scope' => 'identify',
]);

if (isset($_GET['code'])) {
	$post = array(
		"grant_type" => "authorization_code",
		"client_id" => CLIENT_ID,
		"client_secret" => CLIENT_SECRET,
		"redirect_uri" => REDIRECT_URI,
		"code" => $_GET['code']
	);
	$ch = curl_init("https://discord.com/api/oauth2/token");
	curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

	$response = json_decode(curl_exec($ch));
	print_r($response);
	$token = $response->access_token;
	$_SESSION['access_token'] = $token;
	header('Location: ' . $_SERVER['PHP_SELF']);
}

$discordUsername = null;
$discordImgSrc = null;
if (isset($_SESSION['access_token'])) {
	$header[] = 'Authorization: Bearer ' . $_SESSION['access_token'];
	$ch = curl_init("https://discord.com/api/users/@me");
	curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	$response = json_decode(curl_exec($ch));
	$discordUsername = $response->username . '#' . $response->discriminator;
	$discordImgSrc = 'https://cdn.discordapp.com/avatars/' . $response->id . '/' . $response->avatar . '.png' . '?size=32';
}

//Config
//mettre les emot à '' pour désactiver
$emot_twitch = '<:custom_emoji_name:434370263518412820>';
$emot_roll20 = '<:custom_emoji_name:493783713243725844>';
$emot_discord = '<:custom_emoji_name:434370093627998208>';
$emot_autre = ':space_invader:';

if (!empty($_POST['game-type'])) {
	$plateform = "";
	$content = '**Type** ' .$_POST['type']. '\n'.
		':calendar:  **Date** Le ' . $_POST['date']. '\n' .
		//':clock2:  **Heure** A partir de ' . $_POST['selectorHour'] . '\n' .
		':clapper:  **Titre** ' . $_POST['titre'] . '\n' .
		':timer:  **Durée moyenne du scénario ** ' . $_POST['selectorTime'] . '\n' .
		':crown:  **MJ** @' . $pseudo . '\n' .
		'<:custom_emoji_name:434358038342664194>  **Système** ' . $system . '\n' .
		':baby:  **PJ Mineur** ' . $_POST['pj'] . '\n';
	if (isset($_POST['diffusion1']) && $emot_twitch != '') {
		$plateform .= $emot_twitch;
	}
	if (isset($_POST['diffusion2']) && $emot_roll20 != ''){
		$plateform .= $emot_roll20;
	}
	if (isset($_POST['diffusion3']) && $emot_discord != ''){
		$plateform .= $emot_discord;
	}
	if (isset($_POST['diffusion5']) && $emot_autre != ''){
		$plateform .= $emot_autre;
	}
	if ($plateform !== ""){
		$content .= ':star2: **Plateforme** ' .$plateform. '\n';

	}
	if ($_POST['desc'] !== ""){
		$desc=addcslashes($_POST['desc'],"\n\r");
		$desc=preg_replace("/@/","",$desc);
		$content .= ':grey_question:  **Détails**' . $desc . '\n';
	}
	$content .= '**Participe** :white_check_mark: / **Ne participe pas** :x:';
	$payload = '{
			"embeds":[
			{
				"thumbnail":
				{
					"url":"https://cdn.discordapp.com/attachments/688340383117082733/688732386820620351/UR-logo2.png"
				},
					"title":"Nouveau jeu de rôle !",
					"description":"'.$content.'",
					"color": "11053224"
			}
			]
		}';
	//$data = array('embeds' => $content );
	$curl = curl_init(WEBHOOK_URI);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('content-type: application/json'));
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
	//préparation des data en json
	curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
	//désasctivation du ssl
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	//récupération du contenu pour debug
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($curl);
	if($result === FALSE) {
		echo "ERREUR : <br>";
		die(curl_error($curl));
	}
	//echo $result;
	echo "<br>Votre partie a bien été envoyée sur le serveur discord";
}

$gameSystemGroups = yaml_parse_file('data/game-systems.yaml');
require 'templates/form-page.php';
