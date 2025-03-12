<?php
if(!isset($_POST['senha'])||!isset($_SESSION['id_usuario']))
    header('Location:../view/index.php');

require_once('../model/UsuarioDAO.php');
session_start();
$dao = new UsuarioDAO();
$usuario = $dao->obter($_SESSION['id_usuario']);

if(password_verify($_POST['senha'], $usuario->get_senha())) {
    $_SESSION["correspondencia"] = true;
    header('Location:../view/editar_usuario.php');
}else{
    $_SESSION['erro_senha']=true;
    header('Location:../view/confirmar_senha.php');
}

    
?>