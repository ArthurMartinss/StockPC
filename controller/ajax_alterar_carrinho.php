<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, Content-Type");

require_once("../model/AnuncioDTO.php");
require_once("../utils/Carrinho.php");
require_once("../utils/Frete.php");
session_start();

    if(!isset($_GET['operacao'])){
        header("Location:../view/index.php");
    }

    if($_GET['operacao']=='adicionar'){

        if(isset($_GET['config'])){

            $anuncio = $_SESSION['carrinho']['config'][$_GET['id_anunc']];

            if($anuncio['quantidade']>=$anuncio['estoque']){
                $anuncio['quantidade']=$anuncio['estoque'];
                $_SESSION['carrinho']['config'][$_GET['id_anunc']]['quantidade']=$anuncio['quantidade'];
                echo $anuncio['estoque']."ªº".$anuncio['quantidade']*$anuncio['preco']."ªº".calcular_subtotal($_SESSION['carrinho']);
            }else{
                $anuncio['quantidade']+=1;
                $_SESSION['carrinho']['config'][$_GET['id_anunc']]['quantidade']=$anuncio['quantidade'];
                Frete::adicionar_unidade_anuncio($_GET['id_anunc']);
                $str_frete=Frete::montar_string_frete($_SESSION['fretes']);
                echo $anuncio['quantidade']."ªº".$anuncio['quantidade']*$anuncio['preco']."ªº".calcular_subtotal($_SESSION['carrinho'])."ªº".$str_frete;
            }

        }else{

            $anuncio = $_SESSION['carrinho'][$_GET['id_anunc']];

            if($anuncio['quantidade']>=$anuncio['estoque']){
                $anuncio['quantidade']=$anuncio['estoque'];
                $_SESSION['carrinho'][$_GET['id_anunc']]['quantidade']=$anuncio['quantidade'];
                echo $anuncio['estoque']."ªº".$anuncio['quantidade']*$anuncio['preco']."ªº".calcular_subtotal($_SESSION['carrinho']);
            }else{
                $anuncio['quantidade']+=1;
                $_SESSION['carrinho'][$_GET['id_anunc']]['quantidade']=$anuncio['quantidade'];
                Frete::adicionar_unidade_anuncio($_GET['id_anunc']);
                $str_frete=Frete::montar_string_frete($_SESSION['fretes']);
                echo $anuncio['quantidade']."ªº".$anuncio['quantidade']*$anuncio['preco']."ªº".calcular_subtotal($_SESSION['carrinho'])."ªº".$str_frete;
            }
        }

    }else if($_GET['operacao']=='inserir'){
        if(!isset($_SESSION['carrinho'])){
            $_SESSION['carrinho']=[];
        }

        if(!isset($_SESSION['carrinho'][$_GET['id_anunc']])&&!isset($_SESSION['carrinho']['config'][$_GET['id_anunc']])){
            Carrinho::adicionar_anuncio($_GET['id_anunc']);
            Frete::montar_frete_anuncio($_SESSION['carrinho'][$_GET['id_anunc']]);
            $itens = count($_SESSION['carrinho']);
            if(isset($_SESSION['carrinho']['config'])){
                $itens+=count($_SESSION['carrinho']['config'])-1;
            }
            echo $itens;
            
        }else{
            echo "alert";
        }
    }else if($_GET['operacao']=='retirar'){
            if(isset($_SESSION['carrinho'][$_GET['id_anunc']])){
                unset($_SESSION['carrinho'][$_GET['id_anunc']]);
                Frete::retirar_frete_anuncio($_GET['id_anunc']);
                $itens = count($_SESSION['carrinho']);
                if(isset($_SESSION['carrinho']['config'])){
                    $itens+=count($_SESSION['carrinho']['config'])-1;
                }
                echo $itens;
            }else if(isset($_SESSION['carrinho']['config'][$_GET['id_anunc']])){
                unset($_SESSION['carrinho']['config'][$_GET['id_anunc']]);
                Frete::retirar_frete_anuncio($_GET['id_anunc']);
                $itens = count($_SESSION['carrinho']);
                if(isset($_SESSION['carrinho']['config'])){
                    $itens+=count($_SESSION['carrinho']['config'])-1;
                }
                echo $itens;
            }else{
                echo "alert";
            }
    }else{

        if(isset($_GET['config'])){

            $anuncio = $_SESSION['carrinho']['config'][$_GET['id_anunc']];

            if($anuncio['quantidade']<=1){
                $anuncio['quantidade']=1;
                $_SESSION['carrinho']['config'][$_GET['id_anunc']]['quantidade']=$anuncio['quantidade'];
                echo $anuncio['quantidade']."ªº".$anuncio['quantidade']*$anuncio['preco']."ªº".calcular_subtotal($_SESSION['carrinho']);
            }else{
                $anuncio['quantidade']-=1;
                $_SESSION['carrinho']['config'][$_GET['id_anunc']]['quantidade']=$anuncio['quantidade'];
                Frete::retirar_unidade_anuncio($_GET['id_anunc']);
                $str_frete=Frete::montar_string_frete($_SESSION['fretes']);
                echo $anuncio['quantidade']."ªº".$anuncio['quantidade']*$anuncio['preco']."ªº".calcular_subtotal($_SESSION['carrinho'])."ªº".$str_frete;
            }

        }else{

            $anuncio = $_SESSION['carrinho'][$_GET['id_anunc']];

            if($anuncio['quantidade']<=1){
                $anuncio['quantidade']=1;
                $_SESSION['carrinho'][$_GET['id_anunc']]['quantidade']=$anuncio['quantidade'];
                echo $anuncio['quantidade']."ªº".$anuncio['quantidade']*$anuncio['preco']."ªº".calcular_subtotal($_SESSION['carrinho']);
            }else{
                $anuncio['quantidade']-=1;
                $_SESSION['carrinho'][$_GET['id_anunc']]['quantidade']=$anuncio['quantidade'];
                Frete::retirar_unidade_anuncio($_GET['id_anunc']);
                $str_frete=Frete::montar_string_frete($_SESSION['fretes']);
                echo $anuncio['quantidade']."ªº".$anuncio['quantidade']*$anuncio['preco']."ªº".calcular_subtotal($_SESSION['carrinho'])."ªº".$str_frete;
            }
        }
    }

    function calcular_subtotal($vetor_carrinho){
        $subtotal = 0;
        if(isset($vetor_carrinho['config'])){
            foreach($vetor_carrinho['config'] as $vetor_anuncio_config){
                
                $subtotal+=$vetor_anuncio_config['anuncio']->get_preco()*$vetor_anuncio_config['quantidade'];
            }
            unset($vetor_carrinho['config']);
        }
        foreach($vetor_carrinho as $vetor_anuncio){
         
            
            $subtotal+=$vetor_anuncio['anuncio']->get_preco()*$vetor_anuncio['quantidade'];
        }
        return $subtotal;
    }
?>