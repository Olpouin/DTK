<?php
require_once("../../main.php");
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['text']) OR !isset($data['pass'])) exit(APIresponse('Erreur client', "Le texte ou le mot de passe n'a pas pû être récupéré."));
if(!isset($data['date']) OR empty($data['date'])) $data['date'] = date("Y-m-d");
if(!isset($data['source'])) $data['source'] = "";
if(!isset($data['subject'])) $data['subject'] = "";

$text = $data['text'];
$date = $data['date'];
$password = $data['pass'];
$source = $data['source'];
$subject = $data['subject'];

$quote = new Quote();
if (!$quote->checkPass($password)['answer']) exit(APIresponse('Erreur', "Mot de passe inconnu."));
if (!$quote->setText($text)) exit(APIresponse('Erreur', "Texte trop court ou trop long."));
if (!$quote->setDate($date)) exit(APIresponse('Erreur', "Date envoyée incorrecte : n'est pas une date."));
$quote->setSource($source);
$quote->setSubject($subject);

if (!$quote->upload("API Site ".$_SERVER['HTTP_HOST'])) exit(APIresponse('Erreur serveur', "Il n'y a aucune erreur mais le serveur n'a pas pû envoyer la quote."));
else echo APIresponse('Succès', "Quote envoyée.");
?>
