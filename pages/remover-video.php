Post Redirect Get

O Post Redirect Get serve para redirecionar o usuário após recebemos uma requisição utilizando post. 

Isso é útil para evitar inserções em duplicidade.

O PHP funcionada no lado do servidor. O redirecionamento funciona no lado do cliente (navegador). O PHP não conversa com o navegador diretamente.

Sendo assim devemos utilizar os cabeçalhos HTTP. Existe um cabeçalho HTTP chamado Location que quando o servidor envia o navegador sabe que é ára redirecionar o usuário.

Então podemos enviar o cabeçalho http na resposta.

Para fazer isso basta utilizar a função header() (header é cabeçalho em inglês).

Um cabeçalho http é definido pelo seu nome, depois dois pontos, depois um valor. Ex:

header('Location: /index.php');

Devemos ter em mente que o PHP não está redirecionando o usuário. O PHP está enviando um cabeçalho http, e o navegador sabe processar esse cabeçalho.

Com a função header podemos enviar qualquer tipo de cabeçalho HTTP para o cliente de nossa aplicação.

<?php

$pdo = new PDO("mysql:host=localhost;dbname=alura_play", "root", "");

$sql = "INSERT INTO videos (url, title) VALUES (?, ?)";


$statement = $pdo->prepare($sql);
$statement-> bindValue(1, $_POST['url']);
$statement-> bindValue(2, $_POST['titulo']);

if($statement->execute() == FALSE){

	header('Location: /index.php?sucesso=0');
}else {

	header('Location: /index.php?sucesso=1');	
}

Realizando buscas

Queremoos pegar todos os vídeos que estão no DB. Por isso, vamos no index e vamos realizar alguns passos:

Primeiro estabelecer a conexão conexao com o banco.

Depois criar um avariável que vai ser igual a variável de conexão, apontando para a função query com o select como parametro. Essa query deve apontar para a função fetchAll() com PDO::FETCH_ASSOC como parâmetro.

<?php
$pdo = new PDO("mysql:host=localhost;dbname=alura_play", "root", "");
$videoList = $pdo->query('SELECT * FROM videos;')->fetchAll(\PDO::FETCH_ASSOC);
?>

Agora para exibir os vídeos basta utilizar um foreach e misturar um php com o html.

No nosso caso, utilizaremos também uma função chamada str_starts_with() que serve para verificar se uma string começa com um determinadao valor. Para utilizar essa função, devemos colocar ela, e dentro dos parenteses, devemos colocar como primeiro parâmetro a string que queremos avaliar, e como segundo a string que queremos ver se começa:

 <ul class="videos__container" alt="videos alura">

        <?php foreach ($videoList as $video): ?>
            <?php if(str_starts_with($video['url'], 'http')): ?>

        <li class="videos__item">
            <iframe width="100%" height="72%" src="<?php echo $video['url']; ?>"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
            <div class="descricao-video">
                <img src="./img/logo.png" alt="logo canal alura">
                <h3><?php echo $video['title']; ?></h3>
                <div class="acoes-video">
                    <a href="./pages/enviar-video.html">Editar</a>
                    <a href="./pages/enviar-video.html">Excluir</a>
                </div>
            </div>
        </li>

            <?php endif; ?>
        <?php endforeach; ?>

    </ul>


Realizando a exclusão de video

- Criar um arquivo chamado remover-video.php

- Passar o id do video que será excluído por parâmetro.

$id = $_GET['id'];

- Criar a variável de conexão com o DB.

$pdo = new PDO("mysql:host=localhost;dbname=alura_play", "root", "");

$sql = 'DELETE FROM videos WHERE id = ?';

Utilizar a função prepare nesse sql que vai retornar um statement.

$stantement = $pdo->prepare($sql);

Fazer um bindValue() nesse statement

$statement-> bindValue(1, $id);

Depois executar com o Location:

if($statement->execute() == FALSE){

	header('Location: /index.php?sucesso=0');
}else {

	header('Location: /index.php?sucesso=1');	
}

Depois, ir no index e no botão de deletar, mandar para o arquivo de remover o onde o id for igual ao id. Ex:

<a href="remover-video.php?id=<?php echo $video['id']; ?>">Excluir</a>

Filtros em PHP

filter_input();

A função filter_input() serve para tazer algo que veio através de uma requisição (input) e validar esse dado através de alguma regra que vamos informar.

Primeira coisa que devemos informar é de onde vem o dado, que no nosso caso é de um post. Ex: INPUT_POST

Depois o nome da variável que está chegando. Ex:
'url'

Essa função já funcionaria dessa forma, mas seria a mesma coisa que pegar assim: $_POST['url'];

Para deixar ela mais efetiv, devemos adicionar o ultimo parâmetro que é o filtro. Ja temos no php o FILTER_VALIDATE_URL que serve justamente para validar URLs.

$url = filter_input(INPUT_POST, 'url', FILTER_VALIDADE_URL);

$titulo = filter_input(INPUT_POST, 'titulo');


Com esse filtro, se o dado que vier do input não for uma URL, vai retornar Falso.

Sendo assim, caso o retorno seja falso, devemos redirecionar para o index. O heder() não serve para encerrar a execução. Então, sempre que quisermos redirecionar um dado no meio do código, devemos utilizar também o exit(). Ex:

if($url === false){
	header('Location:/index.php?sucesso=0');
	exit();
}


Podemos validar diversas coisas utilizando o FILTER_VALIDADE_. Como por exemplo: URL, BOOLEAN, DOMAIN, EMAIL, FLOAT, INT e etc.

Podemos inclusive validar expressões regulares utilizando um quarto parametro.

Também podemos utilizar filtros não somente validade, mas também os SANITIZE.

O SANITIZE ele não somente valida, mas também remove. Por exemplo, se utilizarmos o FILTER_SANITIZE_EMAIL e tiver algum caractere que não é permitido no e-mail ele remove da string.

O Snitize limpa a string, o validade não limpa, ele só valida.


Se quisermos validar uma URL, por exemplo, que não não veio de um input, mas é uma variável, podemos utilizar um filter_var. É igual a anterior, mas não precisamos informar o primeiro parâmetro que informa de onde veio o input, porque japassmos uma variavel para ele.

Ex:

filter_var($variavel. FILTER_VALIDADE_URL);


A função filter_input filtra os dados recebidos da requisição, enquanto filter_var filtra o valor de qualquer variável que tenhamos no código.

Com filter_input podemos filtrar os dados provenientes das requisições HTTP. Podemos filtrar os valores recebidos em $_GET, $_POST, $_COOKIE, $_SERVER ou $_ENV… Já a filter_var serve para filtrarmos variáveis comuns em nosso código.

AS VALIDAÇÕES SEMPRE DEVEM SER FEITAS NO BACKEND





























































































































.















































.


