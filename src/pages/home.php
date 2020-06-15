<?php
$content['page'] = <<<PAGE
<a href=\"https://github.com/Olpouin/DTK\" rel=\"external\" target=\"_blank\" hreflang=\"en\">Code sur GitHub</a>
<fieldset class="parameters">
	<legend>Paramètres</legend>
	<div>
		Thème :
		<ul>
			<li><a id="theme-day" onclick="setTheme('day');">Jour</a></li>
			<li><a id="theme-night" onclick="setTheme('night');">Nuit</a></li>
			<li><a id="theme-oled" onclick="setTheme('oled');">Galaxie</a></li>
			<li><a id="theme-discord" onclick="setTheme('discord');">Discord</a></li>
		</ul>
	</div>
	<!--<div style="float:right;align-items:flex-end;display:flex;">
		<button>Sauvegarder</button>
	</div>-->
	<script>
		if (getCookie('theme') != "") {
			select('theme-'+getCookie('theme'));
		} else select('theme-day');
	</script>
</fieldset>
<div>Icon : <a href="https://www.flaticon.com/authors/freepik" target="_blank" title="Freepik">Freepik</a></div>
PAGE;
?>
