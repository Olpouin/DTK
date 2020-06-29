<?php
require_once("../../main.php");
header('Content-Type: application/json');

$quotePrepare = $core->db->prepare("SELECT * FROM `DTK` ORDER BY `id` DESC LIMIT 1");
$quotePrepare->execute();
$quote = $quotePrepare->fetch();

$quoteObj = new Quote();
$quoteObj->load($quote);
echo $quoteObj->toJSON();
?>
