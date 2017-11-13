<?php
session_start();

if ( $_POST && !empty( $_POST['nome'] ) && !empty( $_POST['email'] )  && !empty( $_POST['login'] ) && !empty( $_POST['senha'] ) && !empty( $_POST['confirma-senha'] ) && ( $_POST['senha'] == $_POST['confirma-senha'] ) ) {
	
	include $_SERVER['DOCUMENT_ROOT'].'/config/classes/banco.php';
	
	$banco = new Banco();
	$SQL = "UPDATE tb_usuarios "
			." SET ds_nome = :ds_nome , ds_email = :ds_email , ds_login = :ds_login , ds_senha = :ds_senha WHERE id_usuario = " . $_SESSION['id'];
			
	$banco->preparaSQL( $SQL );

	$nome		=		utf8_decode( $_POST['nome'] );
	$email		=	 	utf8_decode( $_POST['email'] );
	$login		=		utf8_decode( $_POST['login'] );
	$senha		=		utf8_decode( $_POST['senha'] );
	
	$regras = [
		':ds_nome' 		=> 		$nome		,
		':ds_email' 	=>		$email		,
		':ds_login'		=>		$login		,
		':ds_senha'		=>		$senha
	];
	
	$banco->bindSQL( $regras );
	
	$retorno = $banco->executaSQL();
	
	if ( $retorno->rowCount() ) {
		$_SESSION['msg'] = "Dados atualizados com sucesso!";
		$_SESSION['tipo'] = "sucesso";
		Header( "Location: /admin/modulos/usuarios/configuracoes.php" );
	}
	else{
		$_SESSION['msg'] = "Falha ao atualizar dados. Por favor, tente novamente!";
		$_SESSION['tipo'] = "erro";
		Header( "Location: /admin/modulos/usuarios/configuracoes.php" );
	}

}
else{
	$_SESSION['msg'] = "Por favor, preencha os dados corretamente";
	$_SESSION['tipo'] = "erro";
	Header( "Location: /admin/modulos/usuarios/configuracoes.php" );
}
?>