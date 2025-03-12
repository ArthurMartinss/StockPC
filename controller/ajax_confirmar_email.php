<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, Content-Type");
session_start();
require_once("../utils/Email.php");
if(isset($_GET['reenviar'])){

    $_SESSION['codigo'] = sprintf('%06d', mt_rand(0, 999999));
    $mensagem_confirmacao = "<p>Seu código de confirmação de email é <b>".$_SESSION['codigo']."</b>.</p>";
    $destinatario = $_SESSION['email'];
    $assunto = "StockPC: Confirmação de email";
    Email::enviar_email($destinatario, $assunto, $mensagem_confirmacao);
    echo "reenviado";
}elseif(!isset($_SESSION['codigo'])){
    echo "erro";
}else{
    if($_GET['codigo']!=$_SESSION['codigo']){
        if(!isset($_SESSION['erro_confirmacao'])){
            $_SESSION['erro_confirmacao']=true;
            echo "erro";
        }else{
                unset($_SESSION['email']);
                unset($_SESSION['erro_confirmacao']);
                unset($_SESSION['codigo']);
                $_SESSION['fracasso'] = true;
                echo "fim";
        }
    }else{
        if(isset($_SESSION['erro_confirmacao']))
            unset($_SESSION['erro_confirmacao']);
        unset($_SESSION['codigo']);
        unset($_SESSION['email']);
        echo "confirmado";
    }
}
?>