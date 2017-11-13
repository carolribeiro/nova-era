<?php
session_start();
// CLASSE PARA AUTENTICAÇÃO
require_once $_SERVER['DOCUMENT_ROOT']."/config/classes/auth.php";
Auth::logoff();
Header("Location: /admin/login.php");
?>