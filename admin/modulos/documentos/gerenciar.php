<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/autentica.php";
$banco = new Banco();
$SQL = "SELECT * FROM tb_documentos ;";
$banco->preparaSQL( $SQL );
$consulta = $banco->executaSQL();
$consulta = $consulta->fetchAll();
$consulta = $consulta;
?>
<!DOCTYPE html>
<html>
<head>
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/includes/partial-head.php';?>
	<title>Projeto Nova Era</title>	
</head>
<body class="body">
	<section class="painel-geral">
		<h1 class="title-painel title">Painel Administrativo - Projeto Nova Era</h1>
		<div class="wrapper-painel">
			<?php include $_SERVER['DOCUMENT_ROOT']."/admin/includes/aside.php";?>
			<main class="conteudo-painel">
				<h2 class="title-painel title">Cadastro</h2>
				<?php if( isset( $_SESSION['msg'] ) ) : ?>
				<p class="message <?=$_SESSION['tipo']?>">
					<?=$_SESSION['msg']?>
				</p>
				<?php endif;
				unset( $_SESSION['msg'] );
				unset( $_SESSION['tipo'] );
				?>
				<table class="table" width="100%">
					<thead>
						<th>Título</th>
						<th>Ações</th>
					</thead>
					<tbody>
						<?php foreach( $consulta as $campo ) : ?>
						<tr>
							<td>
							<?=$campo['ds_titulo']?>
							</td>
							<td>
								<a href="/admin/modulos/documentos/dados.php?att=<?=$campo['id_documento']?>">Editar</a> 
								<a href="/admin/modulos/documentos/excluir.php?att=<?=$campo['id_documento']?>" data-validate="sure">Excluir</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</main>
		</div>
	</section>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/includes/scripts.php';?>
<link rel="stylesheet" href="/js/plugins/fancybox/jquery.fancybox.css">
<script src="/js/plugins/fancybox/jquery.fancybox.js"></script>
<script>
	$( '[data-fancybox]' ).fancybox();	
</script>
<script>
	$( '[data-validate="sure"]' ).on( 'click' , function(){
		event.preventDefault();
		confirm( "Tem certeza que deseja excluir o documento selecionado?" ) ? window.location.href = this.href : false;
	});
</script>
</body>
</html>