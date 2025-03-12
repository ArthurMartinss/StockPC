<?php
class Compra 
{
	private $id_compra;
	private $id_comprador;
	private $ids_anuncios;
	private $quantidades;
	private $ids_vendedores;
	private $preco_total;
	private $data;
	private $valor_frete;
	private $status;
	private $valores_categorias;
	private $unidades;
	private $imagens;
	private $precos;
	private $metodo_pagamento;
	private $titulos;

	// Métodos para atributo id_compra
	function set_id_compra($id_compra){
		$this->id_compra = $id_compra;
	}

	function get_id_compra(){
		return $this->id_compra;
	}

	// Métodos para atributo id_comprador
	function set_id_comprador($id_comprador){
		$this->id_comprador = $id_comprador;
	}

	function get_id_comprador(){
		return $this->id_comprador;
	}

	// Métodos para atributo ids_anuncios
	function set_ids_anuncios($ids_anuncios){
		$this->ids_anuncios = $ids_anuncios;
	}

	function get_ids_anuncios(){
		return $this->ids_anuncios;
	}

	// Métodos para atributo quantidades
	function set_quantidades($quantidades){
		$this->quantidades = $quantidades;
	}

	function get_quantidades(){
		return $this->quantidades;
	}

	// Métodos para atributo ids_vendedores
	function set_ids_vendedores($ids_vendedores){
		$this->ids_vendedores = $ids_vendedores;
	}

	function get_ids_vendedores(){
		return $this->ids_vendedores;
	}

	// Métodos para atributo preco_total
	function set_preco_total($preco_total){
		$this->preco_total = $preco_total;
	}

	function get_preco_total(){
		return $this->preco_total;
	}

	// Métodos para atributo data
	function set_data($data){
		$this->data = $data;
	}

	function get_data(){
		return $this->data;
	}

	// Métodos para atributo valor_frete
	function set_valor_frete($valor_frete){
		$this->valor_frete = $valor_frete;
	}

	function get_valor_frete(){
		return $this->valor_frete;
	}

	// Métodos para atributo status
	function set_status($status){
		$this->status = $status;
	}

	function get_status(){
		return $this->status;
	}

	// Métodos para atributo valores_categorias
	function set_valores_categorias($valores_categorias){
		$this->valores_categorias = $valores_categorias;
	}

	function get_valores_categorias(){
		return $this->valores_categorias;
	}

	// Métodos para atributo unidades
	function set_unidades($unidades){
		$this->unidades = $unidades;
	}

	function get_unidades(){
		return $this->unidades;
	}

	// Métodos para atributo imagens
	function set_imagens($imagens){
		$this->imagens = $imagens;
	}

	function get_imagens(){
		return $this->imagens;
	}

	// Métodos para atributo precos
	function set_precos($precos){
		$this->precos = $precos;
	}

	function get_precos(){
		return $this->precos;
	}

	// Métodos para atributo metodo_pagamento
	function set_metodo_pagamento($metodo_pagamento){
		$this->metodo_pagamento = $metodo_pagamento;
	}

	function get_metodo_pagamento(){
		return $this->metodo_pagamento;
	}

	// Métodos para atributo titulos
	function set_titulos($titulos){
		$this->titulos = $titulos;
	}

	function get_titulos(){
		return $this->titulos;
	}
}

?>