<?php
require_once("../model/AnuncioDAO.php");
require_once("../model/UsuarioDAO.php");
require_once("../model/CompraDAO.php");
require_once("../model/VendaDAO.php");
require_once("../utils/Frete.php");

class Carrinho{	
	
	public static function adicionar_anuncio($id_anuncio){
        $dao = new AnuncioDAO();
        $anuncio = $dao->obter($id_anuncio);
        $_SESSION['carrinho'][$id_anuncio]['anuncio']=$anuncio;
        $_SESSION['carrinho'][$id_anuncio]['quantidade']=1;
        $_SESSION['carrinho'][$id_anuncio]['estoque']=$anuncio->get_estoque();
        $_SESSION['carrinho'][$id_anuncio]['preco']=$anuncio->get_preco();
    }

	public static function adicionar_configuracao($vetor_config){
        $_SESSION['carrinho']['config']=[];
        $dao = new AnuncioDAO();
        foreach($vetor_config as $etapa){
            foreach($etapa as $componente){
                $anuncio = $dao->obter($componente['id_anuncio']);
                $_SESSION['carrinho']['config'][$componente['id_anuncio']]['anuncio']=$anuncio;
                $_SESSION['carrinho']['config'][$componente['id_anuncio']]['quantidade']=$componente['quantidade'];
                $_SESSION['carrinho']['config'][$componente['id_anuncio']]['estoque']=$anuncio->get_estoque();
                $_SESSION['carrinho']['config'][$componente['id_anuncio']]['preco']=$anuncio->get_preco();
                if(isset($_SESSION['carrinho'][$componente['id_anuncio']])){
                    unset($_SESSION['carrinho'][$componente['id_anuncio']]);
                    Frete::retirar_frete_anuncio($componente['id_anuncio']);
                }
            }
        }
    }
    
