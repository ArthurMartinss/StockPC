<?php
class Avaliacao
{
	private $id_avaliacao;
	private $id_usuario;
	private $id_anuncio;
	private $nota;
	private $comentario;
	private $data;

	// Métodos para atributo id_avaliacao
	function set_id_avaliacao($id_avaliacao){
		$this->id_avaliacao = $id_avaliacao;
	}

	function get_id_avaliacao(){
		return $this->id_avaliacao;
	}

	// Métodos para atributo id_usuario
	function set_id_usuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}

	function get_id_usuario(){
		return $this->id_usuario;
	}

	// Métodos para atributo id_anuncio
	function set_id_anuncio($id_anuncio){
		$this->id_anuncio = $id_anuncio;
	}

	function get_id_anuncio(){
		return $this->id_anuncio;
	}

	// Métodos para atributo nota
	function set_nota($nota){
		$this->nota = $nota;
	}

	function get_nota(){
		return $this->nota;
	}

	// Métodos para atributo comentario
	function set_comentario($comentario){
		$this->comentario = $comentario;
	}

	function get_comentario(){
		return $this->comentario;
	}

	// Métodos para atributo data
	function set_data($data){
		$this->data = $data;
	}

	function get_data(){
		return $this->data;
	}
}

?>