<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/admin/autentica.php";

if ( empty( $_POST['att'] ) && !empty( $_POST['titulo'] ) ) {
	 
	if ( !empty( $_FILES['doc']['tmp_name'] ) ) {
		
		require_once $_SERVER['DOCUMENT_ROOT'].'/config/classes/fileupload.php';
		
		$caminho = $_SERVER['DOCUMENT_ROOT']."/uploads/documentos/";
		
		$arquivo = new FileUpload( $caminho , $_FILES['doc'] , 'documento' );
		
		if ( $arquivo->doUpload() ) {
			
			$banco = new Banco();
	
			$SQL = "INSERT INTO tb_documentos ( ds_titulo , ds_arquivo ) VALUES ( :ds_titulo , :ds_arquivo ) ;";
			
			$regras = array(
			':ds_titulo'		=>		utf8_decode( $_POST['titulo'] )		,
			':ds_arquivo'		=>		$arquivo->fileName
			);
			
			$banco->preparaSQL( $SQL );
			$banco->bindSQL( $regras );
			
			$retorno = $banco->executaSQL();
			
			if ( $retorno->rowCount() ) {
				$_SESSION['msg'] = "Arquivo cadastrado com sucesso!";
				$_SESSION['tipo'] = "sucesso";
				Header( "Location: /admin/modulos/documentos/gerenciar.php" );
			}
			else{
				$_SESSION['msg'] = "Falha ao cadastrar arquivo. Por favor, tente novamente!";
				$_SESSION['tipo'] = "erro";
				Header( "Location: /admin/modulos/documentos/gerenciar.php" );
			}
		}
		else{
			$_SESSION['msg'] = "Falha ao cadastrar arquivo. Por favor, tente novamente!";
			$_SESSION['tipo'] = "erro";
			Header( "Location: /admin/modulos/documentos/gerenciar.php" );
		}
	}
	
}
else if( !empty( $_POST['att'] ) && !empty( $_POST['titulo'] ) ){
	$banco = new Banco();
	$clausulaDoc = ( !empty( $_FILES['doc']['tmp_name'] ) ) ? ' , ds_arquivo = :ds_arquivo' : '';
	$SQL = "UPDATE tb_documentos SET ds_titulo = :ds_titulo $clausulaDoc WHERE id_documento = :id_documento ; ";
	
	$regras = array(
	':ds_titulo'		=>		utf8_decode( $_POST['titulo'] ) ,
	':id_documento'		=>		$_POST['att']	
	);
	
	if ( !empty( $_FILES['doc']['tmp_name'] ) ) {
		require_once $_SERVER['DOCUMENT_ROOT'].'/config/classes/fileupload.php';
		$caminho = $_SERVER['DOCUMENT_ROOT']."/uploads/documentos/";
		$arquivo = new FileUpload( $caminho , $_FILES['doc'] , 'documento' );
		
		if ( $arquivo->doUpload() ) {
			$regras[':ds_arquivo'] = $arquivo->fileName;
		}
	}
	
	$banco->preparaSQL( $SQL );
	
	$banco->bindSQL( $regras );
	
	$retorno = $banco->executaSQL();
	
	if ( $retorno->rowCount() ) {
		$_SESSION['msg'] = "Arquivo alterado com sucesso!";
		$_SESSION['tipo'] = "sucesso";
		Header( "Location: /admin/modulos/documentos/gerenciar.php" );
	}
	
}
else{
	$_SESSION['msg'] = "Por favor, preencha os dados corretamente!";
	$_SESSION['tipo'] = "erro";
	Header( "Location: /admin/modulos/documentos/gerenciar.php" );
}
?>