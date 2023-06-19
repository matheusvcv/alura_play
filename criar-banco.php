<?php

$pdo = new PDO("mysql:host=localhost;dbname=alura_play", "root", "");

$pdo-> exec('CREATE TABLE videos (id INTEGER PRIMARY KEY, url VARCHAR(140), title VARCHAR(140));');

echo "conectei";