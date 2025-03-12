<?php
require_once("../model/AnuncioDAO.php");
require_once("../utils/Carrinho.php");
require_once("../utils/Frete.php");

session_start();
if(!isset($_SESSION['id_usuario'])){
    if(isset($_POST['redirect'])){
        $_SESSION['redirect']=$_POST['redirect'];
    }
    header("Location:../view/login.php");
}else{
    if(!isset($_SESSION['carrinho']))
        $_SESSION['carrinho']=[];
    
    if(isset($_POST['adicionar'])){
        Carrinho::adicionar_anuncio($_POST['adicionar']);
        Frete::montar_frete_anuncio($_SESSION['carrinho'][$_POST['adicionar']]);
    }
    
    if(isset($_POST['retirar'])){
        unset($_SESSION['carrinho'][$_POST['retirar']]);
        Frete::retirar_frete_anuncio($_POST['retirar']);
    }
    
    if(isset($_POST['retirar_config'])){
        unset($_SESSION['carrinho']['config'][$_POST['retirar_config']]);
        Frete::retirar_frete_anuncio($_POST['retirar_config']);
        if($_SESSION['carrinho']['config']==[])
            unset($_SESSION['carrinho']['config']);
    }
    
    if(isset($_POST['configuracao'])){
        Carrinho::adicionar_configuracao($_SESSION['config']);
        Frete::montar_frete_config($_SESSION['carrinho']['config']);
    }

    if(isset($_POST['limpar'])){
        unset($_SESSION['carrinho']);
        unset($_SESSION['fretes']);
    }
    
    header("Location:../view/carrinho.php");
}


?>