<?php

    require_once("../model/AnuncioDAO.php");
    require_once('../model/ProdutoDAO.php');
    require_once('../utils/Configuracao.php');

    $dao_a = new AnuncioDAO();

    session_start();
    $min_watts = '';
    $subtotal=0;

    if(!isset($_SESSION['config'])||$_SESSION['config']==[])
        $_SESSION['config']=[];

    if(isset($_SESSION['config_subtotal']))
        $subtotal=$_SESSION['config_subtotal'];
    
        

    if(isset($_SESSION['info'])){
        $vetor_info=$_SESSION['info'];
        
        unset($_SESSION['info']);
    }else{
        $vetor_info=Configuracao::monta_vetor_informacoes($_SESSION['config']);
    }

    if(isset($_SESSION['min_watts'])){
        $min_watts = "<span id = 'min_watts'>A StockPC recomenda a seleção de uma fonte de voltagem superior a <span id = 'highlight_watts'>".$_SESSION['min_watts']." Watts</span></span>";
        unset($_SESSION['min_watts']);
    }
 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monte sua configuração - StockPC</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="../js/configuracao.js" async></script>
    <script async src="https://kit.fontawesome.com/0e01c81990.js" crossorigin="anonymous"></script>
    <script src="../js/index.js" async></script>
    <script src="../js/busca.js" async></script>
    <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">
    
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/configuracao.css">
</head>
<body>

<?php
        require "req_navbar.php" 
    ?>

    <h1 class="titulo-top">Monte seu PC</h1>

     <div class="div-etapas">   <?php echo $vetor_info['string_barra_etapas']; ?> </div>


    <div id="main">
        <div id="pecas">
            <div id="cabecalho">

               <div class="titulo-etapa"> <?php echo $vetor_info['titulo_etapa'];?> </div>

                <form action="../controller/configuracao.php" method="post" id="frm_busca" autocomplete="off" class="form_busca">
                    <div class="search-container">
                        <input type="text" placeholder="Buscar" name="search" id="busca">
                        <input type="hidden" name="etapa" value="<?php echo $vetor_info['etapa']; ?>">
                        <i class="bi bi-search lupa" style="color:#c7c7c7 ; font-size: 16px;" id="lupa"></i>
                    </div>
                </form>

                <?php echo $min_watts; ?>

              <div class="restricoes">  <?php echo $vetor_info['restricoes']; ?> </div>
                
            </div>
        <?php echo $vetor_info['string_listagem']; ?>
        </div>
    
        <div id="info">
            
            
            <div id="subtotal-container">
                <div class="text-box">
                    <p class="aux p-subtotal">Subtotal:</p>
                </div>
                
                <div class="text-box btn-valor ">
                    <p id="subtotal" class="text-box btn_valor">R$<?php echo number_format($subtotal, 2, ',', '.'); ?></p> <p class="aux aviso-frete">(Frete não incluído)</p>
                </div>
                
            </div>
            <div class="botoes_etapas">
                <?php if($vetor_info['etapa']!="processador"){ ?> 

                <form action='../controller/configuracao.php' method='post' class="form_voltar">
                        <input type='hidden' value='<?php echo Configuracao::VETOR_ETAPAS[array_search($vetor_info['etapa'], Configuracao::VETOR_ETAPAS)-1]; ?>' name='voltar'>
                        <input id='btn_voltar' type='submit' value='Voltar etapa'>
                </form>

                <?php } ?>
                

                <?php echo $vetor_info['string_opcional']; ?>

                <form action="../controller/configuracao.php" method="post" id="prox_et">

                    <input type="hidden" name="subtotal_inicial" id="subtotal_inicial" value="R$<?php echo number_format($subtotal, 2, ',', '.'); ?>">

                    
                    <input type="hidden" name="proxima_etapa" id="input_proxima_etapa" value="<?php echo $vetor_info['proxima_etapa']; ?>">


                    <input type="hidden" name="max_quant_anunc" id="max_quant_anunc" value="<?php echo $vetor_info['max_quant_anunc']; ?>">
                    <input type="hidden" name="quant_anunc" id="quant_anunc" value="0">

                    <input type="hidden" class="id_anunc" name="id_anuncio_0" id="input_id_anuncio_0" value="">
                    <input type="hidden" class="quant_anunc" name="quantidade_0" id="quantidade_0" value="1">
                    <input type="hidden" class="preco_anunc" name="preco_anunc_0" id="preco_anunc_0" value="0">

                    

                    <input type="submit" id="submit_avancar" value="Selecione um produto" class="disabled_submit" disabled >
                </form>
            </div>
        </div>
        
    </div>
        
    </div>
    
    <?php
        require "req_footer.php";
    ?>
</body>
</html>