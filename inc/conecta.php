<?php 

/* Ligação ente o PHP e o banco de dados */
/* Parâmetros de acesso ao servidor de banco de dados MySQL */
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "microblog-inicial";

/* Usando a função mysqli_connect para conectar ao servidor */
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

/* Definindo o charset UTF8 também para a comunicação com o banco de dados */
mysqli_set_charset($conexao, "utf8");

/* Se der algum problema de conexão (ou resultado, conexao false) pare tudo (die) e mostre o erro. */
if( !$conexao ){
    die(mysqli_connect_error($conexao));
/* Senão, beijos e abraços */
} /*else {
    echo "<p>Beleza, banco conectado!</p>";
} */

?>