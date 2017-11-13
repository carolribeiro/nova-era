<?php
session_start();
// CLASSE PARA AUTENTICAÇÃO
require_once $_SERVER['DOCUMENT_ROOT']."/config/classes/auth.php";
// SE NÃO ESTIVER AUTENTICADO
if ( !$_SESSION['auth'] ) {
    // SE ESTIVER COM VALORES VINDO POR POST
    if ( $_POST ) {
        // SE NÃO AUTENTICAR
        if ( !Auth::login( $_POST['login'] , $_POST['password'] ) ) {
           $_SESSION['finalizacao'] = "erro";
           $_SESSION['msg-final'] = "Dados incorretos ou você não possui permissão";
           Header( "Location:/admin/login.php" );
           die();
       }
        // SE AUTENTICAR
       else{
           $_SESSION['login'] = $_POST['login'];
           $_SESSION['password'] = $_POST['password'];
           $_SESSION['auth'] = true;
                       
            //autenticacao de admin e webmaster para cadastro e alteração de usuarios
            $banco = new Banco();
            $SQL = "SELECT * FROM tb_usuarios WHERE ds_login = :ds_login AND ds_senha = :ds_senha ;";
            $banco->preparaSQL( $SQL );
            $regras = [
            	':ds_login'		=>		$_SESSION['login'] ,
            	':ds_senha'		=>		$_SESSION['password']
            ];
            $banco->bindSQL( $regras );
            $consulta = $banco->executaSQL();
            $consulta = $consulta->fetchAll();
            $cd_tipo = (int)$consulta[0]['cd_tipo'];
            
            //verifica se o codigo eh maior que 1 (webmaster) ou 2 (administrador) e marca uma regra
            
            $_SESSION['regraAdmin'] = ( $cd_tipo <= 2 );
            
            // nome da pessoa
            $_SESSION['user']       =       utf8_encode( $consulta[0]['ds_nome'] );
            $_SESSION['id']         =       $consulta[0]['id_usuario'];
            $_SESSION['cd_tipo']    =       (int)$consulta[0]['cd_tipo'];
            
            
           Header( "Location:/admin/index.php" ); 
       }
   }
       else{
        $_SESSION['finalizacao'] = "erro";
        $_SESSION['msg-final'] = "Preencha os dados corretamente para acessar";
        Header( "Location:/admin/login.php" );
        die();
    }
}
?>