	public static function montar_vetor_informacoes($vetor_carrinho, $id_usuario){

        $dao_u = new UsuarioDAO();
        $usuario = $dao_u->obter($id_usuario);
        $complemento = ($usuario->get_complemento())?"<p id='complemento'><b>Complemento: </b><span>".$usuario->get_complemento()."</span></p>":"";

        $vetor_info['string_endereco']="<p id='logradouro'><b>Logradouro: </b><span>".$usuario->get_logradouro()."</span></p><p id='numero'><b>Número: </b><span>".$usuario->get_numero()."</span></p>".$complemento."<p id='bairro'><b>Bairro: </b><span>".$usuario->get_bairro()."</span></p><p id='cidade'><b>Cidade: </b><span>".$usuario->get_cidade()."</span></p>";

        $subtotal = 0;
        $vetor_info['string_produtos']="";
        if(isset($vetor_carrinho['config'])){
            foreach($vetor_carrinho['config'] as $id_anuncio=>$vetor_anuncio_config){
                $vetor_info['string_produtos'].="<div class='item_produtos'>
                <div class='anuncio_lista'>
                        <div class='img_anunc img_anunc_lista'>
                            <img src='../img/".$vetor_anuncio_config['anuncio']->get_img_princ()."' >
                        </div>
                        <div class='titulo_anuncio'> <span class='titulo_anunc titulo_anunc_lista'>".$vetor_anuncio_config['anuncio']->get_titulo_anuncio()."</span> </div>
                        <span class='preco preco_lista' id='preco_".$id_anuncio."'>R$ ".number_format($vetor_anuncio_config['anuncio']->get_preco()*$vetor_anuncio_config['quantidade'], 2, ',', '.')."</span>
                        <div class='container_botoes'>
                            <button ". ( ($vetor_anuncio_config['quantidade']==1)? ("disabled") : ("") ) ." id='subtrair_".$id_anuncio."' class='btn_selecionar btn_retirar config ". ( ($vetor_anuncio_config['quantidade']==1)? ("btn_disabled") : ("") ) ."' onclick='alterarCarrinho(this)'>
                                <i class='bi bi-dash'></i>
                            </button>
                            <span class='quantidade' id='quantidade_".$id_anuncio."'>".$vetor_anuncio_config['quantidade']."</span>
                            <button ". ( ($vetor_anuncio_config['quantidade']==$vetor_anuncio_config['anuncio']->get_estoque()) ? ("disabled") : ("") ) ." id='adicionar_".$id_anuncio."' class='btn_selecionar btn_adicionar config ". ( ($vetor_anuncio_config['quantidade']==$vetor_anuncio_config['anuncio']->get_estoque()) ? ("btn_disabled") : ("") ) ."' onclick='alterarCarrinho(this)'>
                            <i class='bi bi-plus'></i>
                            </button>
                        </div>
                        <div class='form-retirar-div'>
                            <form action='../controller/carrinho.php' class='form-retirar' method='post'>
                                <input type='hidden' name='retirar_config' value='".$id_anuncio."'>
                                <button type='submit' > <i class='bi bi-trash-fill'></i> </button>
                            </form>
                        </div>
                        
                </div>
                </div>";
                $subtotal+=$vetor_anuncio_config['anuncio']->get_preco()*$vetor_anuncio_config['quantidade'];
            }
            unset($vetor_carrinho['config']);
        }
        foreach($vetor_carrinho as $id_anuncio=>$vetor_anuncio){
            

            $vetor_info['string_produtos'].="<div class='item_produtos'>
                <div class='anuncio_lista'>
                        <div class='img_anunc img_anunc_lista'>
                            <img src='../img/".$vetor_anuncio['anuncio']->get_img_princ()."' >
                        </div>
                        <div class='titulo_anuncio'> <span class='titulo_anunc titulo_anunc_lista'>".$vetor_anuncio['anuncio']->get_titulo_anuncio()."</span> </div>
                        <span class='preco preco_lista' id='preco_".$id_anuncio."'>R$ ".number_format($vetor_anuncio['anuncio']->get_preco()*$vetor_anuncio['quantidade'], 2, ',', '.')."</span>
                        <div class='container_botoes'>
                            <button ". ( ($vetor_anuncio['quantidade']==1)? ("disabled") : ("") ) ." class='btn_selecionar btn_retirar ". ( ($vetor_anuncio['quantidade']==1)? ("btn_disabled") : ("") ) ."' id='subtrair_".$id_anuncio."' onclick='alterarCarrinho(this)'>
                                <i class='bi bi-dash'></i>
                            </button>
                            <span class='quantidade' id='quantidade_".$id_anuncio."'>".$vetor_anuncio['quantidade']."</span>
                            <button ". ( ($vetor_anuncio['quantidade']==$vetor_anuncio['anuncio']->get_estoque()) ? ("disabled") : ("") ) ." class='btn_selecionar btn_adicionar ". ( ($vetor_anuncio['quantidade']==$vetor_anuncio['anuncio']->get_estoque()) ? ("btn_disabled") : ("") ) ."' id='adicionar_".$id_anuncio."' onclick='alterarCarrinho(this)'>
                                <i class='bi bi-plus'></i>
                            </button>
                        </div>
                        <div class='form-retirar-div'>
                            <form class='form-retirar'action='../controller/carrinho.php' method='post'>
                                    <input type='hidden' name='retirar' value='".$id_anuncio."'>
                                    <button type='submit' > <i class='bi bi-trash-fill'></i> </button>
                            </form>
                        </div>
                </div>
            </div>";

            
            $subtotal+=$vetor_anuncio['anuncio']->get_preco()*$vetor_anuncio['quantidade'];
        }

        $vetor_info['string_resumo']="
            <div id='resumo_content'>
                <div class='resumo-content-1'>
                <h3 class='h3-resumo-2'>Resumo</h3>
                    <div class='resumo-content-preco-total'>
                        <h5>Preço dos produtos:</h5>
                        <p id='preco_produtos'>R$ ".number_format($subtotal, 2, ',', '.')."</p>
                    </div>
                    <p id='frete'>Frete: <span id='preco_frete'>R$ -</span></p>
                </div>
                <div class='resumo-content-2-1'>
                    <input type='submit' value='Avançar' id='btn_submit' onclick='enviarFormulario(event)'>
                </div>
                
            </div>
            <div class='resumo-content-2'>
                    <input type='submit' value='Avançar' id='btn_submit' onclick='enviarFormulario(event)'>
                </div>";
        return $vetor_info;
    }

