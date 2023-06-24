<?php

$pdo = new PDO("mysql:host=localhost;dbname=alura_play", "root", "");

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if($id === false){

	header('Location: /?sucesso=0');
	exit();
}

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);

if($url === FALSE ){
	header('Location: /?sucesso=0');
	exit();
}

$titulo = filter_input(INPUT_POST, 'titulo');

if($titulo === FALSE ){
	header('Location: /?sucesso=0');
	exit();
}

$sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
$statement = $pdo->prepare($sql);
$statement->bindValue(':url', $url);
$statement->bindValue(':title', $titulo);
$statement->bindValue(':id', $id, PDO::PARAM_INT);

if($statement->execute() === false){

	header('Location: /?sucesso=0');
}else {

	header('Location: /?sucesso=1');	
}

