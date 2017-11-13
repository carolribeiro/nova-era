<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/admin/autentica.php";

if ( !empty( $_GET['att'] ) ) {
	$SQL = "DELETE FROM tb_noticias WHERE id_noticia = :id_noticia ;";
	$banco = new Banco();
	$banco->preparaSQL( $SQL );
	$regra[':id_noticia'] = $_GET['att'];
	$banco->bindSQL( $regra );
	
	$retorno = $banco->executaSQL();
	
	if ( $retorno->rowCount() ) {
		$_SESSION['msg'] = "Notícia excluída com sucesso";
		$_SESSION['tipo'] = "sucesso";
		Header( "Location: /admin/modulos/noticias/gerenciar.php" );
	}
	else{
		$_SESSION['msg'] = "Erro ao excluir notícia. Por favor, tente novamente!";
		$_SESSION['tipo'] = "erro";
		Header( "Location: /admin/modulos/noticias/gerenciar.php" );
	}

}
else{
	$_SESSION['msg'] = "Por favor, preencha os dados corretamente";
	$_SESSION['tipo'] = "erro";
	Header( "Location: /admin/modulos/noticias/gerenciar.php" );
}

?>