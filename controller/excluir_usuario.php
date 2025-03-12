<?php 
session_start();
require_once('../model/UsuarioDAO.php');
require_once('../model/AvaliacaoDAO.php');
require_once('../model/AnuncioDAO.php');
$dao = new UsuarioDAO();
$usuario = $dao->obter($_SESSION['id_usuario']);
$dao_a = new AnuncioDAO();
$dao_av = new AvaliacaoDAO();
if(isset($_SESSION['excluir'])){
    $dao_a->excluir_por_usuario($_SESSION['id_usuario']); 
    $dao_av->excluir_por_usuario($_SESSION['id_usuario']); 
    $dao->excluir($_SESSION['id_usuario']);
    session_destroy();
    unset($_SESSION['excluir']);
    header("Location:../view/index.php");
}


?>