<?php

$pdo = new PDO("mysql:host=localhost;dbname=alura_play", "root", "");
$sql = "INSERT INTO videos (url, title) VALUES (?, ?)";


$url = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL);
$titulo = filter_input(INPUT_POST, 'titulo');

if($url === FALSE or $titulo === FALSE){
	header('Location: /?sucesso=0');
	exit();
}


$repository = new \Alura\Mvc\Repository\VideoRepository($pdo);


if($repository->add(new \Alura\Mvc\Entity\Video($url, $titulo)) == FALSE){

	header('Location: /?sucesso=0');
}else {

	header('Location: /?sucesso=1');	
}

