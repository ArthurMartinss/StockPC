<?php
session_start();
if(!isset($_SESSION['hidden_inputs']))
    header("Location:index.php");

$hidden_inputs=$_SESSION['hidden_inputs'];
unset($_SESSION['hidden_inputs']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro Anúncio - StockPC</title>
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
        <form enctype="multipart/form-data" method="POST" action="../controller/cadastro_anuncio.php">
            <div class="cadastre-se">
            <a class="btn-voltar-compras" href="cadastro_anuncio_produto.php"> <i class="fa-solid fa-arrow-left-long"></i> Voltar para Etapa 2 </a>
            <h2>Etapa 3: Informações adicionais</h2>

            <div class="etapas-cad"> <span class="numero"> 1 </span> <span class="linha-etapas-cad"></span> <span class="numero"> 2 </span> <span class="linha-etapas-cad"></span> <span class="numero-etapa "> 3 </span> </div>

                <div class="cadastro">
                <div class="entrar-items">
                    <label for="img_princ" class="upload-button"> <i class="fa-solid fa-upload"></i>Imagem principal do produto:*</label>
                    <input type="file" id="img_princ" name="img_princ" accept="image/*" required>
                    <ul id="mens_img_princ" class="mens"></ul>
                </div>
                <div class="entrar-items">
                    <label for="imgs_sec" class="upload-button"> <i class="fa-solid fa-upload"></i>Demais imagens:*</label>
                    <input multiple type="file" id="imgs_sec" name="imgs_sec[]" accept="image/*" required>
                    <ul id="mens_imgs_sec" class="mens"></ul>
                </div>


                    <div class="entrar-items">
                        <label for="descricao">Descrição do anúncio:*</label>
                        <textarea id="descricao" name="descricao" rows="5" cols="33" required></textarea>
                        <p id="mens_descricao" class="mens"></p>
                    </div>
                    <div class="entrar-items">
                        <label for="info_adic">Informações adicionais do produto:*</label>
                        <textarea id="info_adic" name="informacoes_adicionais" rows="5" cols="33" required></textarea>
                        <p id="mens_info_adic" class="mens"></p>
                        <?php echo $hidden_inputs; ?>
                    </div>
                    <p style="font-size:12px; color:#a6a6a6; display: flex;">(*) - Campos obrigatórios</p><br>
                    <div class="btn-cad justify"><input type="submit" value="Cadastrar"></div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Mostrar texto imagens adicionadas -->

<script>
function setupFileInput(inputId, displayId) {
    const fileInput = document.getElementById(inputId);
    const displayElement = document.getElementById(displayId);

    fileInput.addEventListener('change', function () {
        const fileList = fileInput.files;

        if (fileList.length > 0) {
            const ul = document.createElement('ul');
            ul.style.listStyleType = 'disc';

            for (let i = 0; i < fileList.length; i++) {
                const li = document.createElement('li');
                li.textContent = fileList[i].name;
                ul.appendChild(li);
            }

            while (displayElement.firstChild) {
                displayElement.removeChild(displayElement.firstChild);
            }

            displayElement.appendChild(ul);
        } else {
            while (displayElement.firstChild) {
                displayElement.removeChild(displayElement.firstChild);
            }
        }
    });
}

setupFileInput('img_princ', 'mens_img_princ');
setupFileInput('imgs_sec', 'mens_imgs_sec');


</script>        

<script src="https://kit.fontawesome.com/9e879c63ad.js" crossorigin="anonymous"></script>  
</body>
</html>