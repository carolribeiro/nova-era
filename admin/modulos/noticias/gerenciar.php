<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/autentica.php";
$banco = new Banco();
$SQL = "SELECT * FROM tb_noticias ORDER BY id_noticia DESC;";
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
						<th>Imagem</th>
						<th>Data</th>
						<th>Ações</th>
					</thead>
					<tbody>
						<?php foreach( $consulta as $campo ) : ?>
						<tr>
							<td><?=utf8_encode( $campo['ds_titulo'] )?></td>
							<?php if( !empty( $campo['ds_imagem'] ) ) :?>
								<td><a href="/uploads/noticias/images/<?=$campo['ds_imagem']?>" data-fancybox style="text-decoration:none; font-size:25px;"><i class="fa fa-camera-retro" aria-hidden="true"></i></a></td>
							<?php else: ?>
								<td>Não cadastrada</td>
							<?php endif;?>
							<?php if( !empty( $campo['ds_data'] ) ) :?>
								<td><?=date_format( date_create( $campo['ds_data'] ) , "d/m/Y")?></td>
							<?php else: ?>
								<td>Não cadastrada</td>
							<?php endif;?>
							<td>
								<a href="/admin/modulos/noticias/dados.php?att=<?=$campo['id_noticia']?>">Editar</a> 
								<a href="/admin/modulos/noticias/excluir.php?att=<?=$campo['id_noticia']?>" data-validate="sure">Excluir</a>
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
		confirm( "Tem certeza que deseja excluir a notícia selecionada?" ) ? window.location.href = this.href : false;
	});
</script>
</body>
</html>