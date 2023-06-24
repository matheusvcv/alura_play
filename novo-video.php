<?php

$pdo = new PDO("mysql:host=localhost;dbname=alura_play", "root", "");
$sql = "INSERT INTO videos (url, title) VALUES (?, ?)";


$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$titulo = filter_input(INPUT_POST, 'titulo');

if($url === FALSE or $titulo === FALSE){
	header('Location: /?sucesso=0');
	exit();
}


$statement = $pdo->prepare($sql);
$statement-> bindValue(1, $url);
$statement-> bindValue(2, $titulo);

if($statement->execute() == FALSE){

	header('Location: /?sucesso=0');
}else {

	header('Location: /?sucesso=1');	
}

