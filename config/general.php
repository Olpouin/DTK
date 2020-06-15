<?php
Config::write('gene.path', '');
Config::write('gene.lang', 'fr');
Config::write('gene.usernames', [ //'Username display' => 'regex'
	'Olpouin' => 'olp(:?ouin)',
]);
Config::write('gene.passwords', [ //'Hashed password' => ['txt' => 'Name of the access key', 'lvl' => 0]
]);
Config::write('gene.themes', [
	'day', 'night', 'oled', 'discord'
]);
?>
