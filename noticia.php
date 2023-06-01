<?php
require "inc/funcoes-noticias.php";
require "inc/cabecalho.php";

$id = $_GET["id"];
$detalhesDaNoticia = lerDetalhes($conexao, $id);
?>

<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <h2> <?= $detalhesDaNoticia["titulo"] ?> </h2>
        <p class="font-weight-light">
            <time> <?= formataData($detalhesDaNoticia["data"]) ?> </time> - <span><?= $detalhesDaNoticia['nome'] ?></span>
        </p>
        <img src="imagem/<?= $detalhesDaNoticia['imagem'] ?>" alt="" class="float-start pe-3 img-fluid">
        <p> <?= nl2br($detalhesDaNoticia["texto"]) ?> </p>
    </article>

</div>

<?php
require_once "inc/rodape.php";
?>