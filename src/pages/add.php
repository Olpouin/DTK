<?php
$content['desc'] = 'Ajouter une quote rapidement et facilement dans DTK pour la graver à jamais dans l\'âme des Kévains.';
$content['title'] = 'Ajouter une quote';
$date = date("Y-m-d");
$dateDisplay = date("d/m/Y");
$path = Config::read('gene.path');
$content['page'] = <<<ADD
<div class="add-panel">
	<div class="add-panel_main">
		<div class="add-panel_quote">
			<textarea onkeyup="previewQuote()" id="add_text" name="text" required="" placeholder="/*Exemple de commentaire*/\r\n<Pseudo> Exemple de texte.\n<Olpouin> Exemple de texte !"></textarea>
			<input id="add_date" name="date" type="date" value="{$date}">
			<label class="checkbox-label" onclick="previewQuote('icon')" for="add_voice"><input id="add_voice" name="voice" type="checkbox">Vocal <span></span></label>
			<label class="checkbox-label" onclick="previewQuote('icon')" for="add_RP"><input id="add_RP" name="rp" type="checkbox">RP <span></span></label>
			<br><br><input id="add_pass" name="pass" placeholder="Mot de passe" required="" type="password">
			<button class="button" onclick="API('add-quotes',{
				'text':document.getElementById('add_text').value,
				'date':document.getElementById('add_date').value,
				'source':isChecked('add_voice'),
				'subject':isChecked('add_RP'),
				'pass':document.getElementById('add_pass').value
			})">Envoyer</button>
		</div>
		<div class="add-panel_preview">
			<div class='quote'>
				<div class='quote-h'>
					<span>#0 | <span id="preview_date">${dateDisplay}</date></span>
					<img class="quote-icon usable-icon" onclick="share(&quot;/add/&quot;);" src="${path}/content/icons/share.svg" alt="Icône partage" title="Partager">
					<img style="display:none;" id="preview_voice" class="quote-icon" src="${path}/content/icons/voice.svg" alt="Icône chat vocal" title="Chat vocal">
					<img style="display:none;" id="preview_RP" class="quote-icon" src="${path}/content/icons/RP.svg" alt="Icône RP" title="En rapport avec un RP">
				</div>
				<pre id="preview_text"></pre>
			</div>
		</div>
	</div>

	<div class="add-panel_rules">
		<h2>Envoyer une quote</h2>
		<ol>
			<li>Ne postez pas juste pour poster</li>
			<li>Ne mettez pas l'heure</li>
			<li>Respectez le format</li>
			<li>Ajoutez un commentaire si nécéssaire.</li>
			<li>Maximum de 2000 caractères</li>
		</ol>
	</div>
</div>
<script>
	previewQuote('icon');
	previewQuote('date');
	setInterval(()=>{
		previewQuote('date');
	},1000);
	previewQuote();
</script>
ADD;
?>
