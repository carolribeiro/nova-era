<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/config/classes/banco.php";

$banco = new Banco();

$SQL = "SELECT * FROM tb_noticias WHERE id_noticia = :id_noticia ;";
$banco->preparaSQL( $SQL );

$regra[':id_noticia'] = $_GET['noticia'];

$banco->bindSQL( $regra );

$consulta = $banco->executaSQL();

$consulta = $consulta->fetchAll();
$consulta = $consulta[0];
?>
<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/partial-head.php';?>
	<title>Projeto Nova Era</title>	
</head>
<body class="body">
	<?php include 'includes/header.php';?>
	<section class="section noticias-interna">
		<div class="wrapper">
			<div class="conteudo-noticia">
				<h2 class="title"><?=utf8_encode( $consulta['ds_titulo'] )?></h2>
				<h3 class="subtitle"><?=utf8_encode( $consulta['ds_subtitulo'] )?></h3>
				<?php if( !empty( $consulta['ds_imagem'] ) ) :?>
				<figure class="figure">
					<img src="/uploads/noticias/images/<?=utf8_encode( $consulta['ds_imagem'] )?>" alt="" class="img">
				</figure>
				<?php endif;?>
				<p class="text">
					<?=utf8_encode( $consulta['ds_noticia'] )?>
				</p>
				<?php if( !empty( $consulta['ds_fonte'] ) ) :?>
				<p class="text fonte">
					<?=utf8_encode( $consulta['ds_fonte'] )?> <a href="<?=utf8_encode( $consulta['ds_link_fonte'] )?>" class="link-fonte" target="_blank"><?=utf8_encode( $consulta['ds_link_fonte'] )?></a>
				</p>
				<?php endif;?>
				
			</div>
			<aside class="aside-noticia">
				<h3 class="title title-aside">Veja também</h3>
				<?php
					$SQL = "SELECT * FROM tb_noticias WHERE id_noticia <> :id_noticia LIMIT 3;";
					$banco->preparaSQL( $SQL );
					$banco->bindSQL( $regra );
					$consulta = $banco->executaSQL();
					$consulta = $consulta->fetchAll();
				?>
				<ul class="noticias-list">
					<?php foreach( $consulta as $campo ) :?>
					<li class="li">
						<a href="noticias-integra.php?noticia=<?=$campo['id_noticia']?>" class="titulo">
							<?=utf8_encode( $campo['ds_titulo'] )?>
						</a>
					</li>
					<?php endforeach;?>
				</ul>
			</aside>
		</div>
	</section>
	<?php include 'includes/footer.php';?>
	<?php include 'includes/scripts.php';?>
</body>
</html>