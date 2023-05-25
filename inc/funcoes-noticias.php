<?php
require_once "conecta.php";


// Usada em noticia-insere.php
function inserirNoticia($conexao, $titulo, $texto, $resumo, $imagem, $idUsuarioLogado){
    // Primeira parte = banco -- Segunda parte = variáveis de acesso
    $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, usuario_id) VALUES('$titulo', '$texto', '$resumo', '$imagem', $idUsuarioLogado)"; 

    mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
} // fim inserirNoticia




// Usada em noticia-insere.php e noticia-atualiza.php
function upload($arquivo){
    // Array contendo a lista de formatos de imagem válidos
    $tiposValidos = ["image/png", "image/jpeg", "image/gif","image/svg+xml"];

    /* Validação do formato de imagem: SE o formato de arquivo NÃO ESTIVER LISTADO dentro do array $tiposValidados, para tudo e informe o usuário (dizendo que é um formato inválido). "history.back" serve para o usuário voltar para a página que estava antes. */
    if( !in_array($arquivo['type'], $tiposValidos) ){
        echo "<script>alert('Formato inválido!'); history.back();</script>";
        exit;
    }

    // Extraindo apenas o nome do arquivo
    $nome = $arquivo['name'];
    // Extraindo apenas do diretório/nome temporário
    $temporario = $arquivo['tmp_name'];
    // Definindo a pasta final/destino dentro do nosso site o "." foi usado para concatenação
    $destino = "../imagem/".$nome;
    // Mover o arquivo da área temporária no servidor para a pasta de destino final dentro do site
    move_uploaded_file($temporario, $destino);

} // fim upload




// Usada em noticias.php
function lerNoticias($conexao){
    // SQL PROVISÓRIO
    $sql = "SELECT * FROM noticias ORDER BY data DESC";
    $resultado = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));

    $noticias = [];

    /* Enquanto houver dados de cada notícia no resultado do SELECT SQL, guarde cada uma das notícias e seus dados em uma variável ($noticia) */
    while($noticia = mysqli_fetch_assoc($resultado)){
        // "empurre" para o array vazio
        array_push($noticias, $noticia);
    }

    return $noticias;

} // fim lerNoticias