<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$json = json_decode(file_get_contents("/home/www/codebrew.fr/olpouin/DTK/config.cfg"));
$user = $json->user;
$pass = $json->pass;
try {
	$bdd = new PDO('mysql:host=localhost;dbname=olpouin;charset=utf8',$user,$pass);
} catch (Exception $e) {
	die('Error : '.$e->getMessage());
}

$captcha = $_GET['captcha'];
$text = $_GET['text'];
if(!isset($text)) {
	$answer = 1;
} elseif(!isset($captcha)) {
	$answer = 2;
} elseif(strlen($text) > 2000) {
	$answer = 3;
} elseif(strlen($text) < 10) {
	$answer = 4;
} elseif(strtolower($captcha) != "soké") {
	$answer = 5;
} else{
	$answer = 0;
	$req = $bdd->prepare('INSERT INTO DTK(text) VALUES(:text)');
	$req->execute(array(
		'text' => $text
		)
	);
}

$result = array("answer"=>$answer, "text"=>$text, "text_chars"=>strlen($text), "captcha"=>$captcha);
echo json_encode($result);
?>
