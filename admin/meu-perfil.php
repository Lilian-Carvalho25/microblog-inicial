<?php 
require_once "../inc/cabecalho-admin.php";
require_once "../inc/funcoes-usuarios.php";

$id = $_GET["id"];

if(isset($_POST['atualizar'])){

	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$tipo = $_POST['tipo'];

    if(empty( $_POST['senha']) || password_verify( $_POST['senha'], $usuario['senha'])) {
        $senha = $usuario['senha'];
    } else {
        $senha = password_hash( $_POST['senha'], PASSWORD_DEFAULT); 
    }

	atualizarUsuario($conexao, $id, $nome, $email, $senha, $tipo);

	header("location:usuarios.php");

} // Fim if/issset botão

$usuario = lerUmUsuario($conexao, $id);
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar meus dados
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input value="<?=$usuario['nome']?>" class="form-control" type="text" id="nome" name="nome" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input value="<?=$usuario['email']?>" class="form-control" type="email" id="email" name="email" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

