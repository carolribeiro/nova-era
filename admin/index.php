<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/autentica.php";
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
			<?php include 'includes/aside.php';?>
			<main class="conteudo-painel">
				<?php if( !empty( $_SESSION['msg'] ) ) : ?>
					<p class="message <?=$_SESSION['tipo']?>">
						<?=$_SESSION['msg']?>
					</p>
				<?php endif;
				unset( $_SESSION['msg'] );
				unset( $_SESSION['tipo'] );
				?>
				<p class="title-painel title">
					Olá, <strong><?=$_SESSION['user'];?></strong>! Seja bem vind@ ao painel administrativo do <strong>Projeto Nova Era!</strong> <br>
					Qualquer dúvida, entre em contato conosco através do telefone (13) 3227-4834 ou pelo e-mail <a href="contato@projetonovaera.com.br" class="link-padrao"><strong>contato@projetonovaera.com.br</strong></a>
				</p>
			</main>
		</div>
	</section>
</div>
<?php include $_SERVER['DOCUMENT_ROOT']."/admin/includes/scripts.php"; ?>
</body>
</html>