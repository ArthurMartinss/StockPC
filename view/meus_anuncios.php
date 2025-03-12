<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    $_SESSION['redirect']='../view/meus_anuncios.php';
    header("Location:login.php");
}

require_once('../model/AnuncioDAO.php');
$dao = new AnuncioDAO();
$anuncios = $dao->obter_por_vendedor($_SESSION['id_usuario']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Anúncios - StockPC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
    rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/meus_anuncios.css">
    <link rel="stylesheet" href="../css/sidebar_gerenciamento.css">
</head>
<body>
  


<?php
    require("req_sidebar_gerenciamento.php");
    if($anuncios!=[]){
        echo "<div  class='sct-body'> 
                
                <div class='sct-meus-anunc-top'>
                    <h2 class='sct-h2'><i class='bi bi-megaphone-fill'></i>Meus Anúncios</h2>
                    <a class='link_criar_anuncio' href='cadastro_anuncio_inicio.php'>  <i class='fa-solid fa-plus fa-lg'></i>  Criar novo anúncio de venda </a>
                </div>  <div id='grid'>";
        
           foreach($anuncios as $anuncio) {
                echo "<div class='anuncio'>
                    <div class='img_anunc'>
                        <img src='../img/".$anuncio->get_img_princ()."' >
                    </div>
                    <section class='preco-titulo'>
                        <span class='preco'>R$ ".number_format($anuncio->get_preco(), 2, ',', '.')."</span>
                        <span class='titulo_anunc'>".$anuncio->get_titulo_anuncio()."</span>
                    </section>
                    <div class='btn-edit-exclu'>
                        

                        <div class='btns-edit-excluir'>    
                            <button type='button' class='btn_excluir' data-bs-toggle='modal' data-bs-target='#staticBackdrop'>
                                <i class='bi bi-trash-fill'></i> Excluir
                            </button>
                        
                            <!-- Modal -->
                            <div class='modal fade' id='staticBackdrop' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h1 class='modal-title fs-5' id='staticBackdropLabel'>Excluir anúncio</h1>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body'>
                                        Tem certeza que deseja excluir o anúncio?
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Não</button>

                                        <form method='post' id='excluir' action='../controller/excluir_anuncio.php'>
                                            <input type='hidden' name='excl' value='".$anuncio->get_id_anuncio()."'>
                                            <button type='submit' class='btn btn-primary'> Sim</button>
                                        </form>
                                        
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class='reticencias'> <i class='bi bi-three-dots'></i> </div>
                            <form method='post' id='editar' action='editar_anuncio.php'>
                                <input type='hidden' name='edit' value='".$anuncio->get_id_anuncio()."'>
                                <input type='hidden' name='id_vend' value='".$_SESSION['id_usuario']."'>
                                <button type='submit' class='btn_editar'><i class='bi bi-pencil-fill'></i>Editar</button>
                            </form>
                        </div>

                    </div>
                </div>";
            }
            echo "</div>
             <a id='botao-criar-anunc' href='cadastro_anuncio_inicio.php'> <i class='fa-solid fa-plus fa-lg'></i> Criar novo anúncio de venda </a> 
            ";
        }else{
            echo "
            <div class='sct-body'>
                <div class='sct-meus-anunc-top'>
                <h2 class='sct-h2'>Meus Anúncios</h2>
                <h3  style='margin: 1.5rem 0rem;'>Não há anúncios registrados.</h3>
                <a class='link_criar_anuncio' href='cadastro_anuncio_inicio.php' > <i class='fa-solid fa-plus fa-lg'></i>   Criar novo anúncio de venda </a>
            </div>
            </div> </div>";
        }
?>

<script>

window.onscroll = function() {
            mostrarOcultarBotao();
        };

        function mostrarOcultarBotao() {
            var botaoTopo = document.getElementById("botao-criar-anunc");
            if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
                botaoTopo.style.opacity = "1";
            } else {
                botaoTopo.style.opacity = "0";
            }
        }

</script>

    <script src="https://kit.fontawesome.com/0e01c81990.js" crossorigin="anonymous"></script>
    <!-- Linha 85 -->
    <!--    <form method='post' id='excluir' action='../controller/excluir_anuncio.php'>
                <input type='hidden' name='excl' value='".$anuncio->get_id_anuncio()."'>
                <button type='submit' class='btn_excluir' onclick='return confirm("."Tem certeza que quer excluir o anúncio?".");'> <i class='bi bi-trash-fill'></i> Excluir </button>
            </form> -->
</body>
</html>