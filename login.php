<?php
require_once "inc/funcoes-usuarios.php";
require_once "inc/funcoes-sessao.php";
require "inc/cabecalho.php"; 

/* Programação das mensagens de feedback */
/* Se houver "campos_obrigatorios" na URL, significa que o usuário não preencheu e-mail e senha. */
if(isset($_GET["campos_obrigatorios"]) ){
	// Portanto, essa mensagem será exibida
	$mensagem = "Você deve preencher e-mail e senha!";
}

?>

<div class="row">
    <div class="bg-white rounded shadow col-12 my-1 py-4">
    <h2 class="text-center fw-light">Acesso à área administrativa</h2>

        <form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50" autocomplete="off">
			<!-- Se houver alguma mensagem, nós mostramos -->
			<?php if(isset($mensagem)) {?>
				<p class="my-2 alert alert-warning text-center">
					<?=$mensagem?>
				</p>   
				<?php } ?>

				<div class="mb-3">
					<label for="email" class="form-label">E-mail:</label>
					<input class="form-control" type="email" id="email" name="email">
				</div>
				<div class="mb-3">
					<label for="senha" class="form-label">Senha:</label>
					<input class="form-control" type="password" id="senha" name="senha">
				</div>

				<button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>

			</form>

<?php 
if(isset($_POST["entrar"])){

	/* Verificando se os campos estão vazios. Se estiverem (um ou ambos), o usuário continuará aqui na página login. */
	if(empty($_POST["email"]) || empty($_POST["senha"])){
		header("location:login.php?campos_obrigatorios");
		exit;

	} // fim if validação

	// Capturar e-mail e a senha digitados
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	/*  Buscando no banco de dados um usuário de acordo com o e-mail informado. */
	$dadosUsuario = buscaUsuario($conexao, $email);

	/* Verificação de senha */
	if( $dadosUsuario != null && password_verify($senha, $dadosUsuario['senha'])) {
		echo "Pode entrar";
	} else {
		echo "Não pode entrar";
	}
} // fim if entrar

?>

    </div>
    
    
</div>        

<?php 
require_once "inc/rodape.php";
?>

