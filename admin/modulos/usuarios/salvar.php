<?php
session_start();

if ( $_SESSION['regraAdmin'] && $_POST && !empty( $_POST['nome'] ) && !empty( $_POST['email'] ) && !empty( $_POST['tipo'] ) && ( $_POST['tipo'] == 2 || $_POST['tipo'] == 3 ) && !empty( $_POST['login'] ) && !empty( $_POST['senha'] ) && !empty( $_POST['confirma-senha'] ) && ( $_POST['senha'] == $_POST['confirma-senha'] ) ) {
	
	// classe do banco
	include $_SERVER['DOCUMENT_ROOT'].'/config/classes/banco.php';
	// banco
	$banco = new Banco();
	// variaveis
	$nome		=		utf8_decode( $_POST['nome'] );
	$email		=		utf8_decode( $_POST['email'] );
	$login		=		utf8_decode( $_POST['login'] );
	$senha		=		utf8_decode( $_POST['senha'] );
	$tipo		=		utf8_decode( (int)$_POST['tipo'] );
	// regras para bind
	$regras = [
		':ds_nome' 		=> 		$nome		,
		':ds_email' 	=>		$email		,
		':ds_login'		=>		$login		,
		':ds_senha'		=>		$senha		,
		':cd_tipo'		=>		$tipo
	];
	// verifica se é atualizacao ou nao, caso tenha valor vindo como att
	if ( !empty( $_POST['att'] ) ) {
	
	$SQL = "UPDATE tb_usuarios "
			." SET ds_nome = :ds_nome , ds_email = :ds_email , ds_login = :ds_login , ds_senha = :ds_senha , cd_tipo = :cd_tipo "
			." WHERE id_usuario = :id_usuario ;";
	
	// regra caso seja att
	$regras[':id_usuario'] = utf8_decode( (int)$_POST['att'] );
		
	}
	else{
	// caso nao tenha valor para att é registro novo
		$SQL = "INSERT INTO tb_usuarios ( ds_nome , ds_email , ds_login , ds_senha , cd_tipo ) VALUES ( :ds_nome , :ds_email , :ds_login , :ds_senha , :cd_tipo ) ;";
	}
	// prepara sql
	$banco->preparaSQL( $SQL );
	// bind nos valores
	$banco->bindSQL( $regras );
	
	$retorno = $banco->executaSQL();
	
	if ( $retorno->rowCount() ) {
		if( !empty( $_POST['att'] ) ){
			$_SESSION['msg'] = "Usuário atualizado com sucesso!";
			$_SESSION['tipo'] = "sucesso";
		}
		else{
			$_SESSION['msg'] = "Usuário cadastrado com sucesso!";
			$_SESSION['tipo'] = "sucesso";
		}
		Header( "Location: /admin/modulos/usuarios/dados.php" );
	}
	else{
		$_SESSION['msg'] = "Falha ao salvar usuário. Por favor, tente novamente!";
		$_SESSION['tipo'] = "erro";
		Header( "Location: /admin/modulos/usuarios/dados.php" );
	}

}
else{
	$_SESSION['msg'] = "Por favor, preencha os dados corretamente";
	$_SESSION['tipo'] = "erro";
	Header( "Location: /admin/modulos/usuarios/dados.php" );
}
?>