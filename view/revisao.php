<?php

require_once("../utils/Configuracao.php");

session_start();
if(!isset($_SESSION['listagem'])||!isset($_SESSION['config_subtotal']))
    header("Location:configuracao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revisão da configuração</title>
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script async src="https://kit.fontawesome.com/0e01c81990.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/revisao.css">
    <link rel="stylesheet" href="..css/configuracao.css">
    <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">
    
    <script src="../js/index.js" async></script>
</head>
<body>

<?php
        require "req_navbar.php" 
    ?>
    
    <div class="div-etapas">  <?php echo Configuracao::monta_barra_etapas('revisao');?> </div>

    <h1 style="font-weight: bold; margin: 2rem 0rem;">Revisão</h1>
    <div id="lista_rev">
        <div class="listagem_prod"> <?php echo $_SESSION['listagem']; ?> 
        <div class="subtotal-linha"></div>
        <div class='anuncio anuncio_lista' id="container_subtotal">
            <span class="sub" id="aux_subtotal">Subtotal:</span>
            <span class="sub" id="subtotal">R$<?php echo number_format($_SESSION['config_subtotal'], 2, ',', '.'); ?></span>
        </div>
        <form action="../controller/carrinho.php" id="frm_rev" class="btn-carrinho-revisao" method="post">
            <input type="hidden" name="configuracao" value="true">
            <input type="hidden" name="redirect" value="../view/revisao.php">
            <input type="submit" value="Ir para o carrinho" id="btn_carrinho" class="sub">
        </form>
    </div>
    </div>

    <?php
        require "req_footer.php";
    ?>
        
</body>
</html>
<?php
unset($_SESSION['listagem']);
unset($_SESSION['config_subtotal']);
?>