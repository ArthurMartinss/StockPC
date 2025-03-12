<?php
require_once("../model/AnuncioDAO.php");
require_once("../model/UsuarioDAO.php");
require_once("MelhorEnvio.php");

class Frete{	
	
	public static function montar_frete_anuncio($vetor_anuncio){
        if(!isset($_SESSION['fretes']))
            $_SESSION['fretes']=[];

        $anuncio = $vetor_anuncio['anuncio'];
        $id_anuncio = $anuncio->get_id_anuncio();
        $id_vendedor = $anuncio->get_id_vendedor();

        $metricas = Frete::retorna_metricas($anuncio->get_categoria_produto());
        $_SESSION['fretes'][$id_vendedor][$id_anuncio]['massa'] = $metricas[3];

        unset($metricas[3]);

        $_SESSION['fretes'][$id_vendedor][$id_anuncio]['dimensoes'] = $metricas;

        $dao_u = new UsuarioDAO();
        $usuario = $dao_u->obter($id_vendedor);

        $_SESSION['fretes'][$id_vendedor][$id_anuncio]['titulo'] = $anuncio->get_titulo_anuncio();
        $_SESSION['fretes'][$id_vendedor][$id_anuncio]['preco'] = $anuncio->get_preco();
        $_SESSION['fretes'][$id_vendedor][$id_anuncio]['quantidade'] = $vetor_anuncio['quantidade'];
        $_SESSION['fretes'][$id_vendedor]['cep'] = $usuario->get_cep(); 

        Frete::atualizar_fretes($id_vendedor);
        
    }

    public static function adicionar_unidade_anuncio($id_anuncio){
        $dao_a = new AnuncioDAO();
        $anuncio = $dao_a->obter($id_anuncio);
        $id_vendedor = $anuncio->get_id_vendedor();
        $_SESSION['fretes'][$id_vendedor][$id_anuncio]['quantidade'] += 1;
        
        Frete::atualizar_fretes($id_vendedor);
    }

    public static function retirar_frete_anuncio($id_anuncio){
        $dao_a = new AnuncioDAO();
        $id_vendedor = $dao_a->obter($id_anuncio)->get_id_vendedor();

        unset($_SESSION['fretes'][$id_vendedor][$id_anuncio]);
        unset($_SESSION['fretes'][$id_vendedor]['cep']);
        unset($_SESSION['fretes'][$id_vendedor]['cotacao']);

        if($_SESSION['fretes'][$id_vendedor]==[]){
            unset($_SESSION['fretes'][$id_vendedor]);
        }else{
            $dao_u = new UsuarioDAO();
            $usuario = $dao_u->obter($id_vendedor);
            $_SESSION['fretes'][$id_vendedor]['cep'] = $usuario->get_cep(); 
            Frete::atualizar_fretes($id_vendedor);
        }        
    }

    public static function retirar_unidade_anuncio($id_anuncio){
        $dao_a = new AnuncioDAO();
        $anuncio = $dao_a->obter($id_anuncio);
        $id_vendedor = $anuncio->get_id_vendedor();
        $_SESSION['fretes'][$id_vendedor][$id_anuncio]['quantidade'] -= 1;
        
        Frete::atualizar_fretes($id_vendedor);       
    }

    public static function montar_frete_config($vetor_config){
        if(!isset($_SESSION['fretes']))
            $_SESSION['fretes']=[];
        $ids_vendedores = [];
        foreach($vetor_config as $vetor_anuncio){
            $anuncio = $vetor_anuncio['anuncio'];
            $id_anuncio = $anuncio->get_id_anuncio();
            $id_vendedor = $anuncio->get_id_vendedor();

            $metricas = Frete::retorna_metricas($anuncio->get_categoria_produto());
            $_SESSION['fretes'][$id_vendedor][$id_anuncio]['massa'] = $metricas[3];

            unset($metricas[3]);

            $_SESSION['fretes'][$id_vendedor][$id_anuncio]['dimensoes'] = $metricas;

            $dao_u = new UsuarioDAO();
            $usuario = $dao_u->obter($id_vendedor);
            
            $_SESSION['fretes'][$id_vendedor][$id_anuncio]['titulo'] = $anuncio->get_titulo_anuncio();
            $_SESSION['fretes'][$id_vendedor][$id_anuncio]['preco'] = $anuncio->get_preco();
            $_SESSION['fretes'][$id_vendedor][$id_anuncio]['quantidade'] = $vetor_anuncio['quantidade'];
            
            $_SESSION['fretes'][$id_vendedor]['cep'] = $usuario->get_cep(); 

            if (!in_array($id_vendedor, $ids_vendedores))
                array_push($ids_vendedores, $id_vendedor);
            
        }
        foreach($ids_vendedores as $id_vendedor){
            Frete::atualizar_fretes($id_vendedor);
        }
        
    }

