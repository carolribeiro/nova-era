<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config/classes/banco.php";
$banco = new Banco();
$SQL = "SELECT * FROM tb_documentos ORDER BY id_documento DESC LIMIT 10 ;";
$banco->preparaSQL( $SQL );
$consulta = $banco->executaSQL();
$consulta = $consulta->fetchAll();
$consulta = $consulta;
?>
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
			<h2 class="title-geral">Documentos</h2>
			<ul class="noticias-list">
				<?php foreach( $consulta as $campo ): ?>
				<li class="li" data-anchor="elemento">
					<span class="titulo"><?=utf8_encode( $campo['ds_titulo'] )?></span>
					<a href="/uploads/documentos/<?=$campo['ds_arquivo']?>" download class="veja-integra doc"><i class="fa fa-file-o" area-hidden="true"></i>baixar</a>
				</li>
				<?php endforeach; ?>
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
				type : 2
			};
			$.get( 'ajax-listagem.php' , dataSend , function( dataReturn ){
				dataJSON = JSON.parse( dataReturn );
				if( !dataJSON.length ){
					console.log( $( '[data-carregar]' ).html( 'SEM MAIS DOCUMENTOS' ).css( 'cursor' , 'default') );
				}
				else{
					for( var i = 0 ; i < dataJSON.length ; i++ ){
						var elemento = $( '[data-anchor="elemento"]:last' ).clone();
						elemento.find( '.titulo' ).html( dataJSON[i].ds_titulo );
						elemento.find( '.veja-integra' ).attr('href', '/uploads/documentos/'+dataJSON[i].ds_arquivo );
						$( '.noticias-list' ).append( elemento );
					}
				}
			});
		});
	</script>
</body>
</html>