<?php
	if ( !empty( $_GET['last'] ) && !empty( $_GET['type'] ) ) {
	    
	    require_once $_SERVER['DOCUMENT_ROOT'].'/config/classes/banco.php';
	    
	    $banco = new Banco();
	    
		   switch ( (int)$_GET['type'] ) {
		   	case 2 :
		   		$SQL = "SELECT * FROM tb_documentos ORDER BY id_documento DESC LIMIT 10 OFFSET :offset ;";
		   		break;
		   	default:
		   		$SQL = "SELECT * FROM tb_noticias ORDER BY id_noticia DESC LIMIT 10 OFFSET :offset ;";
		   		break;
		   }
	    
	    $banco->preparaSQL( $SQL );
	    
	    $regraAjax[':offset'] 	= 	( (int)($_GET['last'] * 10) );
	    
	    $banco->bindSQL( $regraAjax );
	    
	    $consulta = $banco->executaSQL();

        $consulta = $consulta->fetchAll();
        
        echo json_encode( $consulta ); 
	}
?>