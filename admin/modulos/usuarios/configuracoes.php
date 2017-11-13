<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/autentica.php";
$banco = new Banco();
$SQL = "SELECT * FROM tb_usuarios WHERE id_usuario = ".$_SESSION['id'];
$banco->preparaSQL( $SQL );
$consulta = $banco->executaSQL();
$consulta = $consulta->fetchAll();
$consulta = $consulta[0];
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
				<h2 class="title-painel title">Configurações</h2>
				<?php if( isset( $_SESSION['msg'] ) ) : ?>
				<p class="message <?=$_SESSION['tipo']?>">
					<?=$_SESSION['msg']?>
				</p>
				<?php endif;
				unset( $_SESSION['msg'] );
				unset( $_SESSION['tipo'] );
				?>
				<form action="salvar-configuracoes.php" method="post" class="form-padrao" data-validate="form" accept-charset="utf-8">
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Nome</label>
						<input type="text" class="input" name="nome" data-validate="text" value="<?=utf8_encode( $consulta['ds_nome'] )?>" required maxlength="50" title="nome">
					</fieldset>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">E-mail</label>
						<input type="e-mail" class="input" name="email" data-validate="text" value="<?=utf8_encode( $consulta['ds_email'] )?>" required maxlength="100" title="e-mail">
					</fieldset>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Login</label>
						<input type="text" class="input" name="login" required maxlength="50" value="<?=utf8_encode( $consulta['ds_login'] )?>" title="login">
					</fieldset>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Senha</label>
							<input type="password" class="input" name="senha" data-validate="text" data-equal="password" value="<?=utf8_encode( $consulta['ds_senha'])?>" required maxlength="50" title="senha">
					</fieldset>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Confirmação de senha</label>
							<input type="password" class="input" name="confirma-senha" data-validate="text" value="<?=utf8_encode( $consulta['ds_senha'])?>" data-equal="retype-password" required maxlength="50" title="confirmação de senha">
					</fieldset>
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
</script>
</body>
</html>