    public static function montar_total($vetor_carrinho){
            $total = 0;
            if(isset($vetor_carrinho['frete'])){
                foreach($vetor_carrinho['frete'] as $id_anuncio=>$vetor_frete){
                    $total+=$vetor_frete['valor'];
                }
                unset($vetor_carrinho['frete']);
            }
            if(isset($vetor_carrinho['config'])){
                foreach($vetor_carrinho['config'] as $id_anuncio=>$vetor_anuncio_config){
                    
                    $total+=$vetor_anuncio_config['anuncio']->get_preco()*$vetor_anuncio_config['quantidade'];
                }
                unset($vetor_carrinho['config']);
            }
            foreach($vetor_carrinho as $id_anuncio=>$vetor_anuncio){
             
                
                $total+=$vetor_anuncio['anuncio']->get_preco()*$vetor_anuncio['quantidade'];
            }
            return $total;
    }

    public static function montar_compra($vetor_carrinho, $usuario){
        $dao_a = new AnuncioDAO();
        $dao_v = new VendaDAO();
        $dao_c = new CompraDAO();
        $vetor_vendas = [];
        $id_comprador = $usuario->get_id_usuario();
        $unidades = 0;
        $vetor_valores_categorias = ['processador'=>0, 'cooler'=>0, 'placa_mae'=>0, 'ram'=>0, 'placa_video'=>0, 'armazenamento'=>0, 'fonte'=>0, 'gabinete'=>0];
        $total = 0;
        $ids_anuncios = '';
        $imagens = '';
        $precos = '';
        $titulos = '';
        $quantidades = '';
        $ids_vendedores='.';
        if(isset($vetor_carrinho['config'])){
            foreach($vetor_carrinho['config'] as $id_anuncio=>$vetor_anuncio_config){
                $obj_anuncio = $vetor_anuncio_config['anuncio'];
                if($obj_anuncio->get_estoque()===1){
                    $obj_anuncio->set_ativo(0);
                    $obj_anuncio->set_estoque(0);
                }else{
                    $obj_anuncio->set_estoque($obj_anuncio->get_estoque()-1);
                }
                if($obj_anuncio->get_vendas_registradas()===0||$obj_anuncio->get_vendas_registradas()===null){
                    $obj_anuncio->set_vendas_registradas(1);
                }else{
                    $obj_anuncio->set_vendas_registradas($obj_anuncio->get_vendas_registradas()+1);
                }
                $venda = new Venda();
                $venda->set_id_comprador($_SESSION['id_usuario']);
                $venda->set_id_vendedor($obj_anuncio->get_id_vendedor());
                $venda->set_id_anuncio($obj_anuncio->get_id_anuncio());
                $venda->set_unidades($vetor_anuncio_config['quantidade']);
                $venda->set_preco($obj_anuncio->get_preco());
                $venda->set_status('Concluída');
                $venda->set_metodo_pagamento($_SESSION['metodo_pagamento']);
                $venda->set_imagem($obj_anuncio->get_img_princ());
                $venda->set_titulo($obj_anuncio->get_titulo_anuncio());
                $venda->set_categoria_peca(Carrinho::retorna_titulo($obj_anuncio->get_categoria_produto()));
                array_push($vetor_vendas, $venda);
                $imagens.=$obj_anuncio->get_img_princ().",";
                $precos.=$obj_anuncio->get_preco().",";
                $titulos.=$obj_anuncio->get_titulo_anuncio()."§§";
                $vetor_valores_categorias[$obj_anuncio->get_categoria_produto()]+=$vetor_anuncio_config['anuncio']->get_preco()*$vetor_anuncio_config['quantidade'];
                $unidades+=$vetor_anuncio_config['quantidade'];
                $ids_anuncios.=$id_anuncio.",";
                $quantidades.=$vetor_anuncio_config['quantidade'].",";
                $ids_vendedores.=$vetor_anuncio_config['anuncio']->get_id_vendedor().".";
                $total+=$vetor_anuncio_config['anuncio']->get_preco()*$vetor_anuncio_config['quantidade'];
                $dao_a->alterar($obj_anuncio);
            }
            unset($vetor_carrinho['config']);
        }
        foreach($vetor_carrinho as $id_anuncio=>$vetor_anuncio){
            $obj_anuncio = $vetor_anuncio['anuncio'];
            if($obj_anuncio->get_estoque()===1){
                $obj_anuncio->set_ativo(0);
                $obj_anuncio->set_estoque(0);
            }else{
                $obj_anuncio->set_estoque($obj_anuncio->get_estoque()-1);
            }
            if($obj_anuncio->get_vendas_registradas()===0||$obj_anuncio->get_vendas_registradas()===null){
                $obj_anuncio->set_vendas_registradas(1);
            }else{
                $obj_anuncio->set_vendas_registradas($obj_anuncio->get_vendas_registradas()+1);
            }
            $venda = new Venda();
            $venda->set_id_comprador($_SESSION['id_usuario']);
            $venda->set_id_vendedor($obj_anuncio->get_id_vendedor());
            $venda->set_id_anuncio($obj_anuncio->get_id_anuncio());
            $venda->set_unidades($vetor_anuncio['quantidade']);
            $venda->set_preco($obj_anuncio->get_preco());
            $venda->set_status('Concluída');
            $venda->set_metodo_pagamento($_SESSION['metodo_pagamento']);
            $venda->set_imagem($obj_anuncio->get_img_princ());
            $venda->set_titulo($obj_anuncio->get_titulo_anuncio());
            $venda->set_categoria_peca(Carrinho::retorna_titulo($obj_anuncio->get_categoria_produto()));
            array_push($vetor_vendas, $venda);
            $imagens.=$obj_anuncio->get_img_princ().",";
            $precos.=$obj_anuncio->get_preco().",";
            $titulos.=$obj_anuncio->get_titulo_anuncio()."§§";
            $vetor_valores_categorias[$obj_anuncio->get_categoria_produto()]+=$vetor_anuncio['anuncio']->get_preco()*$vetor_anuncio['quantidade'];
            $unidades+=$vetor_anuncio['quantidade'];
            $ids_anuncios.=$id_anuncio.",";
            $quantidades.=$vetor_anuncio['quantidade'].",";
            $ids_vendedores.=$vetor_anuncio['anuncio']->get_id_vendedor().".";
            $total+=$vetor_anuncio['anuncio']->get_preco()*$vetor_anuncio['quantidade'];
            $dao_a->alterar($obj_anuncio);
        }
        $string_valores_categorias = '';
        foreach($vetor_valores_categorias as $categoria=>$valor){
            $string_valores_categorias.='"'.$categoria.'":'.$valor.', ';
        }
        $string_valores_categorias = '{'.rtrim($string_valores_categorias, ", ").'}';
        $ids_anuncios=rtrim($ids_anuncios, ',');
        $quantidades=rtrim($quantidades, ',');
        $imagens=rtrim($imagens, ',');
        $precos=rtrim($precos, ',');
        $titulos=rtrim($titulos, '§§');
        $compra = new Compra();
        $compra->set_id_comprador($id_comprador);
        $compra->set_ids_anuncios($ids_anuncios);
        $compra->set_quantidades($quantidades);
        $compra->set_ids_vendedores($ids_vendedores);
        $compra->set_preco_total($total+$_SESSION['valor_fretes']);
        $compra->set_valor_frete($_SESSION['valor_fretes']);
        $compra->set_status("Concluída");
        $compra->set_valores_categorias($string_valores_categorias);
        $compra->set_unidades($unidades);
        $compra->set_imagens($imagens);
        $compra->set_precos($precos);
        $compra->set_metodo_pagamento($_SESSION['metodo_pagamento']);
        $compra->set_titulos($titulos);
        $dao_c->inserir($compra);
        $vetor_compras=$dao_c->obter_todos_por_comprador($_SESSION['id_usuario']);
        $id_compra = $vetor_compras[0]->get_id_compra();
        foreach($vetor_vendas as $venda){
            $venda->set_id_compra($id_compra);
            $dao_v->inserir($venda);
        }
    }

    public static function retorna_titulo($etapa){
        if($etapa=="processador"||$etapa=="gabinete"||$etapa=="armazenamento"||$etapa=="cooler")
            return ucfirst($etapa);

        if($etapa=="fonte")
            return "Fonte de alimentação";

        if($etapa=="ram")
            return "Memória RAM";
        
        if($etapa=="placa_mae")
            return "Placa-mãe";
        
        if($etapa=="placa_video")
            return "Placa de vídeo";

    }

}
//

?>