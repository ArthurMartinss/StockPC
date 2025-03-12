<?php
require_once("../model/AvaliacaoDAO.php");
if(!isset($_POST['id_avaliacao'])){
    header("Location:../view/index.php");
}

$dao_a = new AvaliacaoDAO();
$dao_a->excluir($_POST['id_avaliacao']);

$url="Location:../view/anuncio.php?id_anunc=".$_POST['id_anunc'];
header($url);
?>