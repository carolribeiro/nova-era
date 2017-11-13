<?php
include $_SERVER['DOCUMENT_ROOT']."/admin/autentica.php";

if ( !$_SESSION['regraAdmin'] ) {
	$_SESSION['msg'] = "Você não possui acesso a essa área";
	$_SESSION['tipo'] = "erro";
	Header( "Location: " . DataSources::urlAdmin() );
	die();
}

$banco = new Banco();
$SQL = "SELECT * FROM tb_usuarios WHERE cd_tipo > :cd_tipo ;";
$banco->preparaSQL( $SQL );

$regra[ ':cd_tipo' ] = $_SESSION['cd_tipo'];
$banco->bindSQL( $regra );

$consulta = $banco->executaSQL();
$consulta = $consulta->fetchAll();
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
				<h2 class="title-painel title">Usuários do Sistema</h2>
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
						<th>Nome</th>
						<th>E-mail</th>
						<th>Login</th>
						<th>Tipo</th>
					</thead>
					<tbody>
						<?php foreach ( $consulta as $campo ) : ?>
							<tr>
							<td><?=utf8_encode( $campo['ds_nome'] )?></td>
							<td><?=utf8_encode( $campo['ds_email'] )?></td>
							<td><?=utf8_encode( $campo['ds_login'] )?></td>
							<td>
								<table width="100%">
									<tr>
										<td width="50%" class="no-pd" align="center">
											<a href="/admin/modulos/usuarios/dados.php?att=<?=$campo['id_usuario']?>" class="link">Editar</a>
										</td>
										<td width="50%" class="no-pd" align="center">
											<a href="/admin/modulos/usuarios/excluir.php?att=<?=$campo['id_usuario']?>" data-validate="sure" class="link">Excluir</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</main>
		</div>
	</section>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/includes/scripts.php';?>
<script>
	$( '[data-validate="sure"]' ).on( 'click' , function(){
		event.preventDefault();
		confirm( "Deseja realmente excluir o usuário selecionado?" ) ? window.location.href = $( this ).attr( 'href' ) : false;
	});
</script>
</body>
</html>