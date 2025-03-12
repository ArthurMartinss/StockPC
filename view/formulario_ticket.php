<?php 
session_start();
require_once('../model/VendaDAO.php');
require_once('../model/UsuarioDAO.php');
if(!isset($_SESSION['id_usuario'])){
    header("Location:../view/index.php");
}else{
    $dao_v = new VendaDAO();
    $dao_u = new UsuarioDAO();
    $venda = $dao_v->obter($_GET['id_venda']);
    $usuario = $dao_u->obter($_SESSION['id_usuario']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
        rel="stylesheet">

    <title>Enviar ticket - StockPC</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/default.css">
    
    <link rel="stylesheet" href="../css/cadastro.css">
    <link rel="stylesheet" href="../css/sidebar_gerenciamento.css">

    <link rel="stylesheet" href="../css/ticket.css">


    <script async src="../js/index.js"></script>
        <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">
    <?php
            require "req_scripts.php";
        ?>
</head>
    <body>
    <?php 
        require("req_sidebar_gerenciamento.php");
    ?>

<div class="sct-body">
            <div class="sct-top"> 
                <a class="btn-voltar-compras" href="minhas_compras.php"> <i class="fa-solid fa-arrow-left-long"></i> Voltar para minhas compras </a>
                <h2 class="sct-h2"><i class="bi bi-bag-check-fill sidebardash-icons"></i>Minhas compras: <span class="editar-top"> Abrir ticket </span> </h2> 
            </div> 
    <div class="formulario">
        <form action="../controller/enviar_ticket.php" method="post">
                <div class="campo-ticket">
                    <label for="problema-ticket">Descreva o seu problema*</label>
                    <textarea name="descricao" id="problema-ticket" cols="30" rows="10" required></textarea>
                </div>
                <div class="enviar-ticket">
                    <input type="hidden" name="id_venda" value="<?php echo $venda->get_id_venda(); ?>">
                    <input type="hidden" name="data" value="<?php echo $venda->get_data() ?>">
                    <input type="submit" value="Enviar">
                </div>
        </form>
    </div>
</div>
    </body>
</html>
