<?php
require_once("../utils/Carrinho.php");
require_once("../utils/Frete.php");
session_start();
if(!isset($_SESSION['id_usuario'])){
    $_SESSION['redirect']='../view/carrinho.php';
    //header("Location:login.php");
}
if(isset($_SESSION['carrinho']) && $_SESSION['carrinho']!=[]){
    $vetor_info = Carrinho::montar_vetor_informacoes($_SESSION['carrinho'], $_SESSION['id_usuario']);
    $string_frete=Frete::montar_string_frete($_SESSION['fretes']);
}

    ?>


<script>
    let sessionData = <?php echo json_encode($_SESSION['carrinho']); ?>;
</script>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - StockPC </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script async src="https://kit.fontawesome.com/0e01c81990.js" crossorigin="anonymous"></script>
    <script src="../js/configuracao.js" async></script>
    <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">
    <script async src="../js/index.js" async></script>
    <script async src="../js/carrinho.js" async></script>


    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/carrinho.css">
</head>
<body>

<?php
        require "req_navbar.php" 
    ?>


    <h1 class="titulo-top"> Carrinho </h1>


    <div id="main">
        <?php if(isset($_SESSION['carrinho'])&&$_SESSION['carrinho']!=[]){ ?>
        <div id="listagem">
            <div id="endereco" class="item_listagem">
                <h3><i class="ri-map-pin-2-fill"></i>Endereço</h3>

                <div class="edereco-info"> <div class="endereco-info2"> <?php echo $vetor_info['string_endereco']; ?> </div> </div>
            </div>
            <?php echo $string_frete; ?>

            <div id="produtos" class="produtos_listagem">
                <div class="produtos-list-top" style="display:flex; justify-content:space-between;"><h3><i class="bi bi-archive-fill"></i>Produtos</h3>
                    <form action=" ../controller/carrinho.php" method="post" >
                        <input type="hidden" name="limpar" value="true">
                        <button type="submit" class="btn btn-outline-danger"> <!-- <img src="../img/icons/retirar-tudo.png" alt="" style="margin-right: 0.5rem ;"> --> Limpar Carrinho</button>
                    </form>
                </div>
                <?php echo $vetor_info['string_produtos']; ?>
            </div>

            <!--<div class="info-2">
                <h5>Resumo</h5>
                <?php //echo $vetor_info['string_resumo']; ?>
            </div> -->
        </div>
        <div class="info-1">
            <div id="info">
                <div class="content-info">
                    <div><h3 class="h3-resumo-1">Resumo</h3></div>
                    <?php echo $vetor_info['string_resumo']; ?>
                </div>
            </div>
        </div>        
    </div>

        <?php }else{ ?>
            <div class="nada-carrinho">
                <h1> Não há itens no carrinho.</h1>
                <a href="index.php"><i class="bi bi-search"></i>Explorar Mais Ofertas</a>
            </div>
            <div class="info-1">
            <div id="info">
                <div class="content-info">
                    <div><h3 class="h3-resumo-1" style="display:block;">Carrinho vazio.</h3></div>
                </div>
            </div>
        </div>   
        <?php }?>
 
    <!-- <?php 
            require "req_footer.php"; 
        ?> -->
    
</body>
</html>