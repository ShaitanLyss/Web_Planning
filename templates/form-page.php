<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css">
		<title>Nouveau JdR - Union Rôlistes</title>
	</head>
	<body>
		<header>
			<h1>Nouveau JdR &#127922; Union Rôlistes</h1>
		</header>
		<section>
			<label>
				<div class="form-row-label">Mode sombre &#127769;</div>
				<input type="checkbox" id="dark-mode-toggle" name="dark-mode-toggle" checked>
			</label>
			<form method="post" action="#" id="new-game-form">
				<div class="form-row">
					<div class="form-row-label">Nombre de joueurs</div>
					<div class="form-row-content">
						<label>min
							<input type="number" min="0" max="8" step="1" name="min-players" value="1" required>
						</label>
						<label>max
							<input type="number" min="0" max="8" step="1" name="max-players" value="5" required>
						</label>
					</div>
				</div>
				<label>
					<div class="form-row-label">Type</div>
					<select name="game-type" required>
						<option value="null" disabled hidden selected>type de partie</option>
						<option value="initiation">initiation</option>
						<option value="one-shot">one shot</option>
						<option value="scenario">scénario</option>
						<option value="campaign">campagne</option>
					</select>
				</label>
				<div class="form-row">
					<div class="form-row-label">Date &#128198; et heure &#128340;</div>
					<div class="form-row-content">
						<label>le
							<input type="date" name="date" step="1" id="date-input" required>
						</label>
						<label>à
							<input type="time" name="time" step="60" id="time-input" required>
						</label>
					</div>
				</div>
				<label>
					<div class="form-row-label">Titre</div>
					<input type="text" maxlength="80" name="game-title" placeholder="nom de votre campagne / scénario" required>
				</label>
				<label>
					<div class="form-row-label">Durée estimée &#9201;</div>
					<select name="estimated-duration" required>
						<option value="null" disabled hidden selected>-h--</option>
						<option value="30">0h30</option>
						<option value="60">1h00</option>
						<option value="90">1h30</option>
						<option value="120">2h00</option>
						<option value="150">2h30</option>
						<option value="180">3h00</option>
						<option value="210">3h30</option>
						<option value="240">4h00</option>
						<option value="270">4h30</option>
						<option value="300">5h00</option>
						<option value="330">5h30</option>
					</select>
				</label>
				<label>
					<div class="form-row-label">Maître du Jeu &#128081;</div>
					<div class="form-row-content">
						<span id="discord-user"></span>
						<button type="button" id="discord-connect-btn">connexion Discord</button>
					</div>
				</label>
				<div class="form-row">
					<div class="form-row-label">Jeu de rôle utilisé &#127922;</div>
					<div class="form-row-content">
						<select name="game-system" id="game-system-select">
							<option value="null" disabled hidden selected>système de jeu</option>
							<?php foreach ($gameSystemGroups as $groupName => $groupContent): ?>
							<optgroup label="<?= $groupName ?>">
								<?php foreach ($groupContent as $systemName): ?>
								<option><?= $systemName ?></option>
								<?php endforeach; ?>
							</optgroup>
							<?php endforeach; ?>
						</select>
						<label>
							<input type="checkbox" name="custom-system-toggle" id="custom-system-toggle">
							autre
						</label>
						<input type="text" name="custom-system-name" id="custom-system-name" placeholder="nom du système">
					</div>
				</div>
				<div class="form-row">
					<div class="form-row-label">Outils &#128736;</div>
					<div class="form-row-content">
						<label>
							<input type="checkbox" name="tools-twitch">
							<img alt="twitch logo" src="img/iconTwitch.png">
							Partie diffusée sur Twitch
						</label>
						<br>
						<label>
							<input type="checkbox" name="tools-roll20">
							<img alt="Roll20 logo" src="img/iconRoll20.png">
							Partie jouée sur Roll20
						</label>
						<br>
						<label>
							<input type="checkbox" name="tools-discord">
							<img alt="Discord logo" src="img/iconDiscord.png">
							Partie jouée sur Discord
						</label>
						<br>
						<label>
							<input type="checkbox" name="tools-other">
							<img alt="alien logo" src="img/iconAutre.png">
							Autre plateforme
						</label>
					</div>
				</div>
				<div class="form-row">
					<div class="form-row-label">Joueurs mineurs (-18) acceptés &#128118;</div>
					<div class="form-row-content">
						<label>
							<input type="radio" name="young-players-allowed" value="yes" checked required>
							oui
						</label>
						<br>
						<label>
							<input type="radio" name="young-players-allowed" value="discouraged">
							non préférable
						</label>
						<br>
						<label>
							<input type="radio" name="young-players-allowed" value="no">
							non recommandé
						</label>
					</div>
				</div>
				<label>
					<div class="form-row-label">Description (facultative) &#128240;</div>
					<textarea name="game-description" rows="5" maxlength="500" placeholder="Dans cette fabuleuse aventure nous allons… (500 caractères max)"></textarea>
				</label>
				<button type="reset">Réinitialiser</button>
				<button type="submit">Valider</button>
			</form>
		</section>
		<footer>
			<p>
				<strong>Attention, cet outil est encore en test</strong>, nous vous recommandons de copier-coller votre description de partie avant de valider.
				<br>
				<a href="https://github.com/Bevelopment/PageJDR">dépôt GitHub</a>
			</p>
		</footer>
		<iframe id="discord-connect-iframe" src="<?= $discordOAuthAuthorizeURL ?>"></iframe>
		<script src="js/front.js"></script>
	</body>
</html>
