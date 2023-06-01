<?php
require "inc/funcoes-noticias.php";
require "inc/cabecalho.php"; 

$noticias = lerTodasAsNoticias($conexao);
?>

<div class="row my-1 mx-md-n1">

    <article class="col-12">
        <h2> </h2>
        <p class="font-weight-light">
            <time>  </time> - <span>Autor da notícia</span>
        </p>
        <img src="https://picsum.photos/seed/picsum/200/100" alt="" class="float-left pr-2 img-fluid">
        <p>  </p>
    </article>

</div>        

<?php 
require_once "inc/rodape.php";
?>

