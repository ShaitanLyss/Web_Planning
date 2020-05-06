<?php
if(isset($_GET['token'])){
//Config
$url = "https://discordapp.com/api/webhooks/xxx";
$seed = "";
$logo = "https://cdn.discordapp.com/attachments/688340383117082733/688732386820620351/UR-logo2.png";
//mettre les emot à '' pour désactiver
$emot_twitch = ' <:custom_emoji_name:434370263518412820> ';
$emot_roll20 = ' <:custom_emoji_name:493783713243725844> ';
$emot_discord = ' <:custom_emoji_name:434370093627998208> ';
$emot_teamspeak = ' :speaking_head: ';
$emot_autre = ' :space_invader: ';

$token= $_GET['token'];
//print_r($_POST);
if(isset($_POST['submit'])){

    $date = date("d");
    $newtoken = $_POST['mj'] . $seed . $date;
    //echo "<br/>";
    $crypted =md5($newtoken);
    //echo $crypted;
    //echo "<br/>";
    //echo $token;
    //echo "<br/>";
    if($token === $crypted){
		//Vérification du formulaire
		$validation_Formulaire=1;
		
		if($_POST['system']!=""){
			$system=$_POST['system'];
		}
		else{
			$validation_Formulaire=0;
			$messageErreur="Veuillez sélectionner un jeu dans le menu déroulant ou indiquer un jeu hors liste";
		}
		
		if($_POST['titre']=="")
		{
			$validation_Formulaire=0;
			$messageErreur="Veuillez indiquez un titre pour votre partie";
		}
		
		//soumission du formulaire
		if($validation_Formulaire)
		{
			$content = '**Type** ' .$_POST['type']. '\n'.
				':calendar:  **Date** Le ' . $_POST['date']. '\n' .
				//':clock2:  **Heure** A partir de ' . $_POST['selectorHour'] . '\n' .
				':clapper:  **Titre** ' . $_POST['titre'] . '\n' .
				':timer:  **Durée moyenne du scénario ** ' . $_POST['selectorTime'] . '\n' .
				':crown:  **MJ** @' . $_POST['mj'] . '\n' .
				':people_holding_hands:  **Joueurs** ' . $_POST['joueur'] . '\n' .
				'<:custom_emoji_name:434358038342664194>  **JDR** ' . $system . '\n' .
				':baby:  **PJ Mineur** ' . $_POST['pj'] . '\n';
			$plateform="";
			if ($_POST['diffusion1'] == "twitch" && $emot_twitch != '') {
				$plateform .= $emot_twitch;
			}
			if ($_POST['diffusion2'] == "roll20" && $emot_roll20 != ''){
				$plateform .= $emot_roll20;
			}
			if ($_POST['diffusion3'] == "discord" && $emot_discord != ''){
				$plateform .= $emot_discord;
			}
			if ($_POST['diffusion4'] == "teamspeak" && $emot_teamspeak != ''){
				$plateform .= $emot_teamspeak;
			}
			if ($_POST['diffusion5'] == "autre" && $emot_autre != ''){
				$plateform .= $emot_autre;
			}
			if ($plateform !== ""){
				$content .= ':star2: **Plateforme** ' .$plateform. '\n';

			}
			if ($_POST['desc'] !== ""){
				$desc=addcslashes($_POST['desc'],"\n\r");
				$desc=preg_replace("/@/","",$desc);
				$content .= ':grey_question:  **Détails** \n' . $desc . '\n';
			}
			$content .= '**Participe** :white_check_mark: / **Ne participe pas** :x:';
			$payload = '{
					"embeds":[
					{
						"thumbnail":
						{
							"url":"'.$logo.'"
						},
							"title":"Nouveau jeu de rôle !",
							"description":"'.$content.'",
							"color": "11053224"
					}
					]
				}';
			//$data = array('embeds' => $content );
			$curl = curl_init("$url");
			//echo "<br>".$content;
			//echo "<br>".$payload;
			//print_r($payload);
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
			echo "<BR> Votre partie a bien été envoyée sur le serveur discord";
		}
		else{
			echo $messageErreur;
		}
    }else{
        echo "Votre pseudo est incorrecte";
    }

}

