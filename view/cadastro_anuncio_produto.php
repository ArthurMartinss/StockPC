<?php
session_start();
if(!isset($_SESSION['form_produto']))
    header("Location:../view/index.php");

$form_produto=$_SESSION['form_produto'];
$hidden_inputs=$_SESSION['hidden_inputs'];

unset($_SESSION['form_produto']);
unset($_SESSION['hidden_inputs']);
?>
<!DOCTYPE html>
<html lang="pt-br">    
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro Anúncio - StockPC</title>
        <script async src="../js/cadastro_produto.js"></script>
        <link rel="stylesheet" href="../css/default.css">
        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
        rel="stylesheet">


        <script async src="../js/index.js"></script>
        <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">

        <link rel="stylesheet" href="../css/sidebar_gerenciamento.css">
        <link rel="stylesheet" href="../css/cad_anuncio.css">
        <link rel="stylesheet" href="../css/cadastro.css">
</head>
<body>

<?php 
        require("req_sidebar_gerenciamento.php");
    ?>

<div class="sct-body">  
            <div class="sct-top"> 
                <a class="btn-voltar-compras" href="meus_anuncios.php"> <i class="fa-solid fa-arrow-left-long"></i> Voltar para meus anúncios </a>
                <h2 class="sct-h2"><i class="bi bi-megaphone-fill"></i> Meus Anúncios: <span class="editar-top"> Criar Anúncio </span> </h2> 
            </div>  
    <div class="formulario-cadastro">
        <form method="POST" action="../controller/transicao_cadastro_anuncio_info_adic.php">
            <div class="cadastre-se">
            <a class="btn-voltar-compras" href="cadastro_anuncio_inicio.php"> <i class="fa-solid fa-arrow-left-long"></i> Voltar para Etapa 1 </a>
            <h2>Etapa 2: Informações do Produto</h2>
            <div class="etapas-cad"> <span class="numero"> 1 </span> <span class="linha-etapas-cad"></span> <span class="numero-etapa"> 2 </span> <span class="linha-etapas-cad"></span> <span class="numero "> 3 </span> </div>
                    <div class="entrar-items">
                    <label for="ean">EAN (código de barras):*</label>
                        <input type="number" onKeyPress="if(this.value.length==13) return false;" placeholder="1234567891234" id="ean" name="ean" required>
                        <p id="mens_ean" class="mens"></p>
                    </div>
                    <?php echo $form_produto.$hidden_inputs; ?>
                    <p style="font-size:12px; color:#a6a6a6; display: flex;">(*) - Campos obrigatórios</p><br>
                    <div class="btn-cad justify"><input type="submit" value="Prosseguir"></div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

<script>

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

</script>


</body>
</html>


