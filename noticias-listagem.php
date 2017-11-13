<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/partial-head.php';?>
	<title>Projeto Nova Era</title>
</head>
<body class="body">
	<?php include 'includes/header.php';?>
	<section class="section noticias">
		<div class="wrapper">
		<h2 class="title-geral">notícias</h2>
			<ul class="noticias-list">
				<li class="li" data-anchor="elemento">
					<span class="titulo"></span>
					<p class="chamada"></p>
					<a href="" class="veja-integra">ver notícia completa</a>
				</li>
			</ul>
			<ul class="paginacao-list">
				<!--<li class="li"><a href="#" class="link">&lsaquo;</a></li>-->
				<!--<li class="li"><a href="#" class="link">1</a></li>-->
				<!--<li class="li"><a href="#" class="link">2</a></li>-->
				<!--<li class="li"><a href="#" class="link">3</a></li>-->
				<!--<li class="li"><a href="#" class="link">&rsaquo;</a></li>-->
				<li class="li"><a data-contador="1" data-carregar class="link" style="cursor:pointer;">VER MAIS</a></li>
			</ul>
		</div>
	</section>
	<?php include 'includes/footer.php';?>
	<?php include 'includes/scripts.php';?>
	<script>
		$( '[data-carregar]' ).on( 'click' , function(){
			var ultimo = $( this ).attr( 'data-contador' );
			$( this ).attr( 'data-contador' , ( parseInt( $( this ).attr( 'data-contador' ) ) + 1 ) );
			var dataSend = {
				last : ultimo ,
				type : 1
			};
			$.get( 'ajax-listagem.php' , dataSend , function( dataReturn ){
				console.log( dataReturn.jvar );
				dataJSON = JSON.parse( dataReturn );
				if( !dataJSON.length ){
					console.log( $( '[data-carregar]' ).html( 'SEM MAIS NOTÍCIAS' ).css( 'cursor' , 'default') );
				}
				else{
					for( var i = 0 ; i < dataJSON.length ; i++ ){
						var elemento = $( '[data-anchor="elemento"]:last' ).clone();
						elemento.find( '.titulo' ).html( dataJSON[i].ds_titulo );
						elemento.find( '.chamada' ).html( dataJSON[i].ds_subtitulo );
						elemento.find( '.veja-integra' ).attr('href', 'noticias-integra.php?noticia='+dataJSON[i].id_noticia );
						$( '.noticias-list' ).append( elemento );
					}
				}
			});
		});
	</script>
</body>
</html>
