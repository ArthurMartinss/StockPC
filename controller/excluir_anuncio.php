<?php
if(!isset($_POST['excl']))
    header("Location:view/index.php");
require_once('../model/AnuncioDAO.php');
require_once('../model/ProdutoDAO.php');

$dao_a = new AnuncioDAO();
$dao_p = new ProdutoDAO();

if($dao_p->excluir($dao_a->obter($_POST['excl'])->get_id_produto())&&$dao_a->excluir($_POST['excl'])){
	echo"<script>alert('Anúncio excluído com sucesso!')</script>";
        header("Location:../view/meus_anuncios.php");
    } else {
        echo"<script>alert('Erro ao excluir anúncio!')</script>";
        header("Location:../view/meus_anuncios.php");
    }
?>
