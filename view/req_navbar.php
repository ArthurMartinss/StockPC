<nav class="navbar fixed-top">
        <div class="container-fluid">

        <!-- logo -->
            <a href="index.php">
             <img src="../img/stockpc/logo branca cortada.png" alt="Descrição da imagem" class="img-logo">
            </a>

<!-- barra de pesquisa -->
        <div class="pesquisa">
            <?php echo ((isset($string_filtro))?(""):('<form action="index.php" method="get" id="frm_busca" autocomplete="off" class="search d-none d-md-block" autocomplete="off">')); ?>
                <div class="search-container">
                    <input type="text" placeholder="Buscar" name="search" id="busca">
                    <i class="bi bi-search lupa" style="color:#fff ;margin:0rem 1rem; font-size: 16px;" id="lupa"></i>
                </div>
                <!-- <div class="border-search"></div> -->
            <?php echo ((isset($string_filtro))?(""):('</form>')); ?>
        </div>


       <!-- MODAL Button trigger modal, para celular, busca nao funciona se nao tiver comentado -->
    <!-- <div class="pesquisa-2">
        <button type="button" class="btn-busca" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-search lupa" style="color:#fff ; font-size: 16px;" id="lupa"></i>
        </button>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Pesquisar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php //echo ((isset($string_filtro))?(""):('<form action="index.php" method="get" id="frm_busca" autocomplete="off" class="search d-none d-md-block" autocomplete="off">')); ?>
                            <div class="search-container">
                                <input type="text" placeholder="Buscar" name="search" id="busca">
                                <i class="bi bi-search lupa" style="color:#fff ;margin:0rem 1rem; font-size: 16px;" id="lupa"></i>
                            </div>
                        <?php //echo ((isset($string_filtro))?(""):('</form>')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

<!-- botões navbar -->
<?php
if(!isset($_SESSION['carrinho'])||$_SESSION['carrinho']==[]){
    $str_itens = "<span id='itens_carrinho'></span>";
}else{
    $itens = count($_SESSION['carrinho']);
    if(isset($_SESSION['carrinho']['config']))
        $itens+=count($_SESSION['carrinho']['config'])-1;
    $str_itens = "<span id='itens_carrinho' style='opacity:1;'>".$itens."</span>";
}
?>
            <div class="btns-navbar">
                <div class="btns-navbar-2 d-none d-md-block" id='container_carrinho'>
                <a href="../controller/carrinho.php" class="btn_anunc_navbar" id='a_carrinho'><i class="bi bi-cart-fill" id="img_carrinho"> </i><?php echo $str_itens; ?></a>
                <a href="../view/meuperfil.php" class="btn_anunc_navbar a_perfil" > <i class="bi bi-person-fill" id="img_perfil"></i> </a>
                </div>
            <!-- menu hamburguer -->

                    <button class="navbar-toggler bg-transparent" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"   aria-controls="offcanvasRight">
                        <span class="navbar-toggler-icon "></span>
                    </button>
            </div>
<!-- OFF CANVAS -->

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" data-bs-scroll="false" data-bs-backdrop="true" >
                    <div class="offcanvas-header">  
                        <img src="../img/stockpc/logo branca cortada.png" alt="" width="100px">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">  
                            <li>

                            <!-- <p> Ola, <?php //$usuario->get_nome() ?> </p> -->
                                
                            <div class="btns-offcanvas">
                                <a class="btn_anunc_offcanvas"  id="monteConfig" href="configuracao.php">
                                <i class="bi bi-pc-display"></i> Monte seu PC 
                                </a>
                                <a class="btn_anunc_offcanvas" href="../controller/carrinho.php"> <i class="bi bi-cart-fill"> </i> Carrinho </a>
                                <a class="btn_anunc_offcanvas" href="faq.php"> <i class="ri-questionnaire-fill"></i> Dúvidas frequentes</a>
                            </div>
                            
                            <div class="btns-usuario">
                                <?php
                                    if(!isset($_SESSION)) {
                                        session_start();
                                    }
                                        if(!isset($_SESSION['id_usuario'])){
                                ?>
                                <a class="nav-link" id="borda-verde" href="login.php"> <i class="bi bi-box-arrow-right"></i>Entrar</a>
                                <?php
                                        }else{
                                            echo'<a class="nav-link btn-offcanvas" href="dashboard.php"><i class="ri-line-chart-fill"></i> Gerenciamento de vendas </a>                                            
                                            <a class="nav-link btn-offcanvas" href="minhas_vendas.php"> <i class="bi bi-cash-stack"></i> Minhas vendas </a>
                                            <a class="nav-link btn-offcanvas" href="meus_anuncios.php"> <i class="bi bi-megaphone-fill"></i>Meus anúncios</a>
                                            <a class="nav-link btn-offcanvas" href="minhas_compras.php"><i class="bi bi-bag-check-fill"></i>Minhas compras</a>
                                            <a class="nav-link btn-offcanvas" href="meuperfil.php"><i class=" bi bi-person-fill"></i> Meu perfil</a>
                                            <a id="sairLink" class="nav-link" href="index.php?des"> <i class="bi bi-box-arrow-left"></i>Sair</a>';
            
                                        }
                                ?>
                            </div>
                            <!--Icone usuario 2:  ri-account-circle-fill -->
                        </ul>

                    </div>
                </div>
            </div>
        </nav>

<?php
    require "req_scripts.php"
?>