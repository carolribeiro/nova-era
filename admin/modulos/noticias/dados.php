<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/autentica.php";

if ( isset( $_GET['att'] ) && !empty( (int)$_GET['att'] ) ) {
	$banco = new Banco();
	$SQL = "SELECT * FROM tb_noticias WHERE id_noticia = :id_noticia ;";
	$banco->preparaSQL( $SQL );
	$regra[':id_noticia'] = (int)$_GET['att'];
	$banco->bindSQL( $regra );
	
	$consulta = $banco->executaSQL();
	$consulta = $consulta->fetchAll();
	$consulta = $consulta[0];
	
	$quebrasDeLinha = array( '<br>' , '<br />' , '<br/>');
	
	$titulo = utf8_encode( $consulta['ds_titulo'] );
	$subtitulo = utf8_encode( $consulta['ds_subtitulo'] );
	$imagem = utf8_encode( $consulta['ds_imagem'] );
	$texto =  preg_replace('#<br\s*/?>#i', "\n" , utf8_encode( $consulta['ds_noticia'] ) );
	$fonte = utf8_encode( $consulta['ds_fonte'] );
	$link = utf8_encode( $consulta['ds_link_fonte'] );
	$data = date_format( date_create( $consulta['ds_data'] ) , "d/m/Y");
}
else{
	$titulo = "";
	$subtitulo = "";
	$imagem = "";
	$texto = "";
	$fonte = "";
	$link = "";
	$data = date_format( date_create( $consulta['ds_data'] ) , "d/m/Y");
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
						<label for="titulo" class="legenda">Título</label>
						<input type="text" class="input" name="titulo" maxlength="100" required value="<?=$titulo?>">
					</fieldset>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Subtítulo</label>
						<input type="text" class="input" name="subtitulo" maxlength="100" value="<?=$subtitulo?>">
					</fieldset>
					<fieldset class="fieldset fd-30">
						<label for="titulo" class="legenda">Data</label>
						<input type="text" class="input" name="data" maxlength="10" data-validate="date" value="<?=$data?>">
					</fieldset>
					<?php if( !empty( $imagem ) ) : ?>
					<fieldset class="fieldset">
						<label class="legenda">Imagem cadastada</label>
						<a href="/uploads/noticias/images/<?=$imagem?>" data-fancybox class="legenda"><i class="fa fa-camera-retro" aria-hidden="true"></i> Clique aqui para visualizar a imagem atual</a>
					</fieldset>
					<?php endif;?>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Imagem</label>
						<input type="file" class="input" name="imagem">
					</fieldset>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Texto</label>
						<textarea id="" cols="30" rows="10" class="input" name="texto" required><?=$texto?></textarea>
					</fieldset>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Fonte</label>
						<input type="text" class="input" name="fonte" maxlength="100" value="<?=$fonte?>">
					</fieldset>
					<fieldset class="fieldset">
						<label for="titulo" class="legenda">Link da fonte</label>
						<input type="text" class="input" name="link-fonte" maxlength="100" value="<?=$link?>">
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