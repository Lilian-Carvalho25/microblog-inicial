<?php

/* Sessões no PHP:
- Recurso usasdo para o controle de acesso à determinadas páginas e/ou recursos do site. Exemplo: área administrativa, área do cliente/aluno.
- Nestas áreas, o acesso só é possível mediante alguma forma de autenticação. Exemplo: login/senha.
*/

// Se NÃO existir uma sessão em funcionamento
if(!isset($_SESSION)){
    // Então, inicie uma sessão
    session_start();
}

/* Usada em TODAS as páginas admin */
function verificaAcesso(){
    /* Se NÃO EXISTIR uma variável de SESSÃO baseada no identificador do usuário, significa que ele/ela NÃO ESTÁ logado(a) no sistema.*/
    if(!isset($_SESSION['id'])){
        // Destrua qualquer recurso de sessão
        session_destroy();
        // Redirecione para o formulário de login
        header("location:../login.php");
        // Pare completamente qualquer outra execução
        exit;
    }

} // Fim verificaAcesso




/* Função login */
function login ($id, $nome, $tipo) {
    /* Criação de variáveis de sessão */
    $_SESSION['id'] = $id;
    $_SESSION['nome'] = $nome;
    $_SESSION['tipo'] = $tipo;
    
    /* As variáveis de sessão ficam disponíeis para utilização durante toda a duração ada sesssão, ou seja, enquanto o navegador não for fechado ou o susuário estiver logado. */
}