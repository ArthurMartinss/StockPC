<?php
require_once("../utils/Asaas.php");
require_once("../model/UsuarioDAO.php");
require_once("../utils/Carrinho.php");
session_start();

if(!isset($_POST['metodo']))
    header("Location:../view/index.php");

$dao_a = new UsuarioDAO();

$asaas = new Asaas();

$usuario = $dao_a->obter($_SESSION['id_usuario']);

$nome = (($usuario->get_nome_fantasia())?($usuario->get_nome_fantasia()):($usuario->get_nome()));

if($_POST['metodo']=="cartao"){
    $_SESSION['metodo_pagamento']="Cartão de crédito";
    $cpfCnpj = (($usuario->get_cpf()!=""&&$usuario->get_cpf()!=null&&$usuario->get_cpf()!=0)?($usuario->get_cpf()):($usuario->get_cnpj()));
    $cep_formatado = substr($usuario->get_cep(), 0, 5)."-".substr($usuario->get_cep(), 5, 3);
    $telefone = (($usuario->get_telefone_empresa())?($usuario->get_telefone_empresa()):("6137658299"));
    $IP_usuario = $_SERVER['REMOTE_ADDR'];
    $cep_formatado="13081-030";
    echo $IP_usuario."<br>";
    $id = $asaas->retorna_id($nome, $cpfCnpj);


    $body_content='{
        "customer": "'.$id.'",
        "billingType": "CREDIT_CARD",
        "value": '.Carrinho::montar_total($_SESSION['carrinho'])+$_SESSION['valor_fretes'].',
        "dueDate": "'.date('Y-m-d').'",
        "creditCard": {
          "holderName": "'.$_POST["titular"].'",
          "number": "'.$_POST["num_cartao"].'",
          "expiryMonth": "'.$_POST["mes_validade"].'",
          "expiryYear": "'.$_POST["ano_validade"].'",
          "ccv": "'.$_POST["cvv"].'"
        },
        "creditCardHolderInfo": {
          "name": "'.$nome.'",
          "email": "'.$usuario->get_email().'",
          "cpfCnpj": "'.$cpfCnpj.'",
          "postalCode": "'.$cep_formatado.'",
          "addressNumber": "'.$usuario->get_numero().'",
          "addressComplement": null,
          "phone": "'.$telefone.'",
          "mobilePhone": "'.$usuario->get_celular().'"
        },
        "remoteIp": "116.213.42.532"
    }';

    echo $body_content;

    $_SESSION['resposta_pagamento']=$asaas->executa_curl("POST", "/payments", null, $body_content);
    echo"<pre>";
    print_r($_SESSION['resposta_pagamento']);
    echo"</pre>";
    header("Location:efetuar_pedido.php");
}else if($_POST['metodo']=="pix"){
    //mostrar chave e qr code
}
?>