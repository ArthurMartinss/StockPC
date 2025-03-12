<?php

require_once('../model/AnuncioDAO.php');
require_once('../model/ProdutoDAO.php');
require_once('../model/UsuarioDAO.php');
require_once('../model/AvaliacaoDAO.php');
require_once('../utils/Especificacoes.php');
require_once('../utils/Avaliacoes.php');


session_start();
if(!isset($_GET['id_anunc']))
    header("Location:index.php");

$dao_a = new AnuncioDAO();
$anuncio = $dao_a->obter($_GET['id_anunc']);

if($anuncio->get_ativo()==0)
    header("Location:index.php");

$dao_p = new ProdutoDAO();
$produto = $dao_p->obter($anuncio->get_id_produto());

$dao_u = new UsuarioDAO();
$usuario = $dao_u->obter($anuncio->get_id_vendedor());

$dao_av = new AvaliacaoDAO();
$medias = $dao_av->obter_medias();
$avaliacao_anuncio = ((isset($medias[$_GET['id_anunc']]))?($medias[$_GET['id_anunc']]['media']):('-'));
$string_avaliacoes = Avaliacoes::montar_avaliacoes($_GET['id_anunc']);

$str_frete='';
if(isset($_SESSION['str_frete_anuncio'])){
    $str_frete = $_SESSION['str_frete_anuncio'];
    unset($_SESSION['str_frete_anuncio']);
}
$value='';
if(isset($_SESSION['id_usuario'])){
    $comprador = $dao_u->obter($_SESSION['id_usuario']);
    $value = $comprador->get_cep();
}
?>    
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $anuncio->get_titulo_anuncio(); ?> - StockPC </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script defer src="https://kit.fontawesome.com/0e01c81990.js" crossorigin="anonymous"></script>
        <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">

        <link rel="stylesheet" href="../css/default.css">
        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="../css/anuncio.css">
        <script defer src="../js/busca.js"></script>
        <script defer src="../js/accordion.js"></script>
        <script defer src="../js/anuncio.js"></script>
    
    </head>
    <body>
        <header>

        
        <?php
            require("req_navbar.php") ;
        ?>

        </header>

        <div id="main" class="secao">
            <div class="titulo-anuncio-600px">
                <h1><b><?php echo $anuncio->get_titulo_anuncio(); ?></b></h1>
            </div>
            <div id="imagens" class="secao_main">
                <div id="img_principal">
                    <img id="imagem-principal" src="../img/<?php echo $anuncio->get_img_princ(); ?>">
                </div>
                <div id="imgs_secundarias">

                    <div class='img_sec'>
                        <img class="imagem-zoom" src='../img/<?php echo $anuncio->get_img_princ(); ?>'>
                    </div>
                    <?php
                        foreach(explode(",", $anuncio->get_imgs_sec()) as $imagem){
                            echo"<div class='img_sec'><img class='imagem-zoom' src='../img/$imagem' ></div>";
                        }
                    ?>
                
            </div>
            
        </div>

            <div id="info_principal"  class="secao_main">
                <div id="info_geral">
                <!-- <div class="titulo-anuncio">
                    <h1><b><?php //echo $anuncio->get_titulo_anuncio(); ?></b></h1>
                </div> -->
                    <div class="info-geral">
                    
                            <div class='avaliacao'>
                            <i class="bi bi-star-fill" style="color: #fff;"></i>
                                <span class='nota-avaliacao' style='color: #fff;'> <?php echo $avaliacao_anuncio; ?> </span>
                            </div>
                            
                            <?php echo Especificacoes::monta_tempo_uso($produto->get_tempo_uso(), $produto->get_condicao()); ?> 

                            <div class="condicao">
                                <?php if ($produto->get_condicao() == 'novo'): ?>
                                    <span class="condicao-produto condicao-novo"> Novo </span>
                                <?php elseif ($produto->get_condicao() == 'usado'): ?>
                                    <span class="condicao-produto condicao-usado"> Usado </span>
                                <?php endif; ?>
                            </div>

                            <div class="marca">
                                <b>Marca:</b> <?php echo $produto->get_fabricante(); ?>
                            </div>
                    
                    </div>
                </div>
                
                <div id="compra1">
                    <div id="compra">
                        <div id="preco"><b>R$ <?php echo number_format($anuncio->get_preco(), 2, ',', '.'); ?></b></div>
                        <form id='form_carrinho' method='post' action='../controller/carrinho.php'>
                            <input type='hidden' value='<?php echo $anuncio->get_id_anuncio();?>' name='adicionar'>
                            <input type='hidden' value='../view/anuncio.php?id_anunc=<?php echo $anuncio->get_id_anuncio(); ?>' name='redirect'>
                            <button class='btn_anuncio'><i class="bi bi-cart" id="img_carrinho"> </i> COMPRAR</button>
                            <span class='num-estoque'> <?php echo number_format($anuncio->get_estoque(), 0, ',', '.'); ?> em estoque </span> 
                        </form>
                    </div>
                </div>
                <div id="frete">    
                    <label for="cep"><strong>Calcular frete e prazo de entrega:</strong></label>
                    <form method="post" action="../controller/anuncio.php" class="inputs-frete"> <input type="hidden" name="id_anunc" value="<?php echo $_GET['id_anunc']; ?>"> <input type="number" autocomplete="off" onKeyPress="if(this.value.length==8) return false;" id="cep" name="cep" placeholder="Inserir CEP" class="textbox-frete" required value="<?php echo $value; ?>"> <button id="btn_frete">Calcular</button> </form>
                </div>
                <!-- <div class="avalia-frete">
                   <div class="avaliacao-input">
                            <label>Dê uma avaliação para o produto: </label>
                            <form action="">
                                <input type="text"> <span>/ 5</span>
                                <button id="btn_avaliacao">OK</button>
                            </form>
                    </div> 
                </div> -->
            </div>
                <div class="resultado-frete">
                    <?php echo $str_frete; ?>
                </div>
            </div>
        </div>

        <div id="info_secundaria" class="secao">
            <!-- <div id="descricao" class="secao secao-info">
                    <div class="titulo-secao">
                        <input type="checkbox" id="descricao1" class="titulo-secao-check" checked> 
                        <label for="descricao1"> <h3 class='titulo_secao dropdown-label'> <i class="bi bi-info-circle"></i> Descrição do produto</h3> </label>
                    </div>
                    <div class="content-info"><p class='p_secao'> <?php //echo $anuncio->get_descricao(); ?> </p></div>
                
            </div>
            <div id="especific_tec" class="secao secao-info">
                <div class="titulo-secao">
                    <input type="checkbox" id="especific_tec1" class="titulo-secao-check" checked> 
                    <label for="especific_tec1"> <h3 class='titulo_secao dropdown-label' ><i class="bi bi-file-text"></i>Especificações técnicas</h3> </label>
                </div>
                <div class="content-info"><p class='p_secao'> <?php //echo Especificacoes::monta_especificacoes($produto) ?> </p></div>
                
            </div>
            <div id="info_adic" class="secao secao-info">
                <div class="titulo-secao">
                    <input type="checkbox" id="info_adic1" class="titulo-secao-check " checked>
                    <label for="info_adic1"> <h3 class='titulo_secao dropdown-label'><i class="bi bi-file-plus"></i>Informações adicionais</h3> </label>
                </div>
        
                <div class="content-info"><p class='p_secao'><?php //echo $anuncio->get_informacoes_adicionais() ?> </p></div>
                
            </div> -->


            <ul class="dropdown">
                    <li>
                        <input type="checkbox" name="dropdown" id="descricao1" checked>
                        <label for="descricao1" class="dropdown-label"><h3 class='titulo_secao'> <i class="bi bi-info-circle-fill"></i> Descrição do produto</h3></label>
                        <div class="content content-1">
                                <div>
                                    <p class='p_secao'> <?php echo $anuncio->get_descricao(); ?> </p>
                                </div>
                        </div>
                    </li>
                    
                    <li>
                        <input type="checkbox" name="dropdown" id="especific_tec1" checked>
                        <label for="especific_tec1" class="dropdown-label"><h3 class='titulo_secao' ><i class="bi bi-file-text-fill"></i>Especificações técnicas</h3></label>
                        <div class="content content-1">
                                <div>
                                    <p class='p_secao'> <?php echo Especificacoes::monta_especificacoes($produto) ?> </p>
                                </div>
                        </div>
                    </li>

                    <li>
                        <input type="checkbox" name="dropdown" id="info_adic1" checked>
                        <label for="info_adic1" class="dropdown-label"><h3 class='titulo_secao'><i class="bi bi-file-plus-fill"></i>Informações adicionais</h3></label>
                        <div class="content content-1">
                                <div>
                                    <p class='p_secao'> <?php echo $anuncio->get_informacoes_adicionais() ?> </p>
                                </div>
                        </div>
                    </li>

                    <?php echo $string_avaliacoes; ?>
                    <!-- <li>
                        <input type="checkbox" name="dropdown" id="coment" checked="">
                        <label for="coment" class="dropdown-label"><h3 class="titulo_secao"><i class="ri-question-answer-fill"></i>Avaliações</h3></label>
                        <div class="content content-1">
                                <div>
                                    <div class="content-comentario">
                                        <div class="comentario-input">
                                            <label for="comentario">Faça sua avaliação!</label>
                                            <div class="comentario-inputs">
                                                <select name="nota" required>
                                                    <option value="">Selecione uma nota</option>
                                                    <option value="1">⭐</option>
                                                    <option value="2">⭐⭐</option>
                                                    <option value="3">⭐⭐⭐</option>
                                                    <option value="4">⭐⭐⭐⭐</option>
                                                    <option value="5">⭐⭐⭐⭐⭐</option>
                                                </select>
                                                <input type="text" id="comentario" name="comentario" placeholder="Comentário" required>
                                                <input type="button" value="Enviar">
                                            </div>
                                            
                                            <p id="mens_titulo_anuncio" class="mens"></p>
                                        </div>
                                        <div class="comentario">
                                            <span class="nome-usuario-coment">Leonardo Filippetto: ⭐⭐⭐⭐⭐</span>  
                                            <p class="conteudo-coment">massa demais esse produto meu incrivel </p>
                                            <div class="divisao-comentario"></div>
                                        </div>
                                     </div>
                                </div>
                        </div>
                    </li> -->
            </ul>
        </div>



        
    <?php
        require "req_footer.php" 
    ?>
<script>
    const imagensSecundarias = document.querySelectorAll('.imagem-zoom');
    const imagemPrincipal = document.getElementById('imagem-principal');


    imagensSecundarias.forEach(imagem => {
        imagem.addEventListener('click', () => {
    
            imagemPrincipal.src = imagem.src;
        });
    });
</script>

<!-- Content aparece ou nao -->
<!-- <script>
    var checkboxes = document.querySelectorAll(".titulo-secao-check");
    var contents = document.querySelectorAll(".content-info");

    checkboxes.forEach(function (checkbox, index) {
        checkbox.addEventListener("change", function () {
            contents[index].style.display = checkbox.checked ? "block" : "none";
        });
    });
</script> -->
<!-- <script> 

let btn = document.querySelector('#btn');
let secaoInfo = document.querySelector('.secao-info');

btn.onclick = function (){
    secaoInfo.classList.toggle('active');
};

</script> -->

    </body>
</html>