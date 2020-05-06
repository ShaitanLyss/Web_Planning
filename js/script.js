function save()
{
	localStorage.setItem("text", document.getElementById("desc").value); //Permet de stocker le contenu de la description
}

function Alert()
{
	document.getElementById("alert").innerHTML="<div class='uk-alert-success' uk-alert > <a class='uk-alert-close' uk-close ></a> <p>Votre formulaire a bien été pris en compte.</p></div>"
}
function feed()//Cette fonction permet de remplir les deux select, allégeant le code HTML
{
	range.noUiSlider.on("update", function(values, handle){
		txt=document.getElementById("nbTxt");
		console.log(values);
		values[0] = parseInt(values[0], 10);
		values[1] = parseInt(values[1], 10);
		console.log(values);
		if (values[0]==values[1])
		{
			txt.innerHTML=values[0] + " joueurs";
		}
		else if (values[0]==1)
		{
			txt.innerHTML="Moins de " +values[1]+" joueurs"
		}
		else{
			txt.innerHTML="Entre "+values[0]+" et "+values[1]+" joueurs"
		}
		$('#joueur').val(txt.innerHTML);
	})
	try
	{
		document.getElementById("desc").value = localStorage.getItem("text");
	}
	catch(e)
	{
	}
	console.log("Valeur : ", document.cookie);
	time = document.getElementById("selectorTime");
	t = 0;
	while (t <= 300)
	{
		t = t + 30;
		m = (t % 60).toString();
		h = Math.floor(t / 60).toString() + "h";
		if (h == "0h")
		{
			h = "";
			m = m + "m";
		}
		if (m == "0")
		{
			m = "";
		}
		var opt = document.createElement("option");
		opt.innerHTML = h + m;
		time.appendChild(opt);
	}
	//return chgColor("white")

}

