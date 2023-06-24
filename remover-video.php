<?php 

$id = $_GET['id'];

$pdo = new PDO("mysql:host=localhost;dbname=alura_play", "root", "");

$sql = 'DELETE FROM videos WHERE id = ?';

$statement = $pdo->prepare($sql);

$statement-> bindValue(1, $id);

if($statement-> execute() === FALSE){

	header('Location: /?sucesso=0');
}else{

	header('Location: /?sucesso=1');
}