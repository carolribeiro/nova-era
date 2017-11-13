<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/autentica.php";
if ( !empty( $_GET['att'] ) ) {
	$banco = new Banco();
	$SQL = "SELECT * FROM tb_documentos WHERE id_documento = :id_documento ;";
	$banco->preparaSQL( $SQL );
	$regra[':id_documento'] = $_GET['att'];
	$banco->bindSQL( $regra );
	
	$consulta = $banco->executaSQL();
	$consulta = $consulta->fetchAll();
	$consulta = $consulta[0];
	
	$titulo = 	utf8_encode( $consulta['ds_titulo'] );
	$arquivo = $consulta['ds_arquivo'];
}
else{
	$titulo = "";
	$arquivo = "";
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
				<h2 class="title-painel title">Cadastro de Notícia</h2>
				<?php if( isset( $_SESSION['msg'] ) ) : ?>
				<p class="message <?=$_SESSION['tipo']?>">
					<?=$_SESSION['msg']?>
				</p>
				<?php endif;
				unset( $_SESSION['msg'] );
				unset( $_SESSION['tipo'] );
				?>
				<form action="salvar.php" method="post" class="form-padrao" enctype="multipart/form-data">
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Título do arquivo</label>
						<input type="text" class="input" name="titulo" maxlength="100" required value="<?=$titulo?>">
					</fieldset>
					<?php if ( !empty( $arquivo ) ): ?>
						<p class="message sucesso">
							Arquivo já cadastrado! <br>
							Para visualizar o arquivo já cadastrado 
							<a href="/uploads/documentos/<?=$arquivo?>" download class="link-padrao">CLIQUE AQUI</a>.<br>
							Caso deseje alterar o arquivo, faça o upload de um novo.
						</p>
						<div class="spaceblock clear"></div>
						<p>
							</p>
					<?php endif; ?>
					<fieldset class="fieldset">
						<label class="legenda">Documento</label>
						<input type="file" name="doc" class="input">
						</fieldset>
					<input type="hidden" name="att" value="<?=$_GET['att']?>">
					<button class="btn-painel">Salvar</button>
				</form>
			</main>
		</div>
	</section>
</div>
<?php 
include $_SERVER['DOCUMENT_ROOT']."/admin/includes/scripts.php";
	
	if( !empty( $imagem ) ) :
?>
<link rel="stylesheet" href="/js/plugins/fancybox/jquery.fancybox.css">
<script src="/js/plugins/fancybox/jquery.fancybox.js"></script>
<script>
	$( '[data-fancybox]' ).fancybox();	
</script>
<?php endif;?>
<script src="/js/plugins/mask/jquery.maskedinput.min.js"></script>
<script>
	$( '[data-validate="date"]' ).mask( '99/99/9999' );
</script>
</body>
</html>