?>

    <!DOCTYPE html>
    <html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Le formulaire</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-tokenfield.min.css">		
        <link rel="stylesheet" href="css/nouislider.css">
        <link type="text/css" rel="stylesheet" href="css/tail.datetime-default.css">
        <link rel="stylesheet" href="css/tail.datetime-harx-dark.min.css">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/dark-hive/jquery-ui.css">
		<link rel="stylesheet" href="css/dark.css">
        <link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/457233258661281793/458727800048713728/dae-cmd.png">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js" ></script>
		<script src="js/bootstrap-tokenfield.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/nouislider.js"></script>
        <script src="js/tail.datetime.js"></script>
        <script src="js/tail.datetime-fr.js"></script>
		

    </head>
    <body onload="feed();" id="body"> <!--Quand la page se charge, appeler feed()-->
		<div class="container-fluid">
		<div class="row">
			<div class="col-1 col-sm-1 col-md-1 col-lg-2 col-xl-3"></div>
			<div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-6 box">			            
						<form method=post action=# id="URform">
							<div class="form-group row">
								<label id="mode" class="col-sm-5 col-form-label">Sombre 🌙</label>
								<div class="col-sm-3">
									<label class="switch">
									<input type="checkbox" onclick="chgMode()">
									<span class="slider round"></span>
									</label>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-5 col-form-label">Nombre de joueurs</label>
								<div class="col-sm-7">
									<input type="hidden" name="joueur" id="joueur" >
									<div id="range" style="color:black !important" aria-describedby="nbTxt">
											<script>
												var range = document.getElementById('range');

												noUiSlider.create(range, {
													start: [1, 5],
													step:1,
													range: {
														'min': 0,
														'max': 16
													},
													padding:[1,1],
													connect:true
												});
											</script>
										</div>
								</div>
								<small id="nbTxt" class="form-text text-muted">Moins de 15 joueurs.</small>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-5 col-form-label">Type</label>
								<div class="col-sm-7">
									<select class="uk-select" name="type" id="type" required>
										<option value="" disabled hidden selected></option> <!--Cette "option" force l'utilisateur à sélectionner une option-->
										<option>Initiation</option>
										<option>One shoot</option>
										<option>Scénario</option>
										<option>Campagne</option>
									</select>
									
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-5 col-form-label">Date 📅 et heure ⌚</label>
								<div class="col-sm-7">
									<input id="date" name="date" type="text" class="tail-datetime-field" value="<?= date("d/m/Y")." 21h00" ?>" required style="border-radius: 0px !important; height:40px; width:100%"/>

										<script type="text/javascript">
											document.addEventListener("DOMContentLoaded", function(){
												tail.DateTime(".tail-datetime-field", { dateFormat:"dd/mm/YYYY",
													timeFormat:"HHhii",
													timeHours:21,
													timeMinutes:0,
													locale:"fr",
													timeSeconds:false,
													viewDecades:false,
													dateStart:new Date().toISOString().slice(0, 10)}).selectTime(21, 0, 0);
											});
										</script> <!--L'attribut required force un champ à être rempli-->
									
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-5 col-form-label">Titre :</label>
								<div class="col-sm-7">
									<input type="text" class="uk-input" placeholder="nom de la campagne ou du scenario" name="titre" id="titre" max="50"> 									
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-5 col-form-label">Durée ⏱</label>
								<div class="col-sm-7">
									<select class="uk-select" name="selectorTime" id="selectorTime" required>
											<option value="" disabled hidden selected></option>

									</select>									
								</div>
							</div>
							
							<div id="alert"></div>
							
							<div class="form-group row">
								<label class="col-sm-5 col-form-label">Maître du jeu 👑</label>
								<div class="col-sm-7">
									<input type="text" class="uk-input" placeholder="ABCD#1234" name="mj" id="mj" max="37" pattern="^[^@#]{2,32}#[0-9]{4}" required> <!--Ici, en plus de se servir de required, on utlise une fonction pour savoir si le pseudo entré peut correspondre à un pseudo discord-->									
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-5 col-form-label">JDR 🎲</label>
								<div class="col-sm-7">
									<input type="text" class="form-control uk-input" name ="system" id="system" placeholder="Entrez ce que vous cherchez" value="" required/>
									
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-5 col-form-label">Outils 🛠</label>
								<div class="col-sm-7">
									<?php if ($emot_twitch != ''): ?>
										<label><input class="uk-checkbox" name="diffusion1" type="checkbox" value="twitch"> Partie diffusée sur Twitch <img src="img/iconTwitch.png"></label><br>
									<?php endif ?>
									<?php if ($emot_roll20 != ''): ?>
										<label><input class="uk-checkbox" name="diffusion2" type="checkbox" value="roll20"> Partie jouée sur Roll20 <img src="img/iconRoll20.png"></label><br>
									<?php endif ?>
									<?php if ($emot_discord != ''): ?>
										<label><input class="uk-checkbox" name="diffusion3" type="checkbox" value="discord"> Partie jouée sur Discord <img src="img/iconDiscord.png"></label><br>
									<?php endif ?>
									<?php if ($emot_teamspeak != ''): ?>
										<label><input class="uk-checkbox" name="diffusion4" type="checkbox" value="teamspeak"> Partie jouée sur Teamspeak <img src="img/iconTeamspeak.png"></label><br>
									<?php endif ?>
									<?php if ($emot_autre != ''): ?>
										<label><input class="uk-checkbox" name="diffusion5" type="checkbox" value="autre"> Partie jouée sur Autre <img src="img/iconAutre.png"></label><br>	
									<?php endif ?>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-5 col-form-label">PJ mineur 👶</label>
								<div class="col-sm-7">
									<label><input class="uk-radio" type="radio" name="pj" id="pj" value="Oui">&nbspOui</label>
									<label><input class="uk-radio" type="radio" name="pj" id="pj" value="Non préférable">&nbspNon préférable</label>
									<label><input class="uk-radio" type="radio" name="pj" id="pj" value="Non recommandé">&nbspNon recommandé</label>	
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-5 col-form-label">Description (optionnelle) 📄</label>
								<div class="col-sm-7">
									<textarea class="uk-textarea"  maxlength="500" rows="5" name ="desc" id="desc" oninput="save()"></textarea>	
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-5 col-form-label"></label>
								<div class="col-sm-7">
									<button type="reset" class="uk-button uk-button-default" onclick="document.getElementById('range').noUiSlider.set([4,15]);">Réinitialiser 🔄</button>	
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-5 col-form-label"></label>
								<div class="col-sm-7">
									<button type="submit" class="uk-button uk-button-default" name="submit" id="submit" onclick="Alert()/*UIkit.notification({ message: 'Votre formulaire a été pris en compte',status: 'success',timeout: 5000});*/">Valider ✔</button>	
								</div>
							</div>

							<span style="text-align:center;margin-top:5vh;font-size:12px">Attention cet outil est en beta-test<br><a href="https://github.com/Bot-a-JDR/PageJDR" uk-icon="icon: github; ratio:1.5">GitHub</a></span>
						</form>
			</div>
			<div class="col-1 col-sm-1 col-md-1 col-lg-2 col-xl-3"></div>
		</div>
		</div>
    </body>
    </html>
    <?php
}else{
    echo 'ERREUR : veuillez venir accompagné d\'un token s\'il vous plaît!';
}
?>