    public static function montar_string_frete($vetor_frete){
        $string_frete="<div id='fretes' class='item_listagem'>
            <h3><i class='bi bi-truck'></i>Fretes</h3>
            <form method='post' action='metodo_pagamento.php' id='form_frete' autocomplete='off'>
                <input type='hidden' name='revisao' value='true'>";
        foreach($vetor_frete as $id_vendedor => $vetor_anuncios){
            $str_anuncios="<div class='anuncios_frete'><h5>Frete para:</h5>";
            foreach($vetor_anuncios as $vetor_anuncio){
                if(isset($vetor_anuncio['titulo'])){
                    $str_anuncios.="<p class='titulo_anuncio_frete'>".$vetor_anuncio['titulo']."</p>";
                }
            }
            $str_anuncios.="</div>";
            $str_info_frete="<div class='info_frete'>
                <div class='secoes_frete'>
                <span class='fill'></span>
                <span class='secao_frete'>Empresa</span>
                <span class='secao_frete'>Tipo</span>
                <span class='secao_frete'>Prazo</span>
                <span class='secao_frete'>Preço</span>
                </div>";
            foreach($vetor_anuncios['cotacao'] as $id_frete => $opcao_frete){
                if($opcao_frete['preco']>0){
                    if($opcao_frete['nome']=="SEDEX" || $opcao_frete['nome']==".Com"){
                        $descr="Envio expresso";
                    }else{
                        $descr = "Envio padrão";
                    }
                    $prazo = $opcao_frete['prazo']['min']." a ". $opcao_frete['prazo']['max']." dias";
                    $preco = "R$ ".number_format($opcao_frete['preco'], 2, ',', '.');
                    $str_info_frete.="
                    <div class='container_input_frete'>
                        <input type='radio' class='input_frete' name='frete_".$id_vendedor."' id='frete_".$id_vendedor."_".$id_frete."' value='".$id_frete."' onchange='atualizarPrecoFrete()' required>
                        <label for='frete_".$id_vendedor."_".$id_frete."'>
                        <span><img src='".$opcao_frete['imagem']."'></span>
                        <span class='tipo_envio'>".$descr."</span>
                        <span class='prazo_envio'>".$prazo."</span>
                        <span id='preco_".$id_vendedor."_".$id_frete."' class='preco_envio'>".$preco."</span>
                        </label>
                    </div>";
                }
            }
            $str_info_frete.="</div>";
            $string_frete.="<div class='frete'>".$str_anuncios.$str_info_frete."</div>";
        }
        $string_frete.="</form></div>";
        return $string_frete;
    }

