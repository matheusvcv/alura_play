<?php

$pdo = new PDO("mysql:host=localhost;dbname=alura_play", "root", "");

$sql = "INSERT INTO videos (url, title) VALUES (?, ?)";


$statement = $pdo->prepare($sql);
$statement-> bindValue(1, $_POST['url']);
$statement-> bindValue(2, $_POST['titulo']);

var_dump($statement->execute());

