<?php
require_once('../utils/Carrinho.php');
require_once('../utils/Frete.php');
session_start();
if(!isset($_POST['revisao']))
    header("Location:index.php");

if(isset($_SESSION['carrinho']))
    $vetor_info = Carrinho::montar_vetor_informacoes($_SESSION['carrinho'], $_SESSION['id_usuario']);

$preco_total=Carrinho::montar_total($_SESSION['carrinho'])+Frete::calcular_total_frete($_POST);
//echo Frete::calcular_total_frete($_POST)."      ".Carrinho::montar_total($_SESSION['carrinho']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="../js/configuracao.js" defer></script>
    <script src="../js/index.js" defer></script>
    <script src="../js/metodo_pagamento.js" defer></script>
    <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">
    
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/metodo_pagamento.css">
</head>
<body>

    <?php
        require "req_navbar.php";
    ?>    

    <form method='post' id='frm_pagamento' action='../controller/metodo_pagamento.php' autocomplete="off">
        <div id="main">
            <div id="listagem">
                <div class='container_metodo'>
                    <div class="container_metodo_opcao"> <input required  type="radio" name="metodo" id="pix" value='pix'><label for="pix">PIX</label> </div>
                </div>
                <div class='container_metodo'>
                    <div class="container_metodo_opcao"> <input required  type="radio" name="metodo" id="boleto" value='boleto'><label for="boleto">Boleto</label> </div>
                </div>
                <div class='container_metodo' id='metodo_cartao'>
                    <div class="container_metodo_opcao"> <input required  type="radio" name="metodo" id="cartao" value='cartao'><label for="cartao">Cartão de crédito</label> </div>
                </div>
            </div>
            <div class="info-1">
                <div id="info">
                    <div><h3>Resumo</h3></div>
                    <div>
                        <h5>Total:</h5>
                        <h4>R$ <?php echo number_format($preco_total, 2, ',', '.'); ?></h4>
                        <input type='submit' id='btn_avancar' disabled class='realizar_pagamento btn_disabled' onclick='desabilitarBtn(this)' value='Realizar pagamento'>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- <?php require "req_footer.php"; ?> -->
    
</body>
</html>