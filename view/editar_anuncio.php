<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['redirect']='../view/meus_anuncios.php';
    header("Location: login.php");
}
if(!isset($_POST['edit']))
    header("Location: meus_anuncios.php");

require_once('../model/AnuncioDAO.php');

$dao = new AnuncioDAO();
$anuncio = $dao->obter($_POST['edit']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Anúncio - StockPC</title>
        <link rel="stylesheet" href="../css/default.css">
        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script defer src="https://kit.fontawesome.com/0e01c81990.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script async src="../js/index.js"></script>
        <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">

        <link rel="stylesheet" href="../css/sidebar_gerenciamento.css">
        <link rel="stylesheet" href="../css/editar_anuncio.css">
        <link rel="stylesheet" href="../css/cadastro.css">
</head>
<body>
<?php 
        require("req_sidebar_gerenciamento.php");
    ?>
<div class="sct-body">
            <div class="sct-top"> 
                <a class="btn-voltar-compras" href="meus_anuncios.php"> <i class="fa-solid fa-arrow-left-long"></i> Voltar para meus anúncios </a>
                <h2 class="sct-h2"><i class="bi bi-megaphone-fill sidebardash-icons"></i>Meus Anúncios: <span class="editar-top"> Editar </span> </h2> 
            </div>
            <div class="formulario-cadastro">
                <form method="POST" action="../controller/editar_anuncio.php" id="form_cad">
                    <div class="cadastre-se">
                        <h2>Informações do Anúncio</h2>

                        <div class="cadastro">
                            <div class="entrar-items">
                                <label for="titulo_anuncio">Título do anúncio:*</label>
                                <input type="text" id="titulo_anuncio" name="titulo_anuncio" value="<?php echo $anuncio->get_titulo_anuncio(); ?>" required>
                                <p id="mens_titulo_anuncio" class="mens"></p>
                            </div>
                            <div class="entrar-items">
                                <label for="preco_anuncio">Preço do anúncio:*</label>
                                <input type="number" id="preco_anunc" name="preco_anunc" step="0.01" value="<?php echo $anuncio->get_preco(); ?>" required >
                                <p id="mens_preco_anunc" class="mens"></p>
                            </div>
                            <div class="entrar-items">
                                <label for="estoque">Unidades do produto em estoque:*</label>
                                <input type="number" id="estoque" name="estoque" value="<?php echo $anuncio->get_estoque(); ?>" required >
                                <p id="mens_estoque" class="mens"></p>
                            </div>
                            <div class="entrar-items">
                                <label for="descricao">Descrição do anúncio:*</label>
                                <textarea id="descricao" name="descricao" rows="5" cols="33" required><?php echo $anuncio->get_descricao(); ?></textarea>
                                <p id="mens_descricao" class="mens"></p>
                            </div>
                            <div class="entrar-items">
                                <label for="info_adic">Informações adicionais do produto:*</label>
                                <textarea id="info_adic" name="info_adic" rows="5" cols="33" required><?php echo $anuncio->get_informacoes_adicionais(); ?></textarea>
                                <p id="mens_info_adic" class="mens"></p>
                            </div>
                            <input type="hidden" name="id_anuncio" value="<?php echo $anuncio->get_id_anuncio(); ?>">
                            <p style="font-size:10px; color:#a6a6a6; display:flex;" name="camp_obr">(*) - Campos obrigatórios</p><br>
                            <div class="btn-cad justify"><input type="submit" value="Confirmar edições"></div>
                        </div>
                    </div>
                </form>
            </div>
</div>
</body>
<script src="https://kit.fontawesome.com/9e879c63ad.js" crossorigin="anonymous"></script>
</html>
