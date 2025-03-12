<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    $_SESSION['redirect']='../view/cadastro_anuncio_inicio.php';
    header("Location:../view/login.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">       
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro Anúncio - StockPC</title>
        <script src="js/cadastro_anuncio_inicio.js" defer></script> 
        <script src="../js/cadastro_anuncio_inicio.js" defer></script>
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
                <h2 class="sct-h2"><i class="bi bi-megaphone-fill"></i>Meus Anúncios: <span class="editar-top"> Criar Anúncio </span> </h2> 
            </div> 
    <div class="formulario-cadastro">
        <form method="POST" action="../controller/transicao_cadastro_anuncio_inicio.php" id="form_cad">
            <div class="cadastre-se">
                <h2>Etapa 1: Informações do Anúncio</h2>

        <div class="etapas-cad"> <span class="numero-etapa"> 1 </span> <span class="linha-etapas-cad"></span> <span class="numero "> 2 </span> <span class="linha-etapas-cad"></span> <span class="numero "> 3 </span> </div>

                <div class="cadastro">
                    <div class="entrar-items">
                        <label for="titulo_anuncio">Título do anúncio:*</label>
                        <input type="text" id="titulo_anuncio" name="titulo_anuncio" placeholder="Placa de vídeo NVIDIA RTX 3090" required>
                        <p id="mens_titulo_anuncio" class="mens"></p>
                    </div>
                    <div class="entrar-items">
                        <label for="preco_anuncio">Preço do anúncio:*</label>
                        <input type="number" id="preco_anunc" name="preco" step="0.01" placeholder="500,00" required >
                        <p id="mens_preco_anunc" class="mens"></p>
                    </div>
                    <div class="entrar-items">
                    <label for="tipo_produto">Tipo de produto:*</label>
                        <select name="categoria_produto" id="tipo_produto" required>
                        <option value="">Selecione uma opção</option>
                        <option value="placa_mae">Placa-mãe</option>
                        <option value="processador">Processador</option>
                        <option value="ram">Memória RAM</option>
                        <option value="placa_video">Placa de vídeo</option>
                        <option value="armazenamento">Armazenamento</option>
                        <option value="gabinete">Gabinete</option>
                        <option value="fonte">Fonte de alimentação</option>
                        <option value="cooler">Cooler</option>
                        </select>
                        <p id="mens_tipo_produto" class="mens"></p>
                    </div>
                    <div class="cond_prod">
                        <label>Condição do Produto:*</label>
                        <div class="radio">
                            <input type="radio" id="novo" name="condicao" value="novo" onclick="mostrarUso(event)" > <label for="novo" style="margin:0; width:30%; padding:0.2rem;">Novo</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="usado" name="condicao" value="usado" onclick="mostrarUso(event)"> <label for="usado" style="margin:0; width:30%; padding:0.2rem;">Usado</label>
                        </div>
                    </div>
                    
                    <div class="entrar-items" id="div_tempo_uso" style="display:none;">
                        <label for="tempo_uso">Tempo de uso do produto:*</label>
                        <select name="tempo_uso" id="sel_tempo_uso" >
                        <option value="">Selecione uma opção</option>
                        <option value="0">Menos de um mês</option>
                        <option value="1">1 mês</option>
                        <option value="2">2 meses</option>
                        <option value="4">3 meses</option>
                        <option value="4">4 meses</option>
                        <option value="5">5 meses</option>
                        <option value="6">6 meses</option>
                        <option value="7">7 meses</option>
                        <option value="8">8 meses</option>
                        <option value="8">8 meses</option>
                        <option value="9">9 meses</option>
                        <option value="10">10 meses</option>
                        <option value="11">11 meses</option>
                        <option value="12">1 a 2 anos</option>
                        <option value="24">2 a 3 anos</option>
                        <option value="36">Mais de três anos</option>
                        </select>
                        <p id="mens_tempo_uso" class="mens"></p>
                    </div>

                    <div class="entrar-items">
                        <label for="estoque">Unidades do produto em estoque:*</label>
                        <input type="number" id="estoque" name="estoque" placeholder="20" required >
                        <p id="mens_estoque" class="mens"></p>
                    </div>
                    <p style="font-size:12px; color:#a6a6a6; display: flex;">(*) - Campos obrigatórios</p><br>
                    <input class="btn-cad justify" type="submit" value="Prosseguir">
                </div>
            </div>
        </form>
    </div>
</div>
    <script src="https://kit.fontawesome.com/9e879c63ad.js" crossorigin="anonymous"></script>
    
</body>  
</html>