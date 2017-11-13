<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<?php include 'includes/partial-head.php';?>
	<title>Projeto Nova Era</title>	
</head>
<body class="body flex">
	<div class="painel-login">
	<div class="title-painel">Painel Administrativo - Projeto Nova Era</div>
		<?php if ( isset( $_SESSION['finalizacao'] ) ) : ?>
			<p class="message <?=$_SESSION['finalizacao']?>">
				<?=$_SESSION['msg-final']?>
			</p>
		<?php endif; ?>
		<form method="post" action="autentica.php" class="form-login">
			<fieldset class="fieldset">
				<fieldset class="fieldset">
					<input type="text" class="input" placeholder="Login" name="login" required>
				</fieldset>
				<fieldset class="fieldset">
					<input type="password" class="input" placeholder="Senha" name="password" required>
				</fieldset>
				<button class="btn-painel">Entrar</button>
			</fieldset>
		</form>
	</div>
</div>
</body>
</html>