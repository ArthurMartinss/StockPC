<?php
require_once('../model/UsuarioDAO.php');
require_once('../utils/Carrinho.php');
session_start();
if(!isset($_SESSION['resposta_pagamento']))
    header("Location:../view/index.php");

$dao_u = new UsuarioDAO();      
$usuario = $dao_u->obter($_SESSION['id_usuario']);

$resposta_pagamento=$_SESSION['resposta_pagamento'];
unset($_SESSION['resposta_pagamento']);

$resposta=json_decode($resposta_pagamento['resposta']);
$erro=json_decode($resposta_pagamento['erro']);
echo"<pre>";
print_r($resposta_pagamento);
echo"</pre>";

echo"<pre>";
print_r($resposta);
echo"</pre>";

echo"<pre>";
print_r($erro);
echo"</pre>";
$_SESSION['resposta']=$resposta;
$_SESSION['erro']=$erro;
if($resposta->status=="CONFIRMED"){
    Carrinho::montar_compra($_SESSION['carrinho'], $usuario);
    $_SESSION['compra_confirmada']=true;
    unset($_SESSION['carrinho']);
    unset($_SESSION['valor_fretes']);
    unset($_SESSION['fretes']);
    unset($_SESSION['metodo_pagamento']);
}else{
    $_SESSION['compra_confirmada']=false;
}

header("Location:../view/compra_finalizada.php");
?>