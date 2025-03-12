<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, Content-Type");
require_once("../bd/gerenciador_de_conexoes.php");
require_once("../model/UsuarioDAO.php");

if(isset($_GET['email'])){

    $dao = new UsuarioDAO();
    $usuario = $dao->obter_por_email($_GET['email']);
    if($usuario){
        echo $usuario->get_email();
    }else{
        echo "";
    }
}
?>