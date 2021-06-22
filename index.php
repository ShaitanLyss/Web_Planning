<?php
session_start();

$emot_twitch = ' <:custom_emoji_name:434370263518412820> ';
$emot_roll20 = ' <:custom_emoji_name:493783713243725844> ';
$emot_discord = ' <:custom_emoji_name:434370093627998208> ';
$emot_autre = ' :space_invader: ';


?>


<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <title> Création partie </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dark.css">
    <link rel="stylesheet" href="css/nouislider.css">
    <link type="text/css" rel="stylesheet" href="css/tail.datetime-default.css">
    <link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/457233258661281793/458727800048713728/dae-cmd.png">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" ></script>
    <script src="js/script.js"></script>
    <script src="js/nouislider.js"></script>
    <script src="js/tail.datetime.js"></script>
    <script src="js/tail.datetime-fr.js"></script>
</head>
<body onload="feed();" id="body">
    <section>
        <!-- Button for changing color mode -->
        <article>
            <div class="form-group row">
                <label id="mode" class="col-sm-5 col-form-label">Sombre 🌙</label>
                <div class="col-sm-3">
                    <label class="switch">
                    <input type="checkbox" onclick="chgMode()">
                    <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </article>

        <form method=post action="cgi-bin/create_post.py" id="URform">
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">Nombre de joueurs</label>
                <div class="col-sm-7">
                    <div id="range" style="color:black !important" aria-describedby="nbTxt">
                            <script>
                                var range = document.getElementById('range');

                                noUiSlider.create(range, {
                                    start: [1, 5],
                                    step:1,
                                    range: {
                                        'min': 0,
                                        'max': 8
                                    },
                                    padding:[1,1],
                                    connect:true

                                });
                            </script>
                        </div>
                </div>
            </div>
            <small id="nbTxt" class="form-text text-muted">Moins de 25 joueurs.</small>

            <div class="form-group row">
                <label class="col-sm-5 col-form-label"> Type </label>
                <div class="col-sm-7">
                    <select class="uk-select" name="jdr_type" id="type" required>
                        <option value="" disabled hidden selected></option> <!--Cette "option" force l'utilisateur à sélectionner une option-->
                        <option> Initiation </option>
                        <option> One shoot </option>
                        <option> Scénario </option>
                        <option> Campagne </option>
                    </select>   
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-5 col-form-label">Date 📅 et heure ⌚</label>
                <div class="col-sm-7">
                    <input id="date" name="jdr_date" type="text" class="tail-datetime-field" required style="border-radius: 0px !important; height:40px; width:100%"/>

                        <script type="text/javascript">
                            document.addEventListener("DOMContentLoaded", function(){
                                tail.DateTime(".tail-datetime-field", { dateFormat:"dd/mm/YYYY",
                                    timeFormat:"HH:ii",
                                    locale:"fr",
                                    timeSeconds:false,
                                    viewDecades:false,
                                    dateStart:new Date().toISOString().slice(0, 10)});
                            });
                        </script> <!--L'attribut required force un champ à être rempli-->
                    
                </div>
            </div>
            
            <!-- Nom campagne -->
            <div class="form-group row">
                <label class="col-sm-5 col-form-label"> Titre : </label>
                <div class="col-sm-7">
                    <input type="text" class="uk-input" placeholder="nom de la campagne ou du scenario" name="jdr_title" id="titre" max="50"> 									
                </div>
            </div>

            <!-- Durée -->
            <div class="form-group row">
                <label class="col-sm-5 col-form-label"> Durée ⏱ </label>
                <div class="col-sm-7">
                    <select class="uk-select" name="jdr_length" id="selectorTime" required>
                            <option value="" disabled hidden selected></option>

                    </select>									
                </div>
            </div>
            
            <div id="alert"></div>
            
            <!-- Connexion discord -->
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">Maître du jeu 👑</label>
                <div class="col-sm-7">
                    <input type="button" value="Connect">
                <!--?php
                    if(isset($_SESSION['access_token'])){
                                echo "<img src='$avatar_url'/>";
                                echo $pseudo;
                    }else{ 
                
                        echo '<input type="button" value="Connect" style="border-radius:10px;" onclick="window.location.href='. "" . '?action=login/>';
                    }
                ?>-->
                </div>
            </div>
            
            <!-- Sélection du système jdr -->
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">JDR 🎲</label>
                <div class="col-sm-7">
                    <select class="uk-select" name ="jdr_system" id="system">
                        <option hidden disabled selected value="">Liste des JdR proposés</option>
                        <?php
                            # Generates all the options from an xml file
                            $systems = simplexml_load_file("data/jdr_systems.xml");
                            foreach ($systems as $optgroup) {
                                echo '<optgroup label ="' . $optgroup['label'] .'">';
                                foreach ($optgroup as $option) {
                                    echo '<option>' . $option . '</option>'; 
                                }
                                echo '</optgroup>';
                            }
                        ?>         
                    </select>			
				</div>
			</div>
            
            <!-- JDR Hors liste -->
            <div class="form-group row">
                <label class="col-sm-5 col-form-label"> JDR Hors liste 🎲</label>
                <div class="col-sm-7">
                    <input type="text" class="uk-input" placeholder="nom du jeu si hors liste" name="jdr_system_other" id="system2" max="37"> 									
                </div>
            </div>
            
            <!-- Outils -->
            <div class="form-group row">
                <label class="col-sm-5 col-form-label"> Outils 🛠 </label>
                <div class="col-sm-7">
                    <label><input class="uk-checkbox" name="platform" type="checkbox" value="<:custom_emoji_name:434370263518412820>"> Partie diffusée sur Twitch <img src="img/iconTwitch.png"></label><br>
                    <label><input class="uk-checkbox" name="platform" type="checkbox" value="<:custom_emoji_name:493783713243725844>"> Partie jouée sur Roll20 <img src="img/iconRoll20.png"></label><br>
                    <label><input class="uk-checkbox" name="platform" type="checkbox" value="<:custom_emoji_name:434370093627998208>" checked> Partie jouée sur Discord <img src="img/iconDiscord.png"></label><br>
                    <label><input class="uk-checkbox" name="platform" type="checkbox" value=":space_invader:"> Partie jouée sur Autre <img src="img/iconAutre.png"></label><br>	
                </div>
            </div>

            <!-- PJ mineurs -->
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">PJ mineur 👶</label>
                <div class="col-sm-7">
                    <label><input class="uk-radio" type="radio" name="jdr_pj"  value="0" checked> &nbspOui </label>
                    <label><input class="uk-radio" type="radio" name="jdr_pj"  value="1"> &nbspNon </label>
                    <label><input class="uk-radio" type="radio" name="jdr_pj"  value="2"> &nbspPréférable </label>
                    <label><input class="uk-radio" type="radio" name="jdr_pj"  value="3"> &nbspNon recommandé</label>	
                </div>
            </div>
            
            <!-- Description -->
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">Description (optionnelle) 📄</label>
                <div class="col-sm-7">
                    <textarea class="uk-textarea"  maxlength="500" rows="5" name ="jdr_details" id="desc" oninput="save()"></textarea>	
                </div>
            </div>
            
            <!-- Bouton reset -->
            <div class="form-group row">
                <label class="col-sm-5 col-form-label"></label>
                <div class="col-sm-7">
                    <button type="reset" class="uk-button uk-button-default" onclick="document.getElementById('range').noUiSlider.set([4,15]);">Réinitialiser 🔄</button>	
                </div>
            </div>

            <!-- Github -->
            <div class="form-group row">
                <label class="col-sm-5 col-form-label"></label>
                <div class="col-sm-7">
                    <button type="submit" class="uk-button uk-button-default" style="background-color:#169719;" name="submit" id="submit" onclick="Alert()/*UIkit.notification({ message: 'Votre formulaire a été pris en compte',status: 'success',timeout: 5000});*/"><b>Valider ✔</b></button>	
                </div>
            </div>

            <span style="text-align:center;margin-top:5vh;font-size:14px;color:#990000;font-family:mono;"><b>Attention cette outils est en beta-test</b>, merci de copier collé votre description avant de poster<br><a href="https://github.com/Bot-a-JDR/PageJDR" uk-icon="icon: github; ratio:1.5">GitHub</a></span>
            <div class="col-1 col-sm-1 col-md-1 col-lg-2 col-xl-3"></div>
        </form>
    </section>
    <script src="js/record_form.js"></script>
</body>
</html>