<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/partial-head.php';?>
	<title>Projeto Nova Era</title>	
</head>
<body class="body">
	<?php include 'includes/header.php';?>
	<section class="section contato">
		<div class="wrapper">
			<h2 class="title-geral">Contato</h2>
			<div class="box-form">
				<form action="" class="form">
					<div class="linha">
						<fieldset class="fieldset fd-100">
							<input type="text" placeholder="Nome" class="input">
						</fieldset>
					</div>
					<div class="linha">
						<fieldset class="fieldset fd-50">
							<input type="email" placeholder="E-mail" class="input">
						</fieldset>
						<fieldset class="fieldset fd-50">
							<input type="text" placeholder="DDD + Telefone" class="input" data-validate="telefone">
						</fieldset>
					</div>
					<div class="linha">
						<textarea name="" id="" cols="30" rows="10" class="input" placeholder="Mensagem"></textarea>
					</div>
					<div class="linha">
						<button class="btn-enviar">enviar</button>
					</div>
				</form>
			</div>
			<div class="box-address">
				<h3 class="title-geral small">Endereço</h3>
				<iframe class="iframe-mapa" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJhxD_ElACzpQRHVfst2S4SGI&key=AIzaSyB6u6LQ8WK7ijXnxirwMc_vO2bj5USDKtA" allowfullscreen></iframe>
				<address class="address">
					<strong>FATEC SANTOS - Rubens Lara</strong> <br>
					Av. Bartolomeu de Gusmão, 110 - Aparecida, Santos - SP, 11045-908
				</address>
				<h3 class="title-geral small">Telefone</h3>
				<p class="address tel">
					<strong>(13) 3227-4834</strong>
				</p>
			</div>
		</div>
	</section>
	<?php include 'includes/footer.php';?>
	<?php include 'includes/scripts.php';?>
	<!-- VALIDAÇÃO -->
	<script src="js/plugins/mask/jquery.maskedinput.min.js"></script>
	<script>
		$(function(){
			$( '[data-validate="telefone"]' ).mask( '(99) 9?9999-9999' );
		});
	</script>
</body>
</html>