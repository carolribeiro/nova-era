<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/autentica.php";

if ( !$_SESSION['regraAdmin'] ) {
	$_SESSION['msg'] = "Você não possui acesso a essa área";
	$_SESSION['tipo'] = "erro";
	Header( "Location: " . DataSources::urlAdmin() );
	die();
} 
else if ( isset( $_GET['att'] ) && !empty( $_GET['att'] ) ) {
	$banco = new Banco();
	$SQL = "SELECT * FROM tb_usuarios WHERE id_usuario = :id_usuario ;";
	$banco->preparaSQL( $SQL );
	$regras = [
		':id_usuario'	=>	$_GET['att']
	];
	$banco->bindSQL( $regras );
	$consulta = $banco->executaSQL();
	$consulta = $consulta->fetchAll();
	$consulta = $consulta[0];
	
	if ( !$consulta ) {
		$_SESSION['msg'] = "Por favor, selecione um usuario válido.";
		$_SESSION['tipo'] = "erro";
		Header( "Location: /admin/modulos/usuarios/gerenciar.php" );
		die();
	}
	
	$ds_nome =  utf8_encode( $consulta['ds_nome'] );
	$ds_email = utf8_encode( $consulta['ds_email'] );
	$ds_login = utf8_encode( $consulta['ds_login'] );
	$ds_senha = utf8_encode( $consulta['ds_senha'] );
	$cd_tipo = utf8_encode( $consulta['cd_tipo'] );
}
else{
	$ds_nome =  "";
	$ds_email = "";
	$ds_login = "";
	$ds_senha = "";
	$cd_tipo = "";
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include $_SERVER['DOCUMENT_ROOT']."/admin/includes/partial-head.php";?>
	<title>Projeto Nova Era</title>	
</head>
<body class="body">
	<section class="painel-geral">
		<h1 class="title-painel title">Painel Administrativo - Projeto Nova Era</h1>
		<div class="wrapper-painel">
			<?php include $_SERVER['DOCUMENT_ROOT']."/admin/includes/aside.php";?>
			<main class="conteudo-painel">
				<h2 class="title-painel title">Dados de Usuários</h2>
				<?php if( isset( $_SESSION['msg'] ) ) : ?>
				<p class="message <?=$_SESSION['tipo']?>">
					<?=$_SESSION['msg']?>
				</p>
				<?php endif;
				unset( $_SESSION['msg'] );
				unset( $_SESSION['tipo'] );
				?>
				<form action="salvar.php" method="post" class="form-padrao" data-validate="form" accept-charset="utf-8">
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Nome do Usuário</label>
						<input type="text" class="input" name="nome" data-validate="text" required maxlength="50" title="nome" value="<?=$ds_nome?>">
					</fieldset>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">E-mail do Usuário</label>
						<input type="e-mail" class="input" name="email" data-validate="text" required maxlength="100" title="e-mail"  value="<?=$ds_email?>">
					</fieldset>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Login do Usuário</label>
						<input type="text" class="input" name="login" required maxlength="50" title="login"  value="<?=$ds_login?>">
					</fieldset>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Senha do Usuário</label>
						<input type="password" class="input" name="senha" data-validate="text" data-equal="password" required maxlength="50" title="senha"  value="<?=$ds_senha?>">
					</fieldset>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Confirmação de senha do Usuário</label>
						<input type="password" class="input" name="confirma-senha" data-validate="text" data-equal="retype-password" value="<?=$ds_senha?>" required maxlength="50" title="confirmação de senha">
					</fieldset>
					<fieldset class="fieldset">
						<label for="tipo" class="legenda">Tipo de usuário</label>
						<input type="radio" value="2" name="tipo" id="adm"><label for="adm">Administrador</label>
					</fieldset>
					<fieldset class="fieldset">
						<input type="radio" value="3" name="tipo" id="comum"><label for="comum">Comum</label>
					</fieldset>
					<input type="hidden" name="att" value="<?=$_GET['att']?>">
					<button class="btn-painel" data-validate="submit">Salvar</button>
				</form>
			</main>
		</div>
	</section>
</div>
<?php include $_SERVER['DOCUMENT_ROOT']."/admin/includes/scripts.php";?>
<script src="/config/js/validate.js"></script>
<script>
$( '[data-validate="text"]' ).on( 'change blur' , function(){
	validate.type.text( this );	
});
$( '[data-validate="submit"]' ).on( 'click' , function(){
	event.preventDefault();
	if( ( $( '[data-equal="password"]' ).val() == $( '[data-equal="retype-password"]'  ).val() ) && validate.actions.final()){
		$( '[data-validate="form"]' ).submit();
	}
});
<?php if( !empty( $cd_tipo )  ): ?>
	$(function(){
		$( '[name="tipo"][value="<?=$cd_tipo?>"]' ).prop( 'checked' , true );
	});
<?php endif; ?>
</script>
</body>
</html>