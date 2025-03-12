<?php
session_start();
require_once("../utils/Email.php");
require_once("../model/VendaDAO.php");
require_once('../model/UsuarioDAO.php');
if(!isset($_POST['id_venda']))
    header("Location:../view/index.php");

$dao_v = new VendaDAO();
$dao_u = new UsuarioDAO();
$venda = $dao_v->obter($_POST['id_venda']);
$vendedor = $dao_u->obter($venda->get_id_vendedor());
$usuario = $dao_u->obter($_SESSION['id_usuario']);

$mensagem_confirmacao = $_POST['descricao'];
$destinatario = $vendedor->get_email();
$assunto = "Comprador da venda ". $_POST['id_venda'] . " emitiu um ticket! | Data da compra: " . $_POST['data'] . " | Tipo do produto: " . $venda->get_categoria_peca();
$remetente = $usuario->get_email();

Email::enviar_email($destinatario, $assunto, $mensagem_confirmacao, $remetente);

header("Location:../view/minhas_compras.php");