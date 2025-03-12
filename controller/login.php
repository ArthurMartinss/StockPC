<?php
if(!isset($_POST['email']))
    header('Location:../view/index.php');

require_once('../model/UsuarioDAO.php');
session_start();
$dao = new UsuarioDAO();
$usuario = $dao->obter_por_email($_POST['email']);
if(!$usuario){
    $_SESSION['login_err']=true;
    if(isset($_POST['redirect']))
        $_SESSION['redirect']=$_POST['redirect'];
    header('Location:../view/login.php');
}

if(password_verify($_POST['senha'], $usuario->get_senha())) {
    $_SESSION["email_usuario"] = $usuario->get_email();
    $_SESSION["id_usuario"] = $usuario->get_id_usuario();
    if(isset($_POST['redirect'])){
        header('Location:'.$_POST['redirect']);
    }else{
        header('Location:../view/index.php');
    }
}else{
    $_SESSION['login_err']=true;
    if(isset($_POST['redirect']))
        $_SESSION['redirect']=$_POST['redirect'];
    header('Location:../view/login.php');
}

    
?>
