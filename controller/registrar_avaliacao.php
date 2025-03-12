<?php
require_once("../model/AvaliacaoDAO.php");
session_start();
if(!isset($_POST['nota'])){
    header("Location:../view/index.php");
}

$dao_a = new AvaliacaoDAO();
$a = new Avaliacao();

$a->set_comentario($_POST['comentario']);
$a->set_nota($_POST['nota']);
$a->set_id_usuario($_SESSION['id_usuario']);
$a->set_id_anuncio($_POST['id_anunc']);

$dao_a->inserir($a);
$url="Location:../view/anuncio.php?id_anunc=".$_POST['id_anunc'];
header($url);
?>