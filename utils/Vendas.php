<?php
require_once("../model/AnuncioDAO.php");
require_once("../model/UsuarioDAO.php");
require_once("../model/CompraDAO.php");

class Vendas{

    public static function monta_listagem_compras($vetor_pedidos){
        if($vetor_pedidos==[]){
            return "
            <div class='nao-ha-compras'> 
                <h2>Não há compras registradas.</h2>
                <a href='index.php'> <img src='../img/search.png' alt='' style='height:1.4rem; margin:0.2rem;'  class='lupa_carrinho'> Ir às compras </a>
            </div>";
        }
        $string_listagem = "<div id='compras'>";
        foreach($vetor_pedidos as $pedido){
            $imagens = explode(",", $pedido->get_imagens());
            $titulos = (str_contains($pedido->get_titulos(), "§§"))?(explode("§§", $pedido->get_titulos())):([0 => $pedido->get_titulos()]);


            $str_imagens = (count($imagens)>=4)?("<div class='imagens'><img src='../img/".$imagens[0]."'><img src='../img/".$imagens[1]."'><img src='../img/".$imagens[2]."'><img src='../img/".$imagens[3]."'></div>"):("<div class='imagens'><img src='../img/".$imagens[0]."'></div>");

            $str_titulos = "<div class='info-compra'><div class='titulos'>";
            for($i=0;$i<=4;$i++){
                if($i==4 && isset($titulos[$i])){
                    $str_titulos.="<p class='titulo'>...</p></div>";
                }else if(isset($titulos[$i])){
                    $str_titulos.="<p class='titulo'><span>".$titulos[$i]."</span></p>";
                }else{
                    $str_titulos.="</div>";
                    break;
                }
            }

            $str_itens = ($pedido->get_unidades()==1)?("<div class='itens'><p><span>Qtd.: </span>".$pedido->get_unidades()." item</p></div>"):("<div class='itens'><p><span>Qtd.: </span>".$pedido->get_unidades()." itens</p></div>");
            $str_data = "<div class='data'><p><span>Data: </span>".date("d/m/Y", strtotime($pedido->get_data()))."</p></div>";
            $str_preco = "<div class='preco_compra'><p><span>Valor: </span>R$ ".number_format($pedido->get_preco_total(), 2, ',', '.')."</p></div>";
            $str_status = "<div class='status'><p><span>Status: </span>".$pedido->get_status()."</p></div>";
            $str_metodo_pagamento = "<div class='metodo_pagamento'><p><span>Forma de pagamento: </span>".$pedido->get_metodo_pagamento()."</p></div></div>";
            $string_listagem.="<a class = 'compra' href='compra.php?id_compra=".$pedido->get_id_compra()."'>".$str_imagens.$str_titulos.$str_itens.$str_data.$str_preco.$str_status.$str_metodo_pagamento."</a>";
        }
        return $string_listagem."</div>";
    }

    public static function monta_compra($vetor_vendas, $compra){
        
        $string_listagem = Vendas::monta_resumo_compra($compra)."<div id='compra'>";
        foreach($vetor_vendas as $venda){
            $str_imagem = "<div class='imagem'><img src='../img/".$venda->get_imagem()."'></div>";
            $str_titulo = "<div class='titulo'><p><span>".$venda->get_titulo()."</span></p></div>";
            $str_unidades = ($venda->get_unidades()==1)?("<div class='unidades'><p><span>Qtd.: </span>".$venda->get_unidades()." unidade</p></div>"):("<div class='unidades'><p><span>Qtd.: </span>".$venda->get_unidades()." unidades</p></div>");
            $str_preco = "<div class='preco_compra'><p><span>Valor: </span>R$ ".number_format($venda->get_unidades()*$venda->get_preco(), 2, ',', '.')."</p></div>";
            $str_ticket = "<div class='options'> <span>Está com algum problema?</span> <a href='../view/formulario_ticket.php?id_venda=". $venda->get_id_venda()."'><span>Abrir ticket</span></a></div>";

            $string_listagem.="<div class = 'item'>".$str_imagem.$str_titulo.$str_unidades.$str_preco.$str_ticket."</div>";
        }
        return $string_listagem."</div>";
    }

    public static function monta_resumo_compra($compra){
        return "<div> <a class='btn-voltar-compras' href='minhas_compras.php'> <i class='fa-solid fa-arrow-left-long'></i> Voltar para minhas compras </a> <h2 class='sct-h2'><i class='bi bi-bag-check-fill'></i>Minhas compras: <span id='id_compra'> Compra - ID: ".$compra->get_id_compra()."</span></h2></div> <div id='resumo'>
                <div class='resumo-grid resumo-grid-0'>
                    <div class='item-resumo item-resumo-0'> <p><span>Status: </span>".$compra->get_status()."</p> </div>
                    <div class='item-resumo item-resumo-0'> <p><span>Data: </span>".date("d/m/Y", strtotime($compra->get_data()))."</p> </div>
                    <div class='item-resumo item-resumo-0'> <p><span>Itens: </span>".$compra->get_unidades()."</p> </div>
                    <div class='item-resumo item-resumo-0'> <p><span>Método de pagamento: </span>".$compra->get_metodo_pagamento()."</p> </div>
                    <div class='item-resumo item-resumo-0'> <p><span>Frete: </span>R$ ".number_format($compra->get_valor_frete(), 2, ',', '.')."</p> </div>
                    <div class='item-resumo item-resumo-0'> <p><span>Total: </span>R$ ".number_format($compra->get_preco_total(), 2, ',', '.')."</p> </div>
                </div>
            </div>";
    }

