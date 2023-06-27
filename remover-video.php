<?php 

$id = $_GET['id'];

$pdo = new PDO("mysql:host=localhost;dbname=alura_play", "root", "");

$sql = 'DELETE FROM videos WHERE id = ?';

$statement = $pdo->prepare($sql);

$statement-> bindValue(1, $id);

$repository = new \Alura\Mvc\Repository\VideoRepository($pdo);


if($repository->remove($id) === FALSE){

	header('Location: /?sucesso=0');
}else{

	header('Location: /?sucesso=1');
}