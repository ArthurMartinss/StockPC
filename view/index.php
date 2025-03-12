<?php
require_once('../model/AnuncioDAO.php');
require_once('../model/AvaliacaoDAO.php');
require_once('../utils/Filtro.php');

session_start();
if(isset($_GET['des'])){
    session_destroy();
    session_start();
}

$dao = new AnuncioDAO();

$dao_av = new AvaliacaoDAO();
$medias = $dao_av->obter_medias();

//filtro
$categoria = ((isset($_GET['categoria']))?($_GET['categoria']):(""));
$query_filtro = "";

if(!isset($_GET))
    $_GET=[];


$string_filtro = Filtro::montar_filtro($_GET, $categoria);
$query_filtro = Filtro::montar_query($_GET, $categoria);



$string_busca="";
$carrossel='';
if(isset($_GET['search'])&&$_GET['search']!=""){
    $string_busca='<h4>Resultados para "<b>'.$_GET['search'].'</b>":</h4>';
    $query_filtro = (($query_filtro=="")?(""):("AND ".$query_filtro));
    $anuncios = $dao->obter_por_titulo_condicao($_GET['search'], $query_filtro);
}else{
    $query_filtro = (($query_filtro=="")?(""):("AND ".$query_filtro));
    //echo "<h1>".$query_filtro."</h1>";
    $anuncios = $dao->obter_todos_condicao($query_filtro);
    if(!isset($_GET['categoria']))
        $carrossel='<div id="carouselExampleInterval" class="carousel slide carousel-container" data-bs-ride="carousel" >
        <div class="carousel-inner ">
            <div class="carousel-item active" data-bs-interval="4000">
            <img src="../img/1.png" class="d-unset w-90 banner_img" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
            <img src="../img/2.png" class="d-unset w-90 banner_img" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
            <a href="configuracao.php"><img src="../img/banner03.png" class="d-unset w-90 banner_img" alt="..."></a>
            </div>
            <div class="carousel-item" data-bs-interval="4000">
            <img src="../img/banner04.png" class="d-unset w-90 banner_img" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
            <img src="../img/banner05.png" class="d-unset w-90 banner_img" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
        </button>

        </div>

        <div class="banner-montepc" id="subirfiltro">
            <a href="configuracao.php" class="banner-montepc1"><img src="../img/MONTE O SEU PC.png" alt=""></a>
            <a href="configuracao.php" class="banner-montepc2"><img src="../img/BANNER-maior-montepc.png"></a>
        </div>';
}

$info_btn_carrinho = "";
if(isset($_SESSION['id_usuario']))
    $info_btn_carrinho = "type='button' onclick='alterarCarrinho(this)'";

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="../css/default.css">
        <link rel="stylesheet" href="../css/index.css">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
        <script async src="https://kit.fontawesome.com/0e01c81990.js" crossorigin="anonymous"></script>

        <!-- icones? -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
        <!-- <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"> -->      
        
        <script defer src="../js/index.js"></script>
        <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">
        <title>StockPC</title>
    </head>
    <body>
    
  
    <?php
        echo "<form id='frm_busca' action='index.php' method='get' autocomplete='off'>";
        require "req_navbar.php";
        echo $carrossel;
        echo $string_busca;
    ?>

    
<div id="categorias">
    <div class="categorias-content">
        <a href="index.php" class="categoria-option categoria-option0 nav-link">Tudo</a>
        <a href="index.php?categoria=processador" class="categoria-option categoria-option1 nav-link">Processadores</a>
        <a href="index.php?categoria=placa_mae" class="categoria-option categoria-option2 nav-link">Placas-mãe</a>
        <a href="index.php?categoria=ram" class="categoria-option categoria-option3 nav-link">Memórias RAM</a>
        <a href="index.php?categoria=placa_video" class="categoria-option categoria-option4 nav-link">Placas de vídeo</a>
        <a href="index.php?categoria=armazenamento" class="categoria-option categoria-option5 nav-link">Armazenamento</a>
        <a href="index.php?categoria=fonte" class="categoria-option categoria-option6 nav-link">Fontes de alimentação</a>
        <a href="index.php?categoria=gabinete" class="categoria-option categoria-option7 nav-link">Gabinetes</a>
        <a href="index.php?categoria=cooler" class="categoria-option categoria-option8 nav-link">Coolers</a>

        <div class="categorias-dropdown ">
            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Mais
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item dropdown-item1 nav-link" href="index.php?categoria=processador">Processadores</a></li>
                <li><a class="dropdown-item dropdown-item2 nav-link" href="index.php?categoria=placa_mae">Placas-mãe</a></li>
                <li><a class="dropdown-item dropdown-item3 nav-link" href="index.php?categoria=ram">Memórias RAM</a></li>
                <li><a class="dropdown-item dropdown-item4 nav-link" href="index.php?categoria=placa_video">Placas de vídeo</a></li>
                <li><a class="dropdown-item dropdown-item5 nav-link" href="index.php?categoria=armazenamento">Armazenamento</a></li>
                <li><a class="dropdown-item dropdown-item6 nav-link" href="index.php?categoria=fonte">Fontes de alimentação</a></li>
                <li><a class="dropdown-item dropdown-item7 nav-link" href="index.php?categoria=gabinete">Gabinetes</a></li>
                <li><a class="dropdown-item dropdown-item8 nav-link" href="index.php?categoria=cooler">Coolers</a></li>
            </ul>
        </div>

    </div>
