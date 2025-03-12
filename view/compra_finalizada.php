<?php
session_start();
if(!isset($_SESSION['compra_confirmada']))
    header("Location:index.php");
// if(isset($_SESSION['carrinho']))
    // $vetor_info = Carrinho::montar_vetor_informacoes($_SESSION['carrinho'], $_SESSION['id_usuario']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra - StockPC </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script async src="https://kit.fontawesome.com/0e01c81990.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">
    <script src="../js/index.js" async></script>
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/compra_finalizada.css">
</head>
<body>

    <?php 
        require "req_navbar.php";
    ?>

    <div id="main">
        <?php if($_SESSION['compra_confirmada']){ ?>
        <h1 style="display: flex; align-items: center; gap: 1rem;"><img src="../img/icons/check.png" style="max-width: 40px;">Compra confirmada!</h1>
        <div id="itens">
            <a href="minhas_compras.php">
                <i class="bi bi-bag-check-fill"></i>  Minhas Compras
            </a>
            <a target="_blank" href="<?php echo $_SESSION['resposta']->transactionReceiptUrl; ?>">
                <img src="../img/icons/comprovante.png" alt=""> Comprovante
            </a>
            <a href="index.php"> <img src="../img/search.png" alt="" style="height:1.4rem; margin:0.2rem;"  class="lupa_carrinho"> Voltar às compras </a>
        </div>
        
        <?php unset($_SESSION['config']);}else{ ?>
        <h1>Houve um erro. Tente novamente mais tarde.</h1>
        <?php echo "<script>console.log(".json_encode($_SESSION['resposta']).") console.log(".json_encode($_SESSION['erro']).")</script>"; ?>
        <?php  }?>
    </div>
    </form>
    <?php require "req_footer.php"; // ?>
    
</body>
</html>
