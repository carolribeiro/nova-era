<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/partial-head.php';?>
	<title>Projeto Nova Era</title>	
	<!-- SWIPER -->
	<link rel="stylesheet" href="js/plugins/swiper/css/swiper.min.css">
</head>
<body class="body">
	<?php include 'includes/header.php';?>
	<section data-parallax="5">
		<h2 data-parallax-content>
			informática gratuita e de qualidade para a melhor idade.
		</h2>
	</section>
	<section class="ultimas wrapper">
		<div class="block block-ultimas">
			<h3 class="title">Últimas notícias</h3>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<div class="swiper-content">
							<h4 class="titulo-noticia">Título notícia</h4>
							<p class="chamada-noticia">
								Lorem ipsum dolor sit amet, suspendisse harum eget vitae sem malesuada porttitor. Pede varius, lectus eros consectetuer mollis dolor, vel tempor orci mauris. 
							</p>
							<a href="#" class="veja-mais">Veja mais</a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="swiper-content">
							<h4 class="titulo-noticia">Título notícia</h4>
							<p class="chamada-noticia">
								Lorem ipsum dolor sit amet, suspendisse harum eget vitae sem malesuada porttitor. Pede varius, lectus eros consectetuer mollis dolor, vel tempor orci mauris. 
							</p>
							<a href="#" class="veja-mais">Veja mais</a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="swiper-content">
							<h4 class="titulo-noticia">Título notícia</h4>
							<p class="chamada-noticia">
								Lorem ipsum dolor sit amet, suspendisse harum eget vitae sem malesuada porttitor. Pede varius, lectus eros consectetuer mollis dolor, vel tempor orci mauris. 
							</p>
							<a href="#" class="veja-mais">Veja mais</a>
						</div>
					</div>
				</div>
			</div>
			<div class="swiper-buttons">
				<div class="swiper-button-prev swiper-button">&lsaquo;</div>
				<div class="swiper-button-next swiper-button">&rsaquo;</div>
			</div>
		</div>
		<div class="block block-horario">
			<i class="fa fa-clock-o" aria-hidden="true"></i>
			<h3 class="title">Horário de Atendimento</h3>
			<p class="horario">
				Das xx às xx , <br>
				De xxxxx a xxxxx. <br>
				FATEC RUBENS LARA
			</p>
		</div>
	</section>
	<section class="venha">
		<div class="wrapper">
			<div class="box">venha nos visitar!</div>
		</div>
	</section>
	<?php include 'includes/footer.php';?>
	<?php include 'includes/scripts.php';?>
	<!-- TYPEWRITER -->
	<script src="js/plugins/typed/typed.js"></script>
	<script>
		var parallax = new Parallax( '[data-parallax]', '50%' );
		if( window.innerWidth > 885 ){
			$("[data-typed]").typed({
				strings: ['<span class="f">E</span>nsinando, <span class="f">a</span>prendendo, <span class="f">r</span>ealizando.'],
				typeSpeed: 50
			});
		}
		$(function(){
			$( '[data-parallax]' ).css( 'background-image' , 'url(images/bn-' +( Math.floor( Math.random() * 2 ) + 1 ) +'.jpg)');	
		});
	</script>
	<!-- SWIPER -->
	<script src="js/plugins/swiper/js/swiper.jquery.min.js"></script>
	<script>
		var mySwiper = new Swiper ('.swiper-container', {
			direction: 'horizontal',
			loop: true,	    
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev'
		});
	</script>
</body>
</html>