</div>


<div class="grid-2">

    <?php
        echo $string_filtro;
        echo "</form>";
        //require "req_sidebar.php";
    ?>
    


    <div id='grid'>
        
        <?php
foreach ($anuncios as $anuncio_arr) {
    $anuncio = $anuncio_arr['anuncio'];
    $condicao = $anuncio_arr['condicao'];
    $avaliacao_anuncio = ((isset($medias[$anuncio->get_id_anuncio()]))?($medias[$anuncio->get_id_anuncio()]['media']):('-'));
    echo "<div class='anuncio' id='" . $anuncio->get_id_anuncio() . "' onclick='pagAnunc(event)'>
            <div class='img_anunc'>
                <img src='../img/" . $anuncio->get_img_princ() . "'>
            </div>
            <div class='content-anuncio'>
            <section id='".$anuncio->get_id_anuncio()."_sectionTitulo' class='preco-titulo' onclick='pagAnunc(event)'>
                <span id='".$anuncio->get_id_anuncio()."_spanTitulo' class='titulo_anunc' onclick='pagAnunc(event)'>" . $anuncio->get_titulo_anuncio() . "</span>
                <div id='".$anuncio->get_id_anuncio()."_divPreco' class='precos' onclick='pagAnunc(event)'>
                    <span id='".$anuncio->get_id_anuncio()."_spanPreco' class='preco' onclick='pagAnunc(event)'>
                        R$ " . number_format($anuncio->get_preco(), 2, ',', '.') . "
                    </span>
                </div>
            </section>
            <div class='content-mid'>
            <div class='notas' id='".$anuncio->get_id_anuncio()."_divNotas' onclick='pagAnunc(event)'>
                <div class='avaliacao' id='".$anuncio->get_id_anuncio()."_divAvaliacao' onclick='pagAnunc(event)'>
                    <i class='bi bi-star-fill' style='color: #fff;'></i>
                    <span class='nota-avaliacao' id='".$anuncio->get_id_anuncio()."_spanNotas' style='color: #fff;' onclick='pagAnunc(event)'> ".$avaliacao_anuncio." </span>
                </div>
                <div class='condicao' onclick='pagAnunc(event)' id='".$anuncio->get_id_anuncio()."_divCondicao'>";
    if ($condicao == 'novo') {
        echo "<span class='condicao-produto condicao-novo' onclick='pagAnunc(event)' id='".$anuncio->get_id_anuncio()."_spanCondicao'> Novo </span>";
    } elseif ($condicao == 'usado') {
        echo "<span class='condicao-produto condicao-usado' onclick='pagAnunc(event)' id='".$anuncio->get_id_anuncio()."_spanCondicao'> Usado </span>";
    }
    echo "</div>
            </div>
            <span class='num-estoque'> " . number_format($anuncio->get_estoque(), 0, ',', '.') . " em estoque </span>
            <form id='form_carrinho' method='post' action='../controller/carrinho.php' class='form-btn-anunc'>
                <input type='hidden' value='" . $anuncio->get_id_anuncio() . "' name='adicionar'>
                <input type='hidden' value='../view/anuncio.php?id_anunc=" . $anuncio->get_id_anuncio() . "' name='redirect'>
                <div class='btns-carrinhos'>
                    <button class='btn_anunc'><i class='bi bi-cart-fill'> </i> Comprar</button>";
    if ((isset($_SESSION['carrinho']) && isset($_SESSION['carrinho'][$anuncio->get_id_anuncio()]) || isset($_SESSION['carrinho']['config'][$anuncio->get_id_anuncio()]))) {
        echo "<button class='retirar_carrinho' id='retirar_" . $anuncio->get_id_anuncio() . "' " . $info_btn_carrinho . ">
                <!-- <img src='../img/icons/esvaziar-cart.png'> -->
                <i class='bi bi-cart-x-fill'></i>
            </button>";
    } else {
        echo "<button class='btn_adc_carrinho' id='inserir_" . $anuncio->get_id_anuncio() . "' " . $info_btn_carrinho . ">
        <i class='bi bi-cart-plus-fill'></i>
            </button>";
    }
    echo "</div>
            </form>
            </div>
            </div>
        </div>";
}
?>
            

        </div>
        
    </div>
        
    <button type='button' id="botao-topo" onclick="scrollParaOTopo()"> <i class="bi bi-arrow-up"></i> </button>
        
    <script src="../js/carrossel.js"></script>
    <script src="../js/avaliacao.js"></script>
    
<script>

    window.onscroll = function() {
    mostrarOcultarBotao();
    };

    function mostrarOcultarBotao() {
    var botaoTopo = document.getElementById("botao-topo");
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        botaoTopo.style.opacity = "1";
    } else {
        botaoTopo.style.opacity = "0";
    }
    }

    // Função para rolar suavemente para o topo da página
    function scrollParaOTopo() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    }


</script>

    <?php
        require "req_footer.php" 
    ?>


    </body>
</html> 