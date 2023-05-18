<?php
/* Carregrando o script de acesso ao servidor de BD */
require "conecta.php";

/* Função que adiciona um novo usuário a partir dos dados informados no formulário */
// Usada em adm/usuario-insere.php
function inserirUsuario($conexao, $nome, $email, $senha, $tipo){
    /* Variável montada com o comando SQL para INSERT dos dados capturados através do formulário */
   $sql = " INSERT INTO usuarios(nome, email, senha, tipo) VALUES('$nome', '$email', '$senha', '$tipo')";

   /* Executando o comando SQL montado acima */
   mysqli_query($conexao, $sql) or die (mysqli_error($conexao));

} // Fim inserirUsuario




/* Lendo as informações inseridas e adicionando na tabela de usuários */
// Usada em usuarios.php
function lerUsuarios($conexao){
    // Montando o comando SQL SELECT para leitura dos usuários
    $sql = " SELECT nome, email, tipo FROM usuarios ORDER BY nome";

    // Guardando o resultado da operação de consulta SELECT
    $resultado = mysqli_query($conexao, $sql)
     or die (mysqli_error($conexao));

     /* Criando um array vazio que receberá outros arrays contendo os dados de cada usuário */
     $usuarios = [];

     /* Loop while (enquanto) que a cada ciclo de repetição, irá extrair os dados de cada usuário provenientes do resultado da consulta. Essa extração é feita pela função mysqli_fetch_assoc e é guardada na variável $usuario */
     while ($usuario = mysqli_fetch_assoc($resultado)){
        /* Pegamos os dados de cada $usuario (array), e os colocamos dentro (array_push) do grande array $usuarios. */
        array_push($usuarios, $usuario);
     }
     /* Levamos para fora da função a matriz $usuarios, contendo os dados de cada $usuario */
     return $usuarios;

} // Fim lerUsuarios
