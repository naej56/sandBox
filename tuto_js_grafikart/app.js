
(function (){

	var i = 0
	var demo = function () {
		i++
		if (i >= 10){
			clearInterval(timer)
		}
		console.log(i)
	}

	var timer = window.setInterval(demo, 1000)

	/*var des = {
		 lancer: function() {
		 	return Math.floor(Math.random() * 10)
		 }
	}
	
	var jeu = function() {
		var nbSecret = des.lancer()
		var nbEssai = 5
		var compteur = 1
		console.log(nbSecret)
		var reponse = window.prompt('Denine le chiffre qui est compris entre 0 et 10')
		console.log(reponse.toString() + ' ' + compteur.toString())
		while (reponse != nbSecret && nbEssai > 0){
			compteur++
			if(nbSecret > reponse){
				reponse = window.prompt('Le chiffre est plus grand que : ' + reponse)
				console.log(reponse.toString() + ' ' + compteur.toString())
			} else {
				reponse = window.prompt('Le chiffre est plus petit que : ' + reponse)
				console.log(reponse.toString() + ' ' + compteur.toString())
			}
		}
		if(reponse == nbSecret){
			window.alert('Bravo tu as trouvé le chiffre : ' + nbSecret + ' en ' + compteur + ' coups')
		} else {
			window.alert('Perdu !')
		}
		
	}
	jeu()*/

	/*var leChiffre = des()
	var reponse = window.prompt('Deviner le chiffre entre 0 et 10 :', reponse)
	*/

	/*
	generer un chiffre aléatoire entre 1 et 10
	demander de deviner le chiffre
		si est = prompt vous avez gagner
		sinon si > redemander en indiquant que le chiffre est plus grand
		sinon redemander en indiquant que le chiffre est plus petit


	*/
})()





	/*
	var eleve = {
		nom: 'Jean',
		parle: function () {
			console.log("Je m'appel "+this.nom)
		}
	}

	eleve.parle()*/

	/*
	var eleve1 = {
		nom: 'Jean',
		notes: [15, 16, 18]
	}
	var eleve2 = {
		nom: 'Marc',
		notes: [5, 18, 20]
	}

	var moyenne = function(notes){
		var someNote = 0
		for (var i = 0; i < notes.length; i++) {
			someNote = someNote + notes[i]
		}
		return someNote / notes.length
	}

	var best = function(a, b){
		var moyA = moyenne(a.notes)
		var moyB = moyenne(b.notes)
		if (moyA > moyB) {
			return true
		} else {
			return false
		}
	}

	console.log(best(eleve1, eleve2))*/

		/*var phrase = "Optional Specifies the characters to use for separating the string The separator is treated as a string or a regular expression If separator is omitted the array returned contains one element consisting of the entire string If separator is an empty string str is converted to an array of characters"

		var mots = phrase.toLowerCase().split(' ')

		var compteur = {}

		for (var i = 0; i < mots.length; i++) {
			var mot = mots[i]
			if(compteur[mot] === undefined){
				compteur[mot] = 1
			} else {
				compteur[mot]++
			}
		}

		console.log(compteur)*/
		/*var compteur = {
			compte: function(mots){
				for (var i = 0; i < mots.length; i++) {
					console.log(resultat)
					if (resultat.mots[i]) {
						resultat.push(mots[i])
						console.log(resultat.mots[i])

					}
				}
			}
		}*/

		
