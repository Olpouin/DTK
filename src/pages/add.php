<?php
$content['desc'] = 'Ajouter une quote rapidement et facilement dans DTK pour la graver à jamais dans l\'âme des Kévains.';
$content['title'] = 'Ajouter une quote';
$date = date("Y-m-d");
$path = Config::read('gene.path');
$content['page'] = <<<ADD
<div id="section-add" class="section-add">
	Avant de compléter ce champ, merci de respecter les règles suivantes :
	<li>Ne postez pas juste pour poster : Envoyez seulement les conversations drôles que vous voyez. Certains contenus ont plus leur place dans le Starboard que sur DTK, comme par exemple « (Oui j'ai dabbé :( ) ».</li>
	<li>Ne mettez pas l'heure.</li>
	<li>Mettez le texte sous le format « &lt;Pseudo&gt; message ».</li>
	<li>Pour ajouter un commentaire si nécéssaire, vous pouvez utiliser /*Commentaire*/ dans la quote.</li>
	<li>10 caractères ≥ quote ≥ 2000 caractères</li>

	<form action="{$path}/api/add-quotes.php" method="post">
		Quote : <textarea id="add_text" name="text" required="" placeholder="/*Exemple de commentaire*/\r\n<Olpouin> Exemple de texte."></textarea>
		Mot de passe : <input name="pass" placeholder="Mot de passe requis pour ajouter une quote." required="" type="password">
		Date : <input id="add_date" name="date" type="date" value="{$date}">
		A cocher si la quote vient d'en vocal : <input id="add_source-type" name="source-type" type="checkbox"><br>
		<input type="submit" value="Envoyer ma quote !">
		<button type="button" style="float:right;" onclick="formatQuote();">Preview</button>
	</form>
</div>
<div class="section-add_preview">
	<h1 style="margin-bottom: 0;">Preview :</h1>
	<span>Appuyez sur le bouton "Preview" avant d'envoyer la quote pour voir facilement à quoi elle ressemblera.</span>
	<div class="section-add_preview-box" id="previewBox"></div>
</div>
<script>
	formatQuote();
</script>
ADD;
?>
