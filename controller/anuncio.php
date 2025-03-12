<?php
require_once("../utils/Frete.php");
require_once("../utils/MelhorEnvio.php");
require_once("../utils/Frete.php");
require_once("../model/AnuncioDAO.php");
require_once("../model/UsuarioDAO.php");
session_start();
if(!isset($_POST['cep']))
    header("Location:../view/index.php");

$dao_a = new AnuncioDAO();
$dao_u = new UsuarioDAO();

$anuncio = $dao_a->obter($_POST['id_anunc']);
$cep_saida = $dao_u->obter($anuncio->get_id_vendedor())->get_cep();

$ME_chamadas = new MelhorEnvioChamadas();

$_SESSION['str_frete_anuncio'] = Frete::montar_string_frete_anuncio(json_decode($ME_chamadas->cotacao_frete_anuncio($anuncio, $cep_saida, $_POST['cep'], Frete::retorna_metricas($anuncio->get_categoria_produto()))['resposta']));

$url = "Location:../view/anuncio.php?id_anunc=".$_POST['id_anunc'];

header($url);
?>