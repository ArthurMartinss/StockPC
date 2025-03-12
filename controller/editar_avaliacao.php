<?php
require_once("../model/AvaliacaoDAO.php");
session_start();
if(!isset($_POST['id_avaliacao'])){
    header("Location:../view/index.php");
}

$dao_a = new AvaliacaoDAO();
$a = $dao_a->obter($_POST['id_avaliacao']);

$a->set_comentario($_POST['comentario']);
$a->set_nota($_POST['nota']);

$dao_a->alterar($a);
$url="Location:../view/anuncio.php?id_anunc=".$_POST['id_anunc'];
header($url);
?>