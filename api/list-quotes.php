<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$json = json_decode(file_get_contents("/home/www/codebrew.fr/olpouin/DTK/config.cfg"));
$user = $json->user;
$pass = $json->pass;
try {
	$db = new PDO('mysql:host=localhost;dbname=olpouin_dtk;charset=utf8',$user,$pass);
} catch (Exception $e) {
	die('Error : '.$e->getMessage());
}

$quotes = $db->prepare('SELECT * FROM DTK ORDER BY DTK.id');
$quotes->execute();
$result = $quotes->fetchAll(PDO::FETCH_CLASS);
echo json_encode($result);
?>
