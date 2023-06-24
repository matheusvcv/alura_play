<?php

declare(strict_types=1);


/*echo "<pre>";
var_dump($_SERVER); 
echo "</pre>";*/


if(!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER['PATH_INFO'] === '/'){

	require_once 'listagem-video.php';

} elseif($_SERVER['PATH_INFO'] === '/novo-video'){

	if($_SERVER['REQUEST_METHOD'] === 'GET'){

		require_once 'formulario.php';

	} elseif($_SERVER['REQUEST_METHOD'] === 'POST'){

		require_once 'novo-video.php';

	}
} elseif($_SERVER['PATH_INFO'] === '/editar-video') {

	if($_SERVER['REQUEST_METHOD'] === 'GET'){

		require_once 'formulario.php';

	} elseif($_SERVER['REQUEST_METHOD'] === 'POST') {

		require_once 'editar-video.php';

	} elseif($_SERVER['PATH_INFO'] === '/remover-video') {

		require_once 'remover-video.php';

	}

}