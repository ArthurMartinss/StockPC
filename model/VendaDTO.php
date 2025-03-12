<?php
class Venda 
{
	private $id_venda;
	private $id_compra;
	private $id_comprador;
	private $id_vendedor;
	private $id_anuncio;
	private $unidades;
	private $preco;
	private $data;
	private $status;
	private $metodo_pagamento;
	private $imagem;
	private $titulo;
	private $categoria_peca;

	// Métodos para atributo id_venda
	function set_id_venda($id_venda){
		$this->id_venda = $id_venda;
	}

	function get_id_venda(){
		return $this->id_venda;
	}

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

	// Métodos para atributo id_vendedor
	function set_id_vendedor($id_vendedor){
		$this->id_vendedor = $id_vendedor;
	}

	function get_id_vendedor(){
		return $this->id_vendedor;
	}

	// Métodos para atributo id_anuncio
	function set_id_anuncio($id_anuncio){
		$this->id_anuncio = $id_anuncio;
	}

	function get_id_anuncio(){
		return $this->id_anuncio;
	}

	// Métodos para atributo unidades
	function set_unidades($unidades){
		$this->unidades = $unidades;
	}

	function get_unidades(){
		return $this->unidades;
	}

	// Métodos para atributo preco
	function set_preco($preco){
		$this->preco = $preco;
	}

	function get_preco(){
		return $this->preco;
	}

	// Métodos para atributo data
	function set_data($data){
		$this->data = $data;
	}

	function get_data(){
		return $this->data;
	}

	// Métodos para atributo status
	function set_status($status){
		$this->status = $status;
	}

	function get_status(){
		return $this->status;
	}

	// Métodos para atributo metodo_pagamento
	function set_metodo_pagamento($metodo_pagamento){
		$this->metodo_pagamento = $metodo_pagamento;
	}

	function get_metodo_pagamento(){
		return $this->metodo_pagamento;
	}

	// Métodos para atributo imagem
	function set_imagem($imagem){
		$this->imagem = $imagem;
	}

	function get_imagem(){
		return $this->imagem;
	}

	// Métodos para atributo titulo
	function set_titulo($titulo){
		$this->titulo = $titulo;
	}

	function get_titulo(){
		return $this->titulo;
	}

	// Métodos para atributo categoria_peca
	function set_categoria_peca($categoria_peca){
		$this->categoria_peca = $categoria_peca;
	}

	function get_categoria_peca(){
		return $this->categoria_peca;
	}
}

?>