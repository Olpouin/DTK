<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$user = "olpouin";
$pass = "password here";
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
