<?php
require_once("../utils/Email.php");
session_start();
if(!isset($_POST['numero']))
    header("Location:../view/index.php");

$string_inputs='';
foreach($_POST as $indice => $valor){
    $string_inputs .= "<input type='hidden' name='".$indice."' value='".$valor."'>";
}

$_SESSION['email'] = $_POST['email'];
$_SESSION['string_inputs'] = $string_inputs;
$_SESSION['codigo'] = sprintf('%06d', mt_rand(0, 999999));

$mensagem_confirmacao = "<p>Seu código de confirmação de email é <b>".$_SESSION['codigo']."</b>.</p>";
$destinatario = $_POST['email'];
$assunto = "StockPC: Confirmação de email";

Email::enviar_email($destinatario, $assunto, $mensagem_confirmacao);

header("Location:../view/confirmar_email.php");