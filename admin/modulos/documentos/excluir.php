<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/admin/autentica.php";

if ( !empty( $_GET['att'] ) ) {
	$SQL = "DELETE FROM tb_documentos WHERE id_documento = :id_documento ;";
	$banco = new Banco();
	$banco->preparaSQL( $SQL );
	$regra[':id_documento'] = $_GET['att'];
	$banco->bindSQL( $regra );
	
	$retorno = $banco->executaSQL();
	
	if ( $retorno->rowCount() ) {
		$_SESSION['msg'] = "Documento excluído com sucesso";
		$_SESSION['tipo'] = "sucesso";
		Header( "Location: /admin/modulos/documentos/gerenciar.php" );
	}
	else{
		$_SESSION['msg'] = "Erro ao excluir documento. Por favor, tente novamente!";
		$_SESSION['tipo'] = "erro";
		Header( "Location: /admin/modulos/documentos/gerenciar.php" );
	}

}
else{
	$_SESSION['msg'] = "Por favor, preencha os dados corretamente";
	$_SESSION['tipo'] = "erro";
	Header( "Location: /admin/modulos/documentos/gerenciar.php" );
}

?>