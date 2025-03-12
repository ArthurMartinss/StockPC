<?php
require_once('../bd/gerenciador_de_conexoes.php');
require_once('AvaliacaoDTO.php');

class AvaliacaoDAO{
	private $con;

	function __construct()
	{
		$this->con = GerenciadorDeConexoes::obter_conexao();
	}

	function inserir($avaliacao){
		$result = $this->con->query("INSERT INTO avaliacoes (id_usuario,id_anuncio,nota,comentario) VALUES ('" . $avaliacao->get_id_usuario() . "', '" . $avaliacao->get_id_anuncio() . "', '" . $avaliacao->get_nota() . "', '" . $avaliacao->get_comentario() . "')");
   		
   		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function alterar($avaliacao){
		$result = $this->con->query("UPDATE avaliacoes SET id_usuario = " . $avaliacao->get_id_usuario() . ", id_anuncio = " . $avaliacao->get_id_anuncio() . ", nota = " . $avaliacao->get_nota() . ", comentario = '" . $avaliacao->get_comentario() . "' WHERE (id_avaliacao = " . $avaliacao->get_id_Avaliacao(). ")");

		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function excluir($id){  
		$result = $this->con->query("DELETE FROM avaliacoes WHERE (id_avaliacao = " . $id . ")");

		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function excluir_por_usuario($id){  
		$result = $this->con->query("DELETE FROM avaliacoes WHERE (id_usuario = " . $id . ")");

		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function obter($id){
		$result =$this->con->query("SELECT * FROM avaliacoes WHERE (id_avaliacao = " . $id . ");");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		$a = new Avaliacao();
		$a->set_id_avaliacao($row['id_avaliacao']);
		$a->set_id_usuario($row['id_usuario']);
		$a->set_id_anuncio($row['id_anuncio']);
		$a->set_nota($row['nota']);
		$a->set_comentario($row['comentario']);
		$a->set_data($row['data']);

		return $a;
	}

	function obter_todos(){
		$lista = [];
		$result =$this->con->query("SELECT * FROM avaliacoes;");
 
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Avaliacao();
			$a->set_id_avaliacao($row['id_avaliacao']);
			$a->set_id_usuario($row['id_usuario']);
			$a->set_id_anuncio($row['id_anuncio']);
			$a->set_nota($row['nota']);
			$a->set_comentario($row['comentario']);
			$a->set_data($row['data']);
			array_push($lista, $a);
		}

		return $lista;
	}

	function obter_todos_por_anuncio($id_anuncio){
		$lista = [];
		$result =$this->con->query("SELECT * FROM avaliacoes WHERE id_anuncio = ".$id_anuncio.";");

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Avaliacao();
			$a->set_id_avaliacao($row['id_avaliacao']);
			$a->set_id_usuario($row['id_usuario']);
			$a->set_id_anuncio($row['id_anuncio']);
			$a->set_nota($row['nota']);
			$a->set_comentario($row['comentario']);
			$a->set_data($row['data']);
			array_push($lista, $a);
		}

		return $lista;
	}
	
	function obter_por_usuario_anuncio($id_anuncio, $id_usuario){
		
		$result =$this->con->query("SELECT * FROM avaliacoes WHERE id_anuncio = ".$id_anuncio." AND id_usuario = ".$id_usuario.";");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		if ($result->rowCount() > 0){
			$a = new Avaliacao();
			$a->set_id_avaliacao($row['id_avaliacao']);
			$a->set_id_usuario($row['id_usuario']);
			$a->set_id_anuncio($row['id_anuncio']);
			$a->set_nota($row['nota']);
			$a->set_comentario($row['comentario']);
			$a->set_data($row['data']);
			return $a;
		}
		else{
			return false;
		}
		
	}

	function obter_medias(){
		$lista = [];
		$result =$this->con->query("SELECT id_anuncio, SUM(nota) as soma_notas, COUNT(nota) as quant_avaliacoes  FROM avaliacoes GROUP BY id_anuncio;");

		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$lista[$row['id_anuncio']] = ['soma'=>$row['soma_notas'], 'quantidade'=>$row['quant_avaliacoes'], 'media'=>round($row['soma_notas']/$row['quant_avaliacoes'], 1)];
		}

		return $lista;
	}

}

?>