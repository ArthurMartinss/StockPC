<?php
class MelhorEnvio 
{
	private $id;
	private $token;
	private $refresh;
	private $data;
	
	// Métodos para atributo id
	function set_id($id){
		$this->id = $id;
	}

	function get_id_usuario(){
		return $this->id;
	}

	// Métodos para atributo token
	function set_token($token){
		$this->token = $token;
	}

	function get_token(){
		return $this->token;
	}

	// Métodos para atributo refresh
	function set_refresh($refresh){
		$this->refresh = $refresh;
	}

	function get_refresh(){
		return $this->refresh;
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