    public static function monta_listagem_vendas($vendas_compra){
        if($vendas_compra==[]){
            return "<h2>Não há vendas registradas.</h2>";
        }
        $string_listagem = "<div id='compras'>";
        foreach($vendas_compra as $id_compra => $vendas){
            $str_imagens = "<div class='imagens'>";
            $str_titulos = "<div class='info-compra'> <div class='titulos'>";
            $itens = 0;
            $preco=0;
            $str_data = "<div class='data'><p><span>Data: </span>".date("d/m/Y", strtotime($vendas[0]->get_data()))."</p></div>";
            $str_status = "<div class='status'><p><span>Status: </span>".$vendas[0]->get_status()."</p></div>";
            $str_metodo_pagamento = "<div class='metodo_pagamento'><p><span>Forma de pagamento: </span>".$vendas[0]->get_metodo_pagamento()."</p></div> </div>";
            $i=0;
            foreach($vendas as $venda){
                $i++;
                $itens+=$venda->get_unidades();
                $preco+=$venda->get_preco();
                if(!str_contains($str_imagens, "src")){
                    $str_imagens.="<img src='../img/".$venda->get_imagem()."'>";
                }else if(count($vendas)>=4&&$i<=4){
                    $str_imagens.="<img src='../img/".$venda->get_imagem()."'>";
                }
                if(!str_contains($str_titulos, "<p")||$i<=4){
                    $str_titulos.="<p class='titulo'><span>".$venda->get_titulo()."</span></p>";
                }else if($i==5){
                    $str_titulos.="<p class='titulo'>...</p>";
                    break;
                }
            }
            
            $str_preco = "<div class='preco_compra'><p><span>Valor: </span>R$ ".number_format($preco, 2, ',', '.')."</p></div>";
            $str_itens = ($itens==1)?("<div class='itens'><p><span>Qtd.: </span>".$itens." item</p></div>"):("<div class='itens'><p><span>Qtd.: </span>".$itens." itens</p></div>");
            $str_imagens .= "</div>";
            $str_titulos .= "</div>";
            $string_listagem.="<a class = 'compra' href='venda.php?id_compra=".$id_compra."'>".$str_imagens.$str_titulos.$str_itens.$str_data.$str_preco.$str_status.$str_metodo_pagamento."</a>";
        }
        return $string_listagem."</div>";
    }

    public static function monta_venda($vetor_vendas, $compra){
        
        $string_listagem = "<div id='compra'>";
        $unidades=0;
        $preco=0;
        foreach($vetor_vendas as $venda){
            $unidades+=$venda->get_unidades();
            $preco+=$venda->get_preco()*$venda->get_unidades();
            $str_imagem = "<div class='imagem'><img src='../img/".$venda->get_imagem()."'></div>";
            $str_titulo = "<div class='titulo'><p><span>".$venda->get_titulo()."</span></p></div>";
            $str_unidades = ($venda->get_unidades()==1)?("<div class='unidades'><p><span>Qtd.: </span>".$venda->get_unidades()." unidade</p></div>"):("<div class='unidades'><p><span>Qtd.: </span>".$venda->get_unidades()." unidades</p></div>");
            $str_preco = "<div class='preco_compra'><p><span>Valor: </span>R$ ".number_format($venda->get_unidades()*$venda->get_preco(), 2, ',', '.')."</p></div>";

            $string_listagem.="<div class = 'item'>".$str_imagem.$str_titulo.$str_unidades.$str_preco."</div>";
        }
        $compra->set_unidades($unidades);
        $compra->set_preco_total($preco);
        return Vendas::monta_resumo_venda($compra).$string_listagem."</div>";
    }

    public static function monta_resumo_venda($compra){
        return "<div> <a class='btn-voltar-compras' href='minhas_vendas.php'> <i class='fa-solid fa-arrow-left-long'></i> Voltar para minhas vendas </a> <h2 class='sct-h2'><i class='bi bi-cash-stack'></i>Minhas vendas: <span id='id_compra'> Venda - Compra de ID: ".$compra->get_id_compra()."</span></h2></div> <div id='resumo'>
                    <div class='resumo-grid resumo-grid-1'>
                        <div class='item-resumo item-resumo-1'> <p><span>Status: </span>".$compra->get_status()."</p> </div>
                        <div class='item-resumo item-resumo-1'> <p><span>Data: </span>".date("d/m/Y", strtotime($compra->get_data()))."</p> </div>
                        <div class='item-resumo item-resumo-1'> <p><span>Itens: </span>".$compra->get_unidades()."</p> </div>
                        <div class='item-resumo item-resumo-1'> <p><span>Método de pagamento: </span>".$compra->get_metodo_pagamento()."</p> </div>
                        <div class='item-resumo item-resumo-1'> <p><span>Total: </span>R$ ".number_format($compra->get_preco_total(), 2, ',', '.')."</p> </div>
                    </div>
            </div>";
    }
}
?>
