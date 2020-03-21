<?php
if (!isset($_GET['sort'])) $_GET['sort'] = "latest";
if (!isset($_GET['param']) OR !array_key_exists($_GET['param'], Config::read('gene.usernames'))) $name = array_rand(Config::read('gene.usernames'));
else $name = $_GET['param'];
if (!isset($_GET['page']) OR empty($_GET['page']) OR !is_numeric($_GET['page']) OR is_float($_GET['page']) OR $_GET['page'] <= 0) $page = 1;
else $page = $_GET['page'];

switch ($_GET['sort']) {
	case 'date':
		$content['title'] = 'Quotes - Page '.$page;
		$SQLrequest = "SELECT * FROM `DTK` WHERE approved = 1 ORDER BY DTK.date DESC";
		break;
	case 'voice':
		$content['title'] = 'Quotes vocales - Page '.$page;
		$SQLrequest = "SELECT * FROM `DTK` WHERE approved = 1  AND `source-type` = 1 ORDER BY DTK.id DESC";
		break;
	case 'text':
		$content['title'] = 'Quotes textuelles - Page '.$page;
		$SQLrequest = "SELECT * FROM `DTK` WHERE approved = 1 AND `source-type` = 0 ORDER BY DTK.id DESC";
		break;
	case 'name':
		$content['title'] = 'Quotes de '.$name.' - Page '.$page;
		$SQLrequest = "SELECT * FROM `DTK` WHERE approved = 1 AND text REGEXP '".Config::read('gene.usernames')[$name]."' ORDER BY DTK.id DESC";
		break;
	default:
		$content['title'] = 'Quotes - Page '.$page;
		$SQLrequest = "SELECT * FROM `DTK` WHERE approved = 1 ORDER BY DTK.id DESC";
		break;
}
$quotesPrepare = $core->db->prepare($SQLrequest);
$quotesPrepare->execute();
$quotes = $quotesPrepare->fetchAll(PDO::FETCH_ASSOC);

$pagesTotal = ceil(count($quotes) / 60);
if ($page > $pagesTotal) $page = 1;
$pagePrevious = $page - 1;
$pageNext = $page + 1;

$start = ($page * 60) - 60;
$wantedQuotes = array_slice($quotes, $start, 60);

$nav = "<div class=\"nav-menu\">";
if ($pagePrevious > 0) $nav .= "<a href=\"1\" class=\"nav-button\" style=\"float:left;margin-right:10px;\">❮❮</a><a href=\"".$pagePrevious."\" class=\"nav-button\" style=\"float:left\">❮ Page ".$pagePrevious."</a>";
if ($pageNext <= $pagesTotal) $nav .= "<a href=\"".$pagesTotal."\" class=\"nav-button\" style=\"float:right;margin-left:10px;\">❯❯</a><a href=\"".$pageNext."\" class=\"nav-button\" style=\"float:right;\">Page ".$pageNext." ❯</a>";
$nav .= "</div>";

$quotesHTML = "<h2 style=\"text-align:center;margin:0\">".$content['title']."</h2><div class=\"quotes\" id=\"quo\">";
foreach ($wantedQuotes as $wantedQuote) {
	$quoteObject = new Quote($wantedQuote);
	$quotesHTML .= $quoteObject->toHTML();
}
$quotesHTML .= "</div>";

$content['desc'] = 'La compilation des moments les plus boutadesqueux des Kévains !';
$content['page'] = $nav.$quotesHTML.$nav;
?>
