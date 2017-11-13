<?php
session_start();

include $_SERVER['DOCUMENT_ROOT']."/admin/autentica.php";

if ( !empty( $_POST['titulo'] ) && !empty( $_POST['texto'] ) ) {
	
	$regras = array();
	
	if ( !empty( $_POST['att'] ) ) {
		$id_noticia = $_POST['att'];
		$clausulaImg = !empty( $_FILES['imagem']['tmp_name'] ) ? " , ds_imagem = :ds_imagem  " : "";
		$SQL = "UPDATE tb_noticias "
				." SET ds_titulo = :ds_titulo , ds_subtitulo = :ds_subtitulo , ds_noticia = :ds_noticia , ds_fonte = :ds_fonte , ds_link_fonte = :ds_link_fonte , ds_data = :ds_data $clausulaImg WHERE id_noticia = $id_noticia ;";
	}
	else{
		$clausulaImg =  !empty( $_FILES['imagem']['tmp_name'] ) ? " , ds_imagem " : "";
		$valorClausulaImg = !empty( $_FILES['imagem']['tmp_name'] ) ? " , :ds_imagem " : "";
		$SQL = "INSERT INTO tb_noticias ( ds_titulo , ds_subtitulo , ds_noticia , ds_fonte , ds_link_fonte , ds_data $clausulaImg ) "
			." VALUES ( :ds_titulo , :ds_subtitulo , :ds_noticia , :ds_fonte , :ds_link_fonte , :ds_data $valorClausulaImg ) ;";
			
	}
			
	$banco = new Banco();

	$banco->preparaSQL( $SQL );
	
	$texto = nl2br( utf8_decode( $_POST['texto'] ) );
	$texto = preg_replace( '~\r\n?~' , "\n" , $texto );

	$regras = [
		':ds_titulo'				=>		utf8_decode( $_POST['titulo'] )			,
		':ds_subtitulo'				=>		utf8_decode( $_POST['subtitulo'] )		,
		':ds_noticia'				=>		$texto									,
		':ds_fonte'					=>		utf8_decode( $_POST['fonte'] )			,
		':ds_link_fonte'			=>		utf8_decode( $_POST['link-fonte'] )		,
	];

	if ( !empty( $_FILES['imagem']['tmp_name'] ) ) {
		
		require_once $_SERVER['DOCUMENT_ROOT']."/config/classes/fileupload.php";
		
		$path = $_SERVER['DOCUMENT_ROOT'].'/uploads/noticias/images/';
		$arquivo = new FileUpload( $path , $_FILES['imagem'] , 'noticias' );
		$arquivo->doUpload();
		$regras[':ds_imagem'] = $arquivo->fileName;
	}
	
	// data
	
	$data = join( "-" , array_reverse( explode( '/' , $_POST['data'] ) ) );
	$data = date( 'Y-m-d', strtotime( $data ) );
	
	$regras[':ds_data'] = $data;
	
	/*echo $SQL . "<br><br><br>";
	var_dump( $regras );
	die();*/
	
	$banco->bindSQL( $regras );
	
	$retorno = $banco->executaSQL();
	
	if ( $retorno->rowCount() ) {
		$_SESSION['msg'] = "Notícia cadastrada com sucesso!";
		$_SESSION['tipo'] = "sucesso";
		Header( "Location: /admin/modulos/noticias/dados.php" );
	}
	else{
		$_SESSION['msg'] = "Falha ao cadastrar notícia. Por favor, tente novamente!";
		$_SESSION['tipo'] = "erro";
		Header( "Location: /admin/modulos/noticias/dados.php" );
	}

}
else{
	$_SESSION['msg'] = "Por favor, preencha os dados corretamente";
	$_SESSION['tipo'] = "erro";
	Header( "Location: /admin/modulos/noticias/dados.php" );
}

?>