    public static function montar_string_frete_anuncio($resposta){
        $string_frete_anuncio="<div id='fretes' class='item_listagem'><h5>Fretes</h5>";
        $str_info_frete="<div class='info_frete'>
            <div class='secoes_frete'>
            <span class='secao_frete'>Empresa</span>
            <span class='secao_frete'>Tipo</span>
            <span class='secao_frete'>Prazo</span>
            <span class='secao_frete'>Preço</span>
            </div>";
        foreach($resposta as $opcao_frete){
            if(!isset($opcao_frete->error)){
                if($opcao_frete->name=="SEDEX" || $opcao_frete->name==".Com"){
                    $descr="Envio expresso";
                }else{
                    $descr = "Envio padrão";
                }
                $prazo = $opcao_frete->delivery_range->min." a ". $opcao_frete->delivery_range->max." dias";
                $preco = "R$ ".number_format($opcao_frete->price, 2, ',', '.');
                $str_info_frete.="
                <div class='container_input_frete'>
                    <span><img src='".$opcao_frete->company->picture."'></span>
                    <span class='tipo_envio'>".$descr."</span>
                    <span class='prazo_envio'>".$prazo."</span>
                    <span class='preco_envio'>".$preco."</span>
                </div>";
            }
        }
        $str_info_frete.="</div>";
        $string_frete_anuncio.="<div class='frete'>".$str_info_frete."</div>";
        
        $string_frete_anuncio.="</div>";
        return $string_frete_anuncio;
    }

    public static function retorna_metricas($categoria){
        if($categoria == 'processador'){
            $metricas[0]=15;
            $metricas[1]=15;
            $metricas[2]=15;
            $metricas[3]=0.1;
            return $metricas;
        }
        if($categoria == 'placa_mae'){
            $metricas[0]=35;
            $metricas[1]=30;
            $metricas[2]=10;
            $metricas[3]=0.5;
            return $metricas;
        }
        if($categoria == 'ram'){
            $metricas[0]=20;
            $metricas[1]=10;
            $metricas[2]=5;
            $metricas[3]=0.1;
            return $metricas;
        }
        if($categoria == 'placa_video'){
            $metricas[0]=35;
            $metricas[1]=25;
            $metricas[2]=15;
            $metricas[3]=1;
            return $metricas;
        }
        if($categoria == 'armazenamento'){
            $metricas[0]=20;
            $metricas[1]=15;
            $metricas[2]=5;
            $metricas[3]=0.3; 
            return $metricas;
        }
        if($categoria == 'fonte'){
            $metricas[0]=20;
            $metricas[1]=20;
            $metricas[2]=15;
            $metricas[3]=1.5;
            return $metricas;
        }
        if($categoria == 'cooler'){
            $metricas[0]=30;
            $metricas[1]=25;
            $metricas[2]=10;
            $metricas[3]=0.4;
            return $metricas;
        }
        if($categoria == 'gabinete'){
            $metricas[0]=60;
            $metricas[1]=60;
            $metricas[2]=30;
            $metricas[3]=8;
            return $metricas;
        }
        
    }

    public static function calcular_total_frete($vetor_post){
        $total = 0;
        foreach($_SESSION['fretes'] as $id_vendedor => $vetor_anuncios){
            $indice = "frete_".$id_vendedor;
            $total += $vetor_anuncios['cotacao'][$vetor_post[$indice]]['preco'];
        }
        $_SESSION['valor_fretes']=$total;
        return $total;
    }

    public static function atualizar_fretes($id_vendedor){
        $ME_chamadas = new MelhorEnvioChamadas();
        $resposta = $ME_chamadas->cotacao_frete($_SESSION['fretes'][$id_vendedor]);
        $vetor_resposta = json_decode($resposta['resposta']);

        foreach($vetor_resposta as $resposta_obj){
            if(isset($resposta_obj->delivery_range->min)){
                $_SESSION['fretes'][$id_vendedor]['cotacao'][$resposta_obj->id]['nome'] = $resposta_obj->name;
                $_SESSION['fretes'][$id_vendedor]['cotacao'][$resposta_obj->id]['empresa'] = $resposta_obj->company->name;
                $_SESSION['fretes'][$id_vendedor]['cotacao'][$resposta_obj->id]['preco'] = $resposta_obj->price;
                $_SESSION['fretes'][$id_vendedor]['cotacao'][$resposta_obj->id]['prazo']['min'] = $resposta_obj->delivery_range->min;
                $_SESSION['fretes'][$id_vendedor]['cotacao'][$resposta_obj->id]['prazo']['max'] = $resposta_obj->delivery_range->max;
                $_SESSION['fretes'][$id_vendedor]['cotacao'][$resposta_obj->id]['imagem'] = $resposta_obj->company->picture;
            } 
        }
    }

}


?>