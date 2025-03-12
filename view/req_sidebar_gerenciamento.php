<div class="sidebarDash-flutuante-div"> <a class="sidebarDash-flutuante" id="btn2"> <i class="bi bi-list"></i> </a> </div>

<div class="sidebar-dash">
    
        <div class="sidebarDash-top">
                    
                    <a class="logo-dash-top" href="index.php"> <img src="../img/stockpc/logo branca cortada.png" alt="StockPC" class="logo-sidebar"> </a>

                    <a class="btn-sidebar-geren" id="btn1"> 
                        
                    <i class="bi bi-list"></i> 
                  </a>
        </div>

    
        <div class="btns-usuario">
           
            <a class="nav-link btn-offcanvas a_gerenc_vendas" href="dashboard.php" type="button" class="btn btn-secondary" ><i class="ri-line-chart-fill sidebardash-icons"></i> <span class="sidebardash-span">Gerenciamento de vendas </span> </a>
            <a class="nav-link btn-offcanvas a_minhas_vendas" href="minhas_vendas.php" type="button" class="btn btn-secondary" ><i class="bi bi-cash-stack sidebardash-icons"></i> <span class="sidebardash-span">Minhas vendas	</span> </a>
              <span class="cascata cascata-vendas1"> <i class="ri-corner-down-right-line"></i> <span>Venda</span> </span>
            <a class="nav-link btn-offcanvas a_meus_anunc" href="meus_anuncios.php" type="button" class="btn btn-secondary" > <i class="bi bi-megaphone-fill sidebardash-icons"></i><span class="sidebardash-span"> Meus anúncios</span> </a>  
              <span class="cascata cascata-editar-anunc"> <i class="ri-corner-down-right-line"></i> <span>Editar anúncio </span> </span>
              <span class="cascata cascata-criar-anunc"> <i class="ri-corner-down-right-line"></i> <span>Criar anúncio </span> </span>
            <a class="nav-link btn-offcanvas a_minhas_compras" href="minhas_compras.php" type="button" class="btn btn-secondary" > <i class="bi bi-bag-check-fill sidebardash-icons"></i> <span class="sidebardash-span">Minhas compras</span> </a>
              <span class="cascata cascata-compra1"> <i class="ri-corner-down-right-line"></i> <span>Compra</span> </span>
              <span class="cascata cascata-compra2"> <i class="ri-corner-down-right-line"></i> <span>Abrir ticket</span> </span>
            <a class="nav-link btn-offcanvas a_meu_pefil" href="meuperfil.php" type="button" class="btn btn-secondary" ><i class="bi bi-person-fill sidebardash-icons"></i> <span class="sidebardash-span"> Meu perfil</span> </a>
              <span class="cascata cascata-perfil1"> <i class="ri-corner-down-right-line"></i> <span>Editar perfil</span> </span>
            <a id="sairLink" class="nav-link btn-offcanvas" href="index.php?des" type="button" class="btn btn-secondary" > <i class="bi bi-box-arrow-left sidebardash-icons"></i><span class="sidebardash-span"> Sair</span> </a>

            <div class="header-voltar">
              <a class="btn-voltar btn-offcanvas" href="index.php" >  <i class="fa-solid fa-arrow-left-long sidebardash-icons"></i> <span class="sidebardash-span "> Voltar </span> </a>
            
            </div>

        </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  var currentPage = window.location.pathname; // Obtém o URL da página atual

  // Percorre todos os links da barra lateral
  $(".nav-link").each(function() {
    var linkHref = $(this).attr("href");

    // Verifica se o link corresponde à página atual
    if (currentPage.endsWith(linkHref)) {
      $(this).addClass("active"); // Adiciona a classe "active" ao link correspondente
    }
  });
});
</script>

<script> 

let btn1 = document.querySelector('#btn1');
let btn2 = document.querySelector('#btn2');
let sidebarDash = document.querySelector('.sidebar-dash');

btn1.onclick = function (){
    sidebarDash.classList.toggle('activeDash');
};

btn2.onclick = function (){
    sidebarDash.classList.toggle('activeDash');
};

</script>


<?php
    require "req_scripts.php"
?>


