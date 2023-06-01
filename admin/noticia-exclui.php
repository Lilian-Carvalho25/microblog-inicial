<?php 
require_once "../inc/funcoes-noticias.php";
require_once "../inc/funcoes-sessao.php";

verificaAcesso();

// Pegando o id da notícia vindo do parâmetro de URL
$idNoticia = $_GET['id'];

// Pegando o id e o tipo do usuário que está logado vindos da sessão
$idUsuario = $_SESSION['id'];
$tipoUsuario = $_SESSION['tipo'];

excluirNoticia($conexao, $idNoticia, $idUsuario, $tipoUsuario);
header("location:noticias.php");