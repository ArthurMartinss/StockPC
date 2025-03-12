<?php
require_once('../bd/gerenciador_de_conexoes.php');
require_once('CompraDTO.php');

class CompraDAO {
	private $con;

	function __construct()
	{
		$this->con = GerenciadorDeConexoes::obter_conexao();
	}

	function inserir($compra){
		$result = $this->con->query("INSERT INTO compras (id_comprador, ids_anuncios, quantidades, ids_vendedores, preco_total, valor_frete, status, valores_categorias, unidades, imagens, precos, metodo_pagamento, titulos) VALUES ('" . $compra->get_id_comprador() . "', '" . $compra->get_ids_anuncios() . "', '" . $compra->get_quantidades() . "', '" . $compra->get_ids_vendedores() . "', '" . $compra->get_preco_total() . "','" . $compra->get_valor_frete() . "','" . $compra->get_status() . "','" . $compra->get_valores_categorias() . "','" . $compra->get_unidades() . "','" . $compra->get_imagens() . "','" . $compra->get_precos() . "','" . $compra->get_metodo_pagamento() . "','" . $compra->get_titulos() . "')");
   		
   		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function alterar($compra){
		$result = $this->con->query("UPDATE compras SET id_comprador = '" . $compra->get_id_comprador() . "', ids_anuncios = '" . $compra->get_ids_anuncios() ."' , quantidades = '" . $compra->get_quantidades() . "', ids_vendedores = '" . $compra->get_ids_vendedores() ."' , preco_total = '" . $compra->get_preco_total() ."' , valor_frete = '" . $compra->get_valor_frete() ."' , status = '" . $compra->get_status() ."' , valores_categorias = '" . $compra->get_valores_categorias() ."' , unidades = '" . $compra->get_unidades() . "' , imagens = '" . $compra->get_imagens() . "', precos = '" . $compra->get_precos() . "', metodo_pagamento = '" . $compra->get_metodo_pagamento() . "', titulos = '" . $compra->get_titulos() . "' WHERE (id_compra = " . $compra->get_id(). ")");

		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function excluir($id){  
		$result = $this->con->query("DELETE FROM compras WHERE (id_compra = '" . $id . "')");

		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function obter($id){
		$result =$this->con->query("SELECT * FROM compras WHERE (id_compra = " . $id . ");");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		$c = new Compra();
		$c->set_id_compra($row['id_compra']);
		$c->set_id_comprador($row['id_comprador']);
		$c->set_ids_anuncios($row['ids_anuncios']);
		$c->set_quantidades($row['quantidades']);
		$c->set_ids_vendedores($row['ids_vendedores']);
		$c->set_preco_total($row['preco_total']);
		$c->set_data($row['data']);
		$c->set_valor_frete($row['valor_frete']);
		$c->set_status($row['status']);
		$c->set_valores_categorias($row['valores_categorias']);
		$c->set_unidades($row['unidades']);
		$c->set_imagens($row['imagens']);
		$c->set_precos($row['precos']);
		$c->set_metodo_pagamento($row['metodo_pagamento']);
        return $c;
	}

	function obter_todos(){
		$lista = [];
		$result =$this->con->query("SELECT * FROM compras;");
 
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$c = new Compra();
			$c->set_id_compra($row['id_compra']);
			$c->set_id_comprador($row['id_comprador']);
			$c->set_ids_anuncios($row['ids_anuncios']);
			$c->set_quantidades($row['quantidades']);
			$c->set_ids_vendedores($row['ids_vendedores']);
			$c->set_preco_total($row['preco_total']);
			$c->set_data($row['data']);
			$c->set_valor_frete($row['valor_frete']);
			$c->set_status($row['status']);
			$c->set_valores_categorias($row['valores_categorias']);
			$c->set_unidades($row['unidades']);
			$c->set_imagens($row['imagens']);
			$c->set_precos($row['precos']);
			$c->set_metodo_pagamento($row['metodo_pagamento']);
			$c->set_titulos($row['titulos']);
			array_push($lista, $c);
		}

		return $lista;
	}

	function obter_todos_por_comprador($id_comprador){
		$lista = [];
		$result =$this->con->query("SELECT * FROM compras WHERE id_comprador LIKE'".$id_comprador."' ORDER BY id_compra DESC;");
 
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$c = new Compra();
			$c->set_id_compra($row['id_compra']);
			$c->set_id_comprador($row['id_comprador']);
			$c->set_ids_anuncios($row['ids_anuncios']);
			$c->set_quantidades($row['quantidades']);
			$c->set_ids_vendedores($row['ids_vendedores']);
			$c->set_preco_total($row['preco_total']);
			$c->set_data($row['data']);
			$c->set_valor_frete($row['valor_frete']);
			$c->set_status($row['status']);
			$c->set_valores_categorias($row['valores_categorias']);
			$c->set_unidades($row['unidades']);
			$c->set_imagens($row['imagens']);
			$c->set_precos($row['precos']);
			$c->set_metodo_pagamento($row['metodo_pagamento']);
			$c->set_titulos($row['titulos']);
			array_push($lista, $c);
		}
		
		return $lista;
	}


    /*function obter_por_nome($nome){
		$lista = [];
		$result = $this->con->query("SELECT codigo, nome, idade FROM cliente WHERE (nome like '%" . $nome . "%');");
 
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$c = new Exemplo();
			$c->set_codigo($row['codigo']);
			$c->set_nome($row['nome']);
			$c->set_idade($row['idade']);
			array_push($lista, $c);
		}

		return $lista;
	}*/

}

?>