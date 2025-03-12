<?php
require_once('../utils/Vendas.php');
require_once('../model/CompraDAO.php');
session_start();
if(!isset($_SESSION['id_usuario'])){
    $_SESSION['redirect']="../view/minhas_compras.php";
    header("Location:login.php");
}
$dao_c = new CompraDAO();
$listagem = Vendas::monta_listagem_compras($dao_c->obter_todos_por_comprador($_SESSION['id_usuario']));

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Minhas Compras - StockPC</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script defer src="https://kit.fontawesome.com/0e01c81990.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/default.css">
        <link rel="stylesheet" href="../css/index.css">
        
        <link rel="stylesheet" href="../css/minhas_compras.css">
        <link rel="stylesheet" href="../css/minhas_vendas.css">

        <script async src="../js/index.js"></script>
        <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">

        <link rel="stylesheet" href="../css/sidebar_gerenciamento.css">
        <?php
            require "req_scripts.php";
        ?>
    </head>
    <body>

    <?php
        require "req_sidebar_gerenciamento.php";
    ?>

        <div class="sct-body">
            <div> <h2 class="sct-h2"><i class="bi bi-bag-check-fill"></i>Minhas compras</h2> </div>
        <?php
            echo $listagem;
        ?> 
        </div>
    </body>
</html> 