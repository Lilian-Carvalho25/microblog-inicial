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
function lerNoticias($conexao, $idUsuarioLogado, $tipoUsuarioLogado){
    if($tipoUsuarioLogado == 'admin'){
        // SQL do admin: pode carregar/ver tudo 
        $sql = "SELECT noticias.id, noticias.titulo, noticias.data, usuarios.nome
        FROM noticias INNER JOIN usuarios ON noticias.usuario_id = usuarios.id ORDER BY data DESC";
    } else {
        // SQL do editor: pode carregar/ver tudo DELE
        $sql = "SELECT * FROM noticias WHERE usuario_id = $idUsuarioLogado ORDER BY data DESC";
    }
    
    $resultado = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));

    $noticias = [];

    /* Enquanto houver dados de cada notícia no resultado do SELECT SQL, guarde cada uma das notícias e seus dados em uma variável ($noticia) */
    while($noticia = mysqli_fetch_assoc($resultado)){
        // "empurre" para o array vazio
        array_push($noticias, $noticia);
    }

    return $noticias;

} // fim lerNoticias




// Usada em noticias.php e páginas da área pública
function formataData($data){
    return date("d/m/Y H:i", strtotime($data));

} // fim formataData




// Usada em notícia atualiza.php
function lerUmaNoticia($conexao, $idNoticia, $idUsuarioLogado, $tipoUsuarioLogado){
    if($tipoUsuarioLogado == 'admin'){
        $sql = "SELECT * FROM noticias WHERE id = $idNoticia";
    } else {
        // Carrega os dados somente da notícia dele
        $sql = "SELECT * FROM noticias WHERE id = $idNoticia AND usuario_id = $idUsuarioLogado";
    }

    $resultado = mysqli_query($conexao,$sql) or die(mysqli_error($conexao));
    return mysqli_fetch_assoc($resultado);


} // fim lerUmaNoticia




// Usada em noticia-atualiza.php
function atualizarNoticia($conexao, $titulo, $texto, $resumo, $imagem, $idNoticia, $idUsuarioLogado, $tipoUsuarioLogado){
    if($tipoUsuarioLogado == 'admin'){
        $sql = "UPDATE noticias SET titulo = '$titulo', texto = '$texto', resumo = '$resumo', imagem = '$imagem' WHERE id = $idNoticia ";
    } else {
        $sql = "UPDATE noticias SET titulo = '$titulo', texto = '$texto', resumo = '$resumo', imagem = '$imagem' WHERE id = $idNoticia AND usuario_id = $idUsuarioLogado ";
    }

    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    
} // fim atualizarNoticia




// Usada em noticia-exclui
function excluirNoticia($conexao, $idNoticia, $idUsuarioLogado, $tipoUsuarioLogado ){
    if($tipoUsuarioLogado == 'admin'){
        // Pode apagar qualquer notícia
        $sql = "DELETE FROM noticias WHERE id = $idNoticia";
    } else {
        // Pode apagar somente as suas próprias notícias
        $sql = "DELETE FROM noticias WHERE id = $idNoticia AND usuario_id = $idUsuarioLogado";
    }

    mysqli_query($conexao, $sql) or die (mysqli_error($conexao));

} // fim excluirNoticia


/* Funções usadas na páginas da área pública */

// Usada em index.php
function lerTodasAsNoticias($conexao){
    $sql = "SELECT id, data, titulo, texto, resumo, imagem FROM noticias ORDER BY data DESC";

    $resultado = mysqli_query($conexao, $sql)
    or die (mysqli_error($conexao));

    $noticias = [];

    while ($noticia = mysqli_fetch_assoc($resultado)){
        array_push($noticias, $noticia);
     }
     return $noticias;
} // fim lerTodasAsNoticias




// Usada em noticia.php
function lerDetalhes($conexao, $id){
    $sql = "SELECT noticias.id, noticias.titulo, noticias.data, noticias.imagem, noticias.texto, usuarios.nome 
    FROM noticias INNER JOIN usuarios ON noticias.usuario_id = usuarios.id WHERE noticias.id = $id";

    $resultado = mysqli_query($conexao, $sql)
    or die (mysqli_error($conexao));

    return mysqli_fetch_assoc($resultado);

}  // fim lerDetalhes





// Usada em resultados.php
function busca($conexao, $termo){
    // o "LIKE" juntamente com a porcentagem, resumidamente é mais abrangente, procura resultados parecidos com o termo digitado e iguais também.
    $sql = "SELECT * FROM noticias WHERE titulo LIKE '%$termo%' OR texto LIKE '%$termo%' OR resumo LIKE '%$termo%' ORDER BY data DESC";

    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    $noticias = [];

    while($noticia = mysqli_fetch_assoc($resultado)){
        array_push($noticias, $noticia);
    }

    return $noticias;

} // fim busca