
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
				<h2 class="title"></h2>
				<h3 class="subtitle"></h3>
				<figure class="figure">
					<img src="/uploads/noticias/images/" alt="" class="img">
				</figure>
			 	endif;
				<p class="text">
				</p>
				</p>
				if( !empty( $consulta['ds_fonte'] ) )
				<p class="text fonte">
					<a href="noticias-integra.php" class="link-fonte" target="_blank"></a>
				</p>


			</div>
			<aside class="aside-noticia">
				<h3 class="title title-aside">Veja também</h3>
				<ul class="noticias-list">
					<li class="li">
						<a href="noticias-integra.php" class="titulo">
						</a>
					</li>
				</ul>
			</aside>
		</div>
	</section>
	<?php include 'includes/footer.php';?>
	<?php include 'includes/scripts.php';?>
</body>
</html>
