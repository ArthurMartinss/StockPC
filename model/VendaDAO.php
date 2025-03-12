<?php
require_once('../bd/gerenciador_de_conexoes.php');
require_once('VendaDTO.php');

class VendaDAO {
	private $con;

	function __construct()
	{
		$this->con = GerenciadorDeConexoes::obter_conexao();
	}

	function inserir($venda){
		$result = $this->con->query("INSERT INTO vendas (id_compra, id_comprador, id_vendedor, id_anuncio, unidades, preco, status, metodo_pagamento, imagem, titulo, categoria_peca) VALUES ('" . $venda->get_id_compra() . "', '" . $venda->get_id_comprador() . "', '" . $venda->get_id_vendedor() . "', '" . $venda->get_id_anuncio() . "', '" . $venda->get_unidades() . "', '" . $venda->get_preco() . "','" . $venda->get_status() . "','" . $venda->get_metodo_pagamento() . "','" . $venda->get_imagem() . "','" . $venda->get_titulo() . "','" . $venda->get_categoria_peca() . "')");
   		
   		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function alterar($venda){
		$result = $this->con->query("UPDATE vendas SET id_compr = '" . $venda->get_id_compra() . "', id_comprador = '" . $venda->get_id_comprador() . "', id_vendedor = '" . $venda->get_id_vendedor() ."' , id_anuncio = '" . $venda->get_id_anuncio() . "', unidades = '" . $venda->get_unidades() ."' , preco = '" . $venda->get_preco() ."' , data = '" . $venda->get_data() ."' , status = '" . $venda->get_status() ."' , metodo_pagamento = '" . $venda->get_metodo_pagamento() . "', imagem = '" . $venda->get_imagem() . "', titulo = '" . $venda->get_titulo() . "', categoria_peca = '" . $venda->get_categoria_peca() . "' WHERE (id_venda = " . $venda->get_id(). ")");

		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function excluir($id){  
		$result = $this->con->query("DELETE FROM vendas WHERE (id_venda = '" . $id . "')");

		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function obter($id){
		$result =$this->con->query("SELECT * FROM vendas WHERE (id_venda = " . $id . ");");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		$v = new Venda();
		$v->set_id_venda($row['id_venda']);
        $v->set_id_compra($row['id_compra']);
        $v->set_id_comprador($row['id_comprador']);
        $v->set_id_vendedor($row['id_vendedor']);
        $v->set_id_anuncio($row['id_anuncio']);
        $v->set_unidades($row['unidades']);
        $v->set_preco($row['preco']);
        $v->set_data($row['data']);
        $v->set_status($row['status']);
        $v->set_metodo_pagamento($row['metodo_pagamento']);
        $v->set_imagem($row['imagem']);
        $v->set_titulo($row['titulo']);
        $v->set_categoria_peca($row['categoria_peca']);
        return $v;
	}

	function obter_todos(){
		$lista = [];
		$result =$this->con->query("SELECT * FROM vendas;");
 
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$v = new Venda();
			$v->set_id_venda($row['id_venda']);
            $v->set_id_compra($row['id_compra']);
            $v->set_id_comprador($row['id_comprador']);
            $v->set_id_vendedor($row['id_vendedor']);
            $v->set_id_anuncio($row['id_anuncio']);
            $v->set_unidades($row['unidades']);
            $v->set_preco($row['preco']);
            $v->set_data($row['data']);
            $v->set_status($row['status']);
            $v->set_metodo_pagamento($row['metodo_pagamento']);
			$v->set_imagem($row['imagem']);
			$v->set_titulo($row['titulo']);
			$v->set_categoria_peca($row['categoria_peca']);
			array_push($lista, $v);
		}

		return $lista;
	}

	function obter_por_compra($id_compra){
		$lista = [];
		$result =$this->con->query("SELECT * FROM vendas WHERE (id_compra='$id_compra')");
 
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$v = new Venda();
			$v->set_id_venda($row['id_venda']);
            $v->set_id_compra($row['id_compra']);
            $v->set_id_comprador($row['id_comprador']);
            $v->set_id_vendedor($row['id_vendedor']);
            $v->set_id_anuncio($row['id_anuncio']);
            $v->set_unidades($row['unidades']);
            $v->set_preco($row['preco']);
            $v->set_data($row['data']);
            $v->set_status($row['status']);
            $v->set_metodo_pagamento($row['metodo_pagamento']);
			$v->set_imagem($row['imagem']);
			$v->set_titulo($row['titulo']);
			$v->set_categoria_peca($row['categoria_peca']);
			array_push($lista, $v);
		}

		return $lista;
	}

	function obter_por_vendedor($id_vendedor){
		$lista = [];
		$result =$this->con->query("SELECT * FROM vendas WHERE (id_vendedor='$id_vendedor')");
 
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			if(!isset($lista[$row['id_compra']]))
				$lista[$row['id_compra']]=[];
			$v = new Venda();
			$v->set_id_venda($row['id_venda']);
            $v->set_id_compra($row['id_compra']);
            $v->set_id_comprador($row['id_comprador']);
            $v->set_id_vendedor($row['id_vendedor']);
            $v->set_id_anuncio($row['id_anuncio']);
            $v->set_unidades($row['unidades']);
            $v->set_preco($row['preco']);
            $v->set_data($row['data']);
            $v->set_status($row['status']);
            $v->set_metodo_pagamento($row['metodo_pagamento']);
			$v->set_imagem($row['imagem']);
			$v->set_titulo($row['titulo']);
			$v->set_categoria_peca($row['categoria_peca']);
			array_push($lista[$row['id_compra']], $v);
		}

		return $lista;
	}

	function obter_por_compra_vendedor($id_compra, $id_vendedor){
		$lista = [];
		$result =$this->con->query("SELECT * FROM vendas WHERE (id_vendedor='$id_vendedor') AND (id_compra='$id_compra')");
 
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$v = new Venda();
			$v->set_id_venda($row['id_venda']);
            $v->set_id_compra($row['id_compra']);
            $v->set_id_comprador($row['id_comprador']);
            $v->set_id_vendedor($row['id_vendedor']);
            $v->set_id_anuncio($row['id_anuncio']);
            $v->set_unidades($row['unidades']);
            $v->set_preco($row['preco']);
            $v->set_data($row['data']);
            $v->set_status($row['status']);
            $v->set_metodo_pagamento($row['metodo_pagamento']);
			$v->set_imagem($row['imagem']);
			$v->set_titulo($row['titulo']);
			$v->set_categoria_peca($row['categoria_peca']);
			array_push($lista, $v);
		}

		return $lista;
	}

	function obter_por_usuario_anuncio($id_anuncio, $id_comprador){
		$lista = [];
		$result =$this->con->query("SELECT * FROM vendas WHERE id_anuncio = ".$id_anuncio." AND id_comprador = ".$id_comprador.";");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		if ($result->rowCount() > 0){
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$v = new Venda();
				$v->set_id_venda($row['id_venda']);
				$v->set_id_compra($row['id_compra']);
				$v->set_id_comprador($row['id_comprador']);
				$v->set_id_vendedor($row['id_vendedor']);
				$v->set_id_anuncio($row['id_anuncio']);
				$v->set_unidades($row['unidades']);
				$v->set_preco($row['preco']);
				$v->set_data($row['data']);
				$v->set_status($row['status']);
				$v->set_metodo_pagamento($row['metodo_pagamento']);
				$v->set_imagem($row['imagem']);
				$v->set_titulo($row['titulo']);
				$v->set_categoria_peca($row['categoria_peca']);
				array_push($lista, $v);
			}

			return $lista;
		}else{
			return false;
		}
		
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