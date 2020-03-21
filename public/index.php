<?php
require_once("../src/main.php");

$buttonQuotes = $buttonAdd = $buttonSpecial = "";
if (isset($_GET['type'])) {
	switch ($_GET['type']) {
		case 'quotes':
			require_once("../src/pages/quotes.php");
			$buttonQuotes = 'class="menu-open"';
			$buttonSpecial = '<a onclick="researchBar(\'open\')" style="cursor: pointer;" id="search-button"><svg class="svg-search" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg></a>';
			break;
		case 'share':
			require_once("../src/pages/share.php");
			break;
		case 'add':
			require_once("../src/pages/add.php");
			$buttonAdd = 'class="menu-open"';
			break;
		default:
			require_once("../src/pages/home.php");
			break;
	}
} else require_once("../src/pages/home.php");

?>
<!DOCTYPE html>
<html lang="<?=Config::read('gene.path')?>">
	<head>
		<title>Dans Ton Kévain</title>
		<meta charset="utf-8">
		<meta name="description" content="<?=$content['desc']?>">
		<meta property="og:description" content="<?=$content['desc']?>">
		<meta property="og:title" content="<?=$content['title']?>">
		<meta property="og:site_name" content="Dans Ton Kévain">
		<link rel="stylesheet" href="<?=Config::read('gene.path')?>/content/css/quotes.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="<?=Config::read('gene.path')?>/content/css/main.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="<?=Config::read('gene.path')?>/content/css/add.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="<?=Config::read('gene.path')?>/content/themes/<?=Config::read('cookie.theme')?>.css" type="text/css" media="screen"/>
		<script src="<?=Config::read('gene.path')?>/content/js/script.js"></script>
		<script src="<?=Config::read('gene.path')?>/content/js/functions.js"></script>
	</head>
	<body>
		<header>
			<a href="<?=Config::read('gene.path')?>/">
				<h1 class="def">Dans Ton Kévain</h1>
				<h1 class="min">DTK</h1>
			</a>
			<div>
				<?=$buttonSpecial?>
				<a <?=$buttonQuotes?> href="<?=Config::read('gene.path')?>/quotes/latest/">Quotes</a>
				<a <?=$buttonAdd?> href="<?=Config::read('gene.path')?>/add/">Ajouter</a>
			</div>
		</header>
		<textarea id="share-url" class="share-url" rows="1"></textarea>
		<div style="min-height: calc(100vh - 145px);">
			<fieldset class="search-menu" id="search-menu">
				<legend>Paramètres de recherche</legend>
				<div>
					Type de triage :
					<ul>
						<li><a href="<?=Config::read('gene.path')?>/quotes/latest/">Par date de publication</a></li>
						<li><a href="<?=Config::read('gene.path')?>/quotes/date/">Par date du texte</a></li>
					</ul>
					Trier par provenance :
					<ul>
						<li><a href="<?=Config::read('gene.path')?>/quotes/voice/">Quotes par chat vocal</a></li>
						<li><a href="<?=Config::read('gene.path')?>/quotes/text/">Quotes textuelles</a></li>
					</ul>
				</div>
				<div>
					Rechercher une personne :
					<ul>
						<?php
						foreach (Config::read('gene.usernames') as $key => $value) {
							echo "<li><a href=\"".Config::read('gene.path')."/quotes/name/".$key."/\">".$key."</a></li>";
						}
						 ?>
				 	</ul>
				</div>
			</fieldset>
			<?=$content['page']?>
		</div>
	</body>
</html>
