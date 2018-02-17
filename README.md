# DTK (Dans Ton Kévain), parce que la boutade n'attend pas.
Le grand et beau DTK, un genre de bash.org simplifié et pour les Kévains.

## Ajouter les quotes
`add-quotes.php` permet d'ajouter des quotes. Eh ouais.
Le retour est le suivant :
```
{
	"answer": <chiffre de la réponse>,
	"text": <la quote envoyée>,
	"text_chars": <nombre de caratcères dans la quote>,
	"captcha": <le captcha proposé>
}
```

Les différentes réponses :
- 0 = toute les conditions d'evoi sont remplies
- 1 = pas de texte envoyé
- 2 = pas de captcha envoyé
- 3 = texte trop long (>2000 chars)
- 4 = texte trop petit (<10 chars)
- 5 = captcha incorrect

## Afficher les quotes
`quotes.php` liste toute les quotes dans un joli petit fichier.
Disposition du json :
```
{
	"id": "<ID de la quote>",
	"text": "<quote 1>",
	"type": "<type de la quote>",
	"source": "<source de la quote>"
},
{
	"id": "<ID de la quote 2>",
	"text": "<quote 2>"
	"type": "<type de la quote>",
	"source": "<source de la quote>"
},
{
	 ...
}
```
Avec `type` qui correspond au type de la quote. Actuellement, il n'y en a qu'un, `quo`.
Avec `source` qui correspond à la source de la quote (Par exemple : vocal, MP, ...). Inutile pour le moment.
