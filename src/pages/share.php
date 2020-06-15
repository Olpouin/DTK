<?php
if (!isset($_GET['id']) OR empty($_GET['id']) OR !is_numeric($_GET['id']) OR is_float($_GET['id'])) { //Shows a random quote if no ID provided
	$randPrepare = $core->db->prepare("SELECT id FROM `DTK` WHERE approved = 1 ORDER BY RAND() LIMIT 1");
	$randPrepare->execute();
	$rand = $randPrepare->fetch();
	$_GET['id'] = $rand['id'];
}

$quotePrepare = $core->db->prepare("SELECT * FROM `DTK` WHERE id = ".$_GET['id']." AND approved = 1");
$quotePrepare->execute();
$quoteArray = $quotePrepare->fetch();

$quote = new Quote();
$quote->load($quoteArray);

$previous = (!is_null($quote->quoteNear('previous'))) ? "<a href='".$quote->quoteNear('previous')."' class='nav-button_search'>❮</a>" : "";
$quoteHTML = $quote->toHTML();
$next = (!is_null($quote->quoteNear('next'))) ? "<a href='".$quote->quoteNear('next')."' class='nav-button_search' style='float:right;'>❯</a>" : "";

$content['desc'] = $quote->textSafe();
$content['title'] = 'Quote #'.$quote->id();
$content['page'] = $previous.$next.$quoteHTML."<style>.quote {
	width: 40% !important;
	margin: auto !important;
	vertical-align: middle;
}</style>";
 ?>
