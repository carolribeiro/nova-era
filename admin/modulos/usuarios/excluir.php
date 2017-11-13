<?php
session_start();

if ( $_SESSION['regraAdmin'] && !empty( $_GET['att'] ) ) {
	// classe do banco
	include $_SERVER['DOCUMENT_ROOT'].'/config/classes/banco.php';
	
	$banco = new Banco();
	
	$SQL = "DELETE FROM tb_usuarios WHERE id_usuario = :id_usuario ;";
	$banco->preparaSQL( $SQL );
	$regra[':id_usuario'] = utf8_decode( (int)$_GET['att'] );
	$banco->bindSQL( $regra );
	
	$retorno = $banco->executaSQL();

	if ( !$retorno->rowCount() ) {
		$_SESSION['msg'] = "Falha ao excluir usuário, por favor, tente novamente!";
		$_SESSION['tipo'] = "erro";
		Header( "Location: /admin/modulos/usuarios/gerenciar.php" );
	}
	else{
		$_SESSION['msg'] = "Usuário excluído com sucesso!";
		$_SESSION['tipo'] = "sucesso";
		Header( "Location: /admin/modulos/usuarios/gerenciar.php" );
	}
}
else{
	$_SESSION['msg'] = "Por favor, preencha os dados corretamente";
	$_SESSION['tipo'] = "erro";
	Header( "Location: /admin/modulos/usuarios/dados.php" );
}
?>