function chgMode()
{
	if (document.getElementById("mode").innerHTML == "Clair ☀")
	{
		document.getElementById("mode").innerHTML = "Sombre 🌙";
		/*var oldlink1 = document.getElementsByTagName("link").item(1);
    	var newlink = document.createElement("link");
    	newlink.setAttribute("rel", "stylesheet");
    	newlink.setAttribute("href", "css/dark.css");
    	document.getElementsByTagName("head").item(0).replaceChild(newlink, oldlink1);
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/dark-hive/jquery-ui.css">
		*/
		var oldlink1 = document.getElementsByTagName("link").item(6);
		var oldlink2 = document.getElementsByTagName("link").item(4);
		var oldlink3 = document.getElementsByTagName("link").item(5);
		var newlink1 =  document.createElement("link");
		var newlink2 =  document.createElement("link");
		var newlink3 =  document.createElement("link");
		newlink1.setAttribute("rel", "stylesheet");
		newlink1.setAttribute("href", "css/dark.css");
		newlink2.setAttribute("rel", "stylesheet");
		newlink2.setAttribute("href", "css/tail.datetime-harx-dark.min.css");
		newlink3.setAttribute("rel", "stylesheet");
		newlink3.setAttribute("href", "https://code.jquery.com/ui/1.12.1/themes/dark-hive/jquery-ui.css");
		document.getElementsByTagName("head").item(0).replaceChild(newlink1, oldlink1);
		document.getElementsByTagName("head").item(0).replaceChild(newlink2, oldlink2);
		document.getElementsByTagName("head").item(0).replaceChild(newlink3, oldlink3);



	}
	else
	{
		document.getElementById("mode").innerHTML = "Clair ☀";
		var oldlink1 = document.getElementsByTagName("link").item(6);
		var oldlink2 = document.getElementsByTagName("link").item(4);
		var oldlink3 = document.getElementsByTagName("link").item(5);
		var newlink1 =  document.createElement("link");
		var newlink2 =  document.createElement("link");
		var newlink3 =  document.createElement("link");
		newlink1.setAttribute("rel", "stylesheet");
		newlink1.setAttribute("href", "css/light.css");
		newlink2.setAttribute("rel", "stylesheet");
		newlink2.setAttribute("href", "css/tail.datetime-harx-light.min.css");
		newlink3.setAttribute("rel", "stylesheet");
		newlink3.setAttribute("href", "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");
		document.getElementsByTagName("head").item(0).replaceChild(newlink1, oldlink1);
		document.getElementsByTagName("head").item(0).replaceChild(newlink2, oldlink2);
		document.getElementsByTagName("head").item(0).replaceChild(newlink3, oldlink3);

		
	}
}

												
//alt+0160												
$(document).ready(function() {   
	$('#system').tokenfield({
	  autocomplete: {
		source: [
					{ value: "Advanced dungeons and dragons", label: "Advanced dungeons and dragons                               [Ad&d donjons et dragons Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Agone",                         label: "Agone                                                       [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Anima",                         label: "Anima                                                       [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Antika",                        label: "Antika                                                      [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "BloodLust",                     label: "BloodLust                                                   [Dark, Horreur]" },
					{ value: "Brigandyne",                    label: "Brigandyne                                                  [Générique]" },
					{ value: "Cats",                          label: "Cats                                                        [Contemporain]" },
					{ value: "Chronique des Féals",           label: "Chronique des Féals                                         [Dark, Horreur]" },
					{ value: "Chronique oubliée",             label: "Chronique oubliée                                           [Donjons et dragons, Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Ciels Cuivre",                  label: "Ciels Cuivre                                                [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "COPS",                          label: "COPS                                                        [Futuriste, post apo, SF]" },
					{ value: "Cthulhu",                       label: "Cthulhu                                                     [Dark, Horreur]" },
					{ value: "Cyberpunk",                     label: "Cyberpunk                                                   [Futuriste, post apo, SF]" },
					{ value: "D-Critique",                    label: "D-Critique                                                  [Générique]" },
					{ value: "Donjons et Dragons",            label: "Donjons et Dragons                                          [d&d, donjons et dragons, Médiéval Fantastique, Epique, Medfan]" },
					{ value: "DeadLands",                     label: "DeadLands                                                   [Western]" },
					{ value: "Défis Fantastiques",            label: "Défis Fantastiques                                          [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Dégénésis",                     label: "Dégénésis                                                   [Futuriste, post apo, SF]" },
					{ value: "DiscWorld",                     label: "DiscWorld                                                   [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "DragonAge",                     label: "DragonAge                                                   [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Eclipse phase",                 label: "Eclipse phase                                               [Futuriste post apo SF]" },
					{ value: "FallOut",                       label: "FallOut                                                     [Futuriste post apo SF]" },
					{ value: "gobelin qui s'en dédit",        label: "gobelin qui s'en dédit                                      [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "GURPS",                         label: "GURPS                                                       [Générique]" },
					{ value: "GoT",                           label: "GoT                                                         [Game of throne le trône de fer Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Heroes (super et mutant Xmen)", label: "Heroes (super et mutant Xmen)                               [Contemporain]" },
					{ value: "HP",                            label: "HP                                                          [Contemporain]" },	
					{ value: "HomeBrew",                      label: "HomeBrew                                                    [Générique]" },
					{ value: "INSMV",                         label: "INSMV                                                       [Dark Horreur]" },
					{ value: "Imperator",                     label: "Imperator                                                   [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Knight",                        label: "Knight                                                      [Futuriste post apo SF]" },
					{ value: "L5R",                           label: "L5R légendes des cinq anneaux                               [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Les lames du Cardinal",         label: "Les lames du Cardinal                                       [Pirate Renaissance]" },
					{ value: "Les secrets de la 7eme mer",    label: "Les secrets de la 7eme mer                                  [Pirate Renaissance]" },
					{ value: "Metal Adv",                     label: "Metal Adv                                                   [Futuriste post apo SF]" },
					{ value: "MyLittlePony",                  label: "MyLittlePony Mon petit poney                                [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Naheulbeuk",                    label: "Le donjon de Naheulbeuk                                     [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Nephilim",                      label: "Nephilim                                                    [Contemporain]" },
					{ value: "Numenéra",                      label: "Numenéra                                                    [Futuriste post apo SF]" },
					{ value: "Ombres d'Esteren",              label: "Ombres d'Esteren                                            [Dark Horreur]" },
					{ value: "Paranoïa",                      label: "Paranoïa                                                    [Dark Horreur]" },
					{ value: "Patient 13",                    label: "Patient 13                                                  [Dark Horreur]" },
					{ value: "Pathfinder",                    label: "Pathfinder                                                  [donjons et dragons Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Pavillion Noir",                label: "Pavillion Noir                                              [Pirate Renaissance]" },
					{ value: "PbtA",                          label: "PbtA                                                        [Générique]" },
					{ value: "Polaris",                       label: "Polaris                                                     [Futuriste post apo SF]" },
					{ value: "Rêve de Dragon",                label: "Rêve de Dragon                                              [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Ryuutama",                      label: "Ryuutama                                                    [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "SavageWolrd",                   label: "SavageWolrd                                                 [Générique]" },
					{ value: "Scion",                         label: "Scion                                                       [Dark Horreur]" },
					{ value: "SdA",                           label: "Le seigneur des anneaux                                     [Tolkien Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Shaan",                         label: "Shaan                                                       [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Sombre",                        label: "Sombre                                                      [Dark Horreur]" },
					{ value: "Starwars",                      label: "Starwars                                                    [Futuriste post apo SF]" },
					{ value: "Tales from the loop",           label: "Tales from the loop                                         [Dark Horreur]" },
					{ value: "Terra X",                       label: "Terra X                                                     [Futuriste post apo SF]" },
					{ value: "Tiny",                          label: "Tiny                                                        [Générique Contemporain]" },
					{ value: "Trash",                         label: "Trash                                                       [Générique]" },
					{ value: "Yggdrasil",                     label: "Yggdrasil                                                   [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "Vampire",                       label: "Vampire                                                     [Dark Horreur]" },
					{ value: "WarHammer",                     label: "WarHammer                                                   [Médiéval Fantastique, Epique, Medfan]" },
					{ value: "w40k-DarkHeresy",               label: "w40k                                                        [Warhammer DarkHeresy Dark Horreur]" },
					{ value: "Zombie",                        label: "Zombie                                                      [Futuriste post apo SF]" },					
				],
		delay: 100
	  },
	  showAutocompleteOnFocus: true,
	  limit: 1
	});
});
