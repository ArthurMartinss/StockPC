<?php
require_once('../bd/gerenciador_de_conexoes.php');
require_once('AnuncioDTO.php');

class AnuncioDAO{
	private $con;

	function __construct()
	{
		$this->con = GerenciadorDeConexoes::obter_conexao();
	}

	function inserir($anuncio){
		$result = $this->con->query("INSERT INTO anuncios (id_produto, id_vendedor, titulo_anuncio, categoria_produto, preco, estoque, img_princ, imgs_sec, descricao, informacoes_adicionais, ativo, vendas_registradas) VALUES ('" . $anuncio->get_id_produto() . "', '" . $anuncio->get_id_vendedor() . "', '" . $anuncio->get_titulo_anuncio() . "', '" . $anuncio->get_categoria_produto() . "', '" . $anuncio->get_preco() . "', '" . $anuncio->get_estoque() . "', '" . $anuncio->get_img_princ() . "', '" . $anuncio->get_imgs_sec() . "', '" . $anuncio->get_descricao() . "', '" . $anuncio->get_informacoes_adicionais() . "', '" . $anuncio->get_ativo() . "', '" . $anuncio->get_vendas_registradas() . "')");
   		
   		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function alterar($anuncio){
		$result = $this->con->query("UPDATE anuncios SET id_produto = '".$anuncio->get_id_produto()."', id_vendedor = '" . $anuncio->get_id_vendedor() . "', titulo_anuncio = '" . $anuncio->get_titulo_anuncio() . "', categoria_produto = '" . $anuncio->get_categoria_produto() . "', preco = '" . $anuncio->get_preco() . "', estoque = '" . $anuncio->get_estoque() . "', img_princ = '" . $anuncio->get_img_princ() . "', imgs_sec = '" . $anuncio->get_imgs_sec() . "', descricao = '" . $anuncio->get_descricao() . "', informacoes_adicionais = '" . $anuncio->get_informacoes_adicionais() . "', ativo = '" . $anuncio->get_ativo() . "', vendas_registradas = '" . $anuncio->get_vendas_registradas() . "' WHERE (id_anuncio = " . $anuncio->get_id_anuncio(). ")");

		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function excluir($id){  
		$result = $this->con->query("DELETE FROM anuncios WHERE (id_anuncio = '" . $id . "')");

		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function excluir_por_usuario($id){  
		$result = $this->con->query("DELETE FROM anuncios WHERE (id_vendedor = '" . $id . "')");

		if ($result->rowCount() > 0){
   			return true;
   		}
   		else{
   			return false;
   		}
	}

	function obter($id){
		$result =$this->con->query("SELECT * FROM anuncios WHERE (id_anuncio = " . $id . ");");
		$row = $result->fetch(PDO::FETCH_ASSOC);

		$a = new Anuncio();
		$a ->set_id_anuncio($row['id_anuncio']);
		$a ->set_id_produto($row['id_produto']);
		$a ->set_id_vendedor($row['id_vendedor']);
		$a ->set_titulo_anuncio($row['titulo_anuncio']);
		$a ->set_categoria_produto($row['categoria_produto']);
		$a ->set_preco($row['preco']);
		$a ->set_estoque($row['estoque']);
		$a ->set_img_princ($row['img_princ']);
		$a ->set_imgs_sec($row['imgs_sec']);
		$a ->set_descricao($row['descricao']);
		$a ->set_informacoes_adicionais($row['informacoes_adicionais']);
		$a ->set_ativo($row['ativo']);
		$a ->set_vendas_registradas($row['vendas_registradas']);
		
		return $a;
	}

	function obter_todos(){
		$lista = [];
		$result =$this->con->query("SELECT * FROM anuncios;");
 
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
		    $a ->set_id_anuncio($row['id_anuncio']);
			$a ->set_id_produto($row['id_produto']);
			$a ->set_id_vendedor($row['id_vendedor']);
			$a ->set_titulo_anuncio($row['titulo_anuncio']);
			$a ->set_categoria_produto($row['categoria_produto']);
			$a ->set_preco($row['preco']);
			$a ->set_estoque($row['estoque']);
			$a ->set_img_princ($row['img_princ']);
			$a ->set_imgs_sec($row['imgs_sec']);
			$a ->set_descricao($row['descricao']);
			$a ->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a ->set_ativo($row['ativo']);
			$a ->set_vendas_registradas($row['vendas_registradas']);
			array_push($lista, $a);
		}

		return $lista;
	}

	function obter_todos_condicao($query_filtro=""){
		$lista = [];
		$result =$this->con->query("SELECT anuncios.*, produtos.condicao AS condicao FROM anuncios INNER JOIN produtos ON anuncios.id_anuncio = produtos.id_anuncio WHERE anuncios.estoque>0 AND anuncios.ativo=1 ".$query_filtro.";");
 
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
		    $a->set_id_anuncio($row['id_anuncio']);
			$a->set_id_produto($row['id_produto']);
			$a->set_id_vendedor($row['id_vendedor']);
			$a->set_titulo_anuncio($row['titulo_anuncio']);
			$a->set_categoria_produto($row['categoria_produto']);
			$a->set_preco($row['preco']);
			$a->set_estoque($row['estoque']);
			$a->set_img_princ($row['img_princ']);
			$a->set_imgs_sec($row['imgs_sec']);
			$a->set_descricao($row['descricao']);
			$a->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a->set_ativo($row['ativo']);
			$a->set_vendas_registradas($row['vendas_registradas']);
			array_push($lista, ['anuncio'=>$a, 'condicao'=>$row['condicao']]);
		}

		return $lista;
	}

	function obter_por_vendedor($id_vendedor){
		$lista = [];
		$result =$this->con->query("SELECT * FROM anuncios WHERE (id_vendedor = '" . $id_vendedor . "') ORDER BY id_anuncio DESC;");
 
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
		    $a->set_id_anuncio($row['id_anuncio']);
			$a->set_id_produto($row['id_produto']);
			$a->set_id_vendedor($row['id_vendedor']);
			$a->set_titulo_anuncio($row['titulo_anuncio']);
			$a->set_categoria_produto($row['categoria_produto']);
			$a->set_preco($row['preco']);
			$a->set_estoque($row['estoque']);
			$a->set_img_princ($row['img_princ']);
			$a->set_imgs_sec($row['imgs_sec']);
			$a->set_descricao($row['descricao']);
			$a->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a->set_ativo($row['ativo']);
			$a->set_vendas_registradas($row['vendas_registradas']);
			array_push($lista, $a);
		}

		return $lista;
	}

	function obter_ultimo_por_vendedor($id_vendedor){
		$lista = [];
		$result =$this->con->query("SELECT * FROM anuncios WHERE (id_vendedor = '" . $id_vendedor . "') ORDER BY id_anuncio DESC LIMIT 1;");
		$row = $result->fetch(PDO::FETCH_ASSOC);

			$a = new Anuncio();
		    $a ->set_id_anuncio($row['id_anuncio']);
			$a ->set_id_produto($row['id_produto']);
			$a ->set_id_vendedor($row['id_vendedor']);
			$a ->set_titulo_anuncio($row['titulo_anuncio']);
			$a ->set_categoria_produto($row['categoria_produto']);
			$a ->set_preco($row['preco']);
			$a ->set_estoque($row['estoque']);
			$a ->set_img_princ($row['img_princ']);
			$a ->set_imgs_sec($row['imgs_sec']);
			$a ->set_descricao($row['descricao']);
			$a ->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a ->set_ativo($row['ativo']);
			$a ->set_vendas_registradas($row['vendas_registradas']);

		return $a;
	}

	function obter_por_titulo($busca){
		$lista = [];
		$busca=strtolower($busca);

		$result =$this->con->query("SELECT * FROM anuncios WHERE (LOWER(titulo_anuncio) LIKE'%" . $busca . "%');");
		if ($result->rowCount() == 0){
			$palavras_busca=explode(' ', $busca);
            $query="SELECT * FROM anuncios WHERE ";
            foreach($palavras_busca as $palavra){
                $query.="LOWER(titulo_anuncio) LIKE'%" . $palavra . "%' OR ";
            }
            $query= rtrim($query, ' OR ');
			$result =$this->con->query($query);
			if ($result->rowCount() == 0)
				return $lista;
		}
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
			$a ->set_id_anuncio($row['id_anuncio']);
			$a ->set_id_produto($row['id_produto']);
			$a ->set_id_vendedor($row['id_vendedor']);
			$a ->set_titulo_anuncio($row['titulo_anuncio']);
			$a ->set_categoria_produto($row['categoria_produto']);
			$a ->set_preco($row['preco']);
			$a ->set_estoque($row['estoque']);
			$a ->set_img_princ($row['img_princ']);
			$a ->set_imgs_sec($row['imgs_sec']);
			$a ->set_descricao($row['descricao']);
			$a ->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a ->set_ativo($row['ativo']);
			$a ->set_vendas_registradas($row['vendas_registradas']);
			array_push($lista, $a);
		}

		return $lista;
	}

	function obter_por_titulo_condicao($busca, $query_filtro=""){
		$lista = [];
		$busca=strtolower($busca);

		$result =$this->con->query("SELECT anuncios.*, produtos.condicao AS condicao FROM anuncios INNER JOIN produtos ON anuncios.id_anuncio = produtos.id_anuncio WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (LOWER(anuncios.titulo_anuncio) LIKE'%" . $busca . "%') ".$query_filtro.";");
		if ($result->rowCount() == 0){
			$palavras_busca=explode(' ', $busca);
            $query="SELECT * FROM anuncios WHERE ";
            foreach($palavras_busca as $palavra){
                $query.="LOWER(titulo_anuncio) LIKE'%" . $palavra . "%' OR ";
            }
            $query= rtrim($query, ' OR ');
			$result =$this->con->query($query);
			if ($result->rowCount() == 0)
				return $lista;
		}
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
			$a ->set_id_anuncio($row['id_anuncio']);
			$a ->set_id_produto($row['id_produto']);
			$a ->set_id_vendedor($row['id_vendedor']);
			$a ->set_titulo_anuncio($row['titulo_anuncio']);
			$a ->set_categoria_produto($row['categoria_produto']);
			$a ->set_preco($row['preco']);
			$a ->set_estoque($row['estoque']);
			$a ->set_img_princ($row['img_princ']);
			$a ->set_imgs_sec($row['imgs_sec']);
			$a ->set_descricao($row['descricao']);
			$a ->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a ->set_ativo($row['ativo']);
			$a ->set_vendas_registradas($row['vendas_registradas']);
			array_push($lista, ['anuncio'=>$a, 'condicao'=>$row['condicao']]);
		}

		return $lista;
	}

	function obter_preco_min_max($categoria=""){
		$lista = ['min'=>null, 'max'=>null];
		$string_categoria = (($categoria=="")?("categoria_produto IS NOT NULL"):("categoria_produto='".$categoria."'"));

		$result =$this->con->query("SELECT preco FROM anuncios  WHERE ".$string_categoria.";");
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			if($lista['min']==null||$lista['min']>$row['preco'])
				$lista['min']=$row['preco'];
			
			if($lista['max']==null||$lista['max']<$row['preco'])
			$lista['max']=$row['preco'];
		}

		return $lista;
	}

	function obter_processador_configuracao($busca=''){
		$lista = [];
		$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='processador')";

		if($busca!=''){
			$busca=strtolower($busca);

			$result =$this->con->query($query_peca . " AND (LOWER(titulo_anuncio) LIKE'%" . $busca . "%');");
			if ($result->rowCount() == 0){
				$palavras_busca=explode(' ', $busca);
				$query_busca=" AND (";
				foreach($palavras_busca as $palavra){
					$query_busca.="LOWER(titulo_anuncio) LIKE'%" . $palavra . "%' OR ";
				}
				$query_busca= rtrim($query_busca, ' OR ');
				$query_busca.=")";
				$result =$this->con->query($query_peca.$query_busca);
				if ($result->rowCount() == 0)
					return $lista;
			}
		}else{
			$result = $this->con->query($query_peca);
		}
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
			$p = new Produto();

			$a ->set_id_anuncio($row['id_anuncio']);
			$a ->set_id_produto($row['id_produto']);
			$a ->set_id_vendedor($row['id_vendedor']);
			$a ->set_titulo_anuncio($row['titulo_anuncio']);
			$a ->set_categoria_produto($row['categoria_produto']);
			$a ->set_preco($row['preco']);
			$a ->set_estoque($row['estoque']);
			$a ->set_img_princ($row['img_princ']);
			$a ->set_imgs_sec($row['imgs_sec']);
			$a ->set_descricao($row['descricao']);
			$a ->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a ->set_ativo($row['ativo']);
			$a ->set_vendas_registradas($row['vendas_registradas']);

			$p->set_id_produto($row['id_produto']);
			$p->set_id_anuncio($row['id_anuncio']);
			$p->set_id_vendedor($row['id_vendedor']);
			$p->set_altura($row['altura']);
			$p->set_barramento_encaixe_armazenamento($row['barramento_encaixe_armazenamento']);
			$p->set_barramento_encaixe_video($row['barramento_encaixe_video']);
        	$p->set_barramentos_agp($row['barramentos_agp']);
        	$p->set_barramentos_m2_nvme($row['barramentos_m2_nvme']);
        	$p->set_barramentos_m2_sata($row['barramentos_m2_sata']);
			$p->set_barramentos_pata($row['barramentos_pata']);
        	$p->set_barramentos_pci($row['barramentos_pci']);
    		$p->set_barramentos_ram($row['barramentos_ram']);
        	$p->set_barramentos_sata($row['barramentos_sata']);
        	$p->set_barramentos_thunderbolt($row['barramentos_thunderbolt']);
        	$p->set_barramentos_x1($row['barramentos_x1']);
        	$p->set_barramentos_x2($row['barramentos_x2']);
        	$p->set_barramentos_x4($row['barramentos_x4']);
        	$p->set_barramentos_x8($row['barramentos_x8']);
        	$p->set_barramentos_x16($row['barramentos_x16']);
			$p->set_comprimento($row['comprimento']);
			$p->set_condicao($row['condicao']);
			$p->set_consumo_energia($row['consumo_energia']);
        	$p->set_cooler_incluso($row['cooler_incluso']);
			$p->set_ean($row['ean']);
			$p->set_fabricante($row['fabricante']);
			$p->set_fab_comp($row['fab_comp']);
			$p->set_fator_forma($row['fator_forma']);
			$p->set_formato_gabinete($row['formato_gabinete']);
			$p->set_frequencia($row['frequencia']);
			$p->set_largura($row['largura']);
			$p->set_linha($row['linha']);
			$p->set_litografia($row['litografia']);
			$p->set_modelo($row['modelo']);
			$p->set_max_ram($row['max_ram']);
			$p->set_nucleos($row['nucleos']);
			$p->set_potencia($row['potencia']);
			$p->set_quantidade_armazenamento($row['quantidade_armazenamento']);
			$p->set_quantidade_pentes($row['quantidade_pentes']);
			$p->set_ram_pente_individual($row['ram_pente_individual']);
			$p->set_ram_placa_video($row['ram_placa_video']);
			$p->set_ram_total($row['ram_total']);
			$p->set_resfriamento($row['resfriamento']);
			$p->set_soquete($row['soquete']);
			$p->set_selo_80_plus($row['selo_80_plus']);
			$p->set_tempo_uso($row['tempo_uso']);
			$p->set_threads($row['threads']);
			$p->set_tipo_armazenamento($row['tipo_armazenamento']);
			$p->set_tipo_ram($row['tipo_ram']);
			$p->set_video_integrado($row['video_integrado']);

			$vetor=[$a, $p];
			array_push($lista, $vetor);
		}

		return $lista;
	}

	function obter_placa_mae_configuracao($processador=null, $busca=''){
		$lista = [];
		if($processador!=null){
			$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='placa_mae' AND LOWER(produtos.fab_comp)=LOWER('".$processador->get_fabricante()."') AND LOWER(produtos.soquete)=LOWER('".$processador->get_soquete()."'))";
		}else{
			$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='placa_mae')";
		}
		if($busca!=''){
			$busca=strtolower($busca);

			$result =$this->con->query($query_peca . " AND (LOWER(titulo_anuncio) LIKE'%" . $busca . "%');");
			if ($result->rowCount() == 0){
				$palavras_busca=explode(' ', $busca);
				$query_busca=" AND (";
				foreach($palavras_busca as $palavra){
					$query_busca.="LOWER(titulo_anuncio) LIKE'%" . $palavra . "%' OR ";
				}
				$query_busca= rtrim($query_busca, ' OR ');
				$query_busca.=")";
				$result =$this->con->query($query_peca.$query_busca);
				if ($result->rowCount() == 0)
					return $lista;
			}
		}else{
			$result = $this->con->query($query_peca);
		}
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
			$p = new Produto();

			$a ->set_id_anuncio($row['id_anuncio']);
			$a ->set_id_produto($row['id_produto']);
			$a ->set_id_vendedor($row['id_vendedor']);
			$a ->set_titulo_anuncio($row['titulo_anuncio']);
			$a ->set_categoria_produto($row['categoria_produto']);
			$a ->set_preco($row['preco']);
			$a ->set_estoque($row['estoque']);
			$a ->set_img_princ($row['img_princ']);
			$a ->set_imgs_sec($row['imgs_sec']);
			$a ->set_descricao($row['descricao']);
			$a ->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a ->set_ativo($row['ativo']);
			$a ->set_vendas_registradas($row['vendas_registradas']);

			$p->set_id_produto($row['id_produto']);
			$p->set_id_anuncio($row['id_anuncio']);
			$p->set_id_vendedor($row['id_vendedor']);
			$p->set_altura($row['altura']);
			$p->set_barramento_encaixe_armazenamento($row['barramento_encaixe_armazenamento']);
			$p->set_barramento_encaixe_video($row['barramento_encaixe_video']);
        	$p->set_barramentos_agp($row['barramentos_agp']);
        	$p->set_barramentos_m2_nvme($row['barramentos_m2_nvme']);
        	$p->set_barramentos_m2_sata($row['barramentos_m2_sata']);
			$p->set_barramentos_pata($row['barramentos_pata']);
        	$p->set_barramentos_pci($row['barramentos_pci']);
    		$p->set_barramentos_ram($row['barramentos_ram']);
        	$p->set_barramentos_sata($row['barramentos_sata']);
        	$p->set_barramentos_thunderbolt($row['barramentos_thunderbolt']);
        	$p->set_barramentos_x1($row['barramentos_x1']);
        	$p->set_barramentos_x2($row['barramentos_x2']);
        	$p->set_barramentos_x4($row['barramentos_x4']);
        	$p->set_barramentos_x8($row['barramentos_x8']);
        	$p->set_barramentos_x16($row['barramentos_x16']);
			$p->set_comprimento($row['comprimento']);
			$p->set_condicao($row['condicao']);
			$p->set_consumo_energia($row['consumo_energia']);
        	$p->set_cooler_incluso($row['cooler_incluso']);
			$p->set_ean($row['ean']);
			$p->set_fabricante($row['fabricante']);
			$p->set_fab_comp($row['fab_comp']);
			$p->set_fator_forma($row['fator_forma']);
			$p->set_formato_gabinete($row['formato_gabinete']);
			$p->set_frequencia($row['frequencia']);
			$p->set_largura($row['largura']);
			$p->set_linha($row['linha']);
			$p->set_litografia($row['litografia']);
			$p->set_modelo($row['modelo']);
			$p->set_max_ram($row['max_ram']);
			$p->set_nucleos($row['nucleos']);
			$p->set_potencia($row['potencia']);
			$p->set_quantidade_armazenamento($row['quantidade_armazenamento']);
			$p->set_quantidade_pentes($row['quantidade_pentes']);
			$p->set_ram_pente_individual($row['ram_pente_individual']);
			$p->set_ram_placa_video($row['ram_placa_video']);
			$p->set_ram_total($row['ram_total']);
			$p->set_resfriamento($row['resfriamento']);
			$p->set_soquete($row['soquete']);
			$p->set_selo_80_plus($row['selo_80_plus']);
			$p->set_tempo_uso($row['tempo_uso']);
			$p->set_threads($row['threads']);
			$p->set_tipo_armazenamento($row['tipo_armazenamento']);
			$p->set_tipo_ram($row['tipo_ram']);
			$p->set_video_integrado($row['video_integrado']);

			$vetor=[$a, $p];
			array_push($lista, $vetor);
		}

		return $lista;
	}

	function obter_ram_configuracao($placa_mae=null, $busca=''){
		$lista = [];
		if($placa_mae!=null){
			$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='ram' AND produtos.quantidade_pentes<=".$placa_mae->get_barramentos_ram()." AND produtos.ram_total<=".$placa_mae->get_max_ram()." AND produtos.tipo_ram='".$placa_mae->get_tipo_ram()."')";
		}else{
			$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='ram')";
		}
		
		if($busca!=''){
			$busca=strtolower($busca);

			$result =$this->con->query($query_peca . " AND (LOWER(titulo_anuncio) LIKE'%" . $busca . "%');");
			if ($result->rowCount() == 0){
				$palavras_busca=explode(' ', $busca);
				$query_busca=" AND (";
				foreach($palavras_busca as $palavra){
					$query_busca.="LOWER(titulo_anuncio) LIKE'%" . $palavra . "%' OR ";
				}
				$query_busca= rtrim($query_busca, ' OR ');
				$query_busca.=")";
				$result =$this->con->query($query_peca.$query_busca);
				if ($result->rowCount() == 0)
					return $lista;
			}
		}else{
			$result = $this->con->query($query_peca);
		}
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
			$p = new Produto();

			$a ->set_id_anuncio($row['id_anuncio']);
			$a ->set_id_produto($row['id_produto']);
			$a ->set_id_vendedor($row['id_vendedor']);
			$a ->set_titulo_anuncio($row['titulo_anuncio']);
			$a ->set_categoria_produto($row['categoria_produto']);
			$a ->set_preco($row['preco']);
			$a ->set_estoque($row['estoque']);
			$a ->set_img_princ($row['img_princ']);
			$a ->set_imgs_sec($row['imgs_sec']);
			$a ->set_descricao($row['descricao']);
			$a ->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a ->set_ativo($row['ativo']);
			$a ->set_vendas_registradas($row['vendas_registradas']);

			$p->set_id_produto($row['id_produto']);
			$p->set_id_anuncio($row['id_anuncio']);
			$p->set_id_vendedor($row['id_vendedor']);
			$p->set_altura($row['altura']);
			$p->set_barramento_encaixe_armazenamento($row['barramento_encaixe_armazenamento']);
			$p->set_barramento_encaixe_video($row['barramento_encaixe_video']);
        	$p->set_barramentos_agp($row['barramentos_agp']);
        	$p->set_barramentos_m2_nvme($row['barramentos_m2_nvme']);
        	$p->set_barramentos_m2_sata($row['barramentos_m2_sata']);
			$p->set_barramentos_pata($row['barramentos_pata']);
        	$p->set_barramentos_pci($row['barramentos_pci']);
    		$p->set_barramentos_ram($row['barramentos_ram']);
        	$p->set_barramentos_sata($row['barramentos_sata']);
        	$p->set_barramentos_thunderbolt($row['barramentos_thunderbolt']);
        	$p->set_barramentos_x1($row['barramentos_x1']);
        	$p->set_barramentos_x2($row['barramentos_x2']);
        	$p->set_barramentos_x4($row['barramentos_x4']);
        	$p->set_barramentos_x8($row['barramentos_x8']);
        	$p->set_barramentos_x16($row['barramentos_x16']);
			$p->set_comprimento($row['comprimento']);
			$p->set_condicao($row['condicao']);
			$p->set_consumo_energia($row['consumo_energia']);
        	$p->set_cooler_incluso($row['cooler_incluso']);
			$p->set_ean($row['ean']);
			$p->set_fabricante($row['fabricante']);
			$p->set_fab_comp($row['fab_comp']);
			$p->set_fator_forma($row['fator_forma']);
			$p->set_formato_gabinete($row['formato_gabinete']);
			$p->set_frequencia($row['frequencia']);
			$p->set_largura($row['largura']);
			$p->set_linha($row['linha']);
			$p->set_litografia($row['litografia']);
			$p->set_modelo($row['modelo']);
			$p->set_max_ram($row['max_ram']);
			$p->set_nucleos($row['nucleos']);
			$p->set_potencia($row['potencia']);
			$p->set_quantidade_armazenamento($row['quantidade_armazenamento']);
			$p->set_quantidade_pentes($row['quantidade_pentes']);
			$p->set_ram_pente_individual($row['ram_pente_individual']);
			$p->set_ram_placa_video($row['ram_placa_video']);
			$p->set_ram_total($row['ram_total']);
			$p->set_resfriamento($row['resfriamento']);
			$p->set_soquete($row['soquete']);
			$p->set_selo_80_plus($row['selo_80_plus']);
			$p->set_tempo_uso($row['tempo_uso']);
			$p->set_threads($row['threads']);
			$p->set_tipo_armazenamento($row['tipo_armazenamento']);
			$p->set_tipo_ram($row['tipo_ram']);
			$p->set_video_integrado($row['video_integrado']);

			$vetor=[$a, $p];
			array_push($lista, $vetor);
		}

		return $lista;
	}

	function obter_placa_video_configuracao($placa_mae=null, $busca=''){
		$lista = [];

		if($placa_mae!=null){
			$vetor_barramentos_pcie=['x16', 'x8', 'x4', 'x2', 'x1'];
			$vetor_barramentos_outros=['pci', 'agp', 'thunderbolt'];
			$verificacao_barramentos="";
			foreach($vetor_barramentos_outros as $barramento){
				$metodo = "get_barramentos_".$barramento;
				if($placa_mae->$metodo())
					$verificacao_barramentos.= "produtos.barramento_encaixe_video='".$barramento."' OR ";
			}
			for($i=0;$i<count($vetor_barramentos_pcie);$i++){
				$metodo = "get_barramentos_".$vetor_barramentos_pcie[$i];
				if($placa_mae->$metodo()){
					for($j=$i;$j<count($vetor_barramentos_pcie);$j++){
						$verificacao_barramentos.= "produtos.barramento_encaixe_video='".$vetor_barramentos_pcie[$j]."' OR ";
					}
					break;
				}
			}
			$verificacao_barramentos=rtrim($verificacao_barramentos, " OR ");
	
			$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='placa_video') AND (produtos.barramento_encaixe_video IS NOT NULL) AND (".$verificacao_barramentos.")";
		}else{
			$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='placa_video')";
		}

		if($busca!=''){
			$busca=strtolower($busca);

			$result =$this->con->query($query_peca . " AND (LOWER(titulo_anuncio) LIKE'%" . $busca . "%');");
			if ($result->rowCount() == 0){
				$palavras_busca=explode(' ', $busca);
				$query_busca=" AND (";
				foreach($palavras_busca as $palavra){
					$query_busca.="LOWER(titulo_anuncio) LIKE'%" . $palavra . "%' OR ";
				}
				$query_busca= rtrim($query_busca, ' OR ');
				$query_busca.=")";
				$result =$this->con->query($query_peca.$query_busca);
				if ($result->rowCount() == 0)
					return $lista;
			}
		}else{
			$result = $this->con->query($query_peca);
		}
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
			$p = new Produto();

			$a->set_id_anuncio($row['id_anuncio']);
			$a->set_id_produto($row['id_produto']);
			$a->set_id_vendedor($row['id_vendedor']);
			$a->set_titulo_anuncio($row['titulo_anuncio']);
			$a->set_categoria_produto($row['categoria_produto']);
			$a->set_preco($row['preco']);
			$a->set_estoque($row['estoque']);
			$a->set_img_princ($row['img_princ']);
			$a->set_imgs_sec($row['imgs_sec']);
			$a->set_descricao($row['descricao']);
			$a->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a->set_ativo($row['ativo']);
			$a->set_vendas_registradas($row['vendas_registradas']);

			$p->set_id_produto($row['id_produto']);
			$p->set_id_anuncio($row['id_anuncio']);
			$p->set_id_vendedor($row['id_vendedor']);
			$p->set_altura($row['altura']);
			$p->set_barramento_encaixe_armazenamento($row['barramento_encaixe_armazenamento']);
			$p->set_barramento_encaixe_video($row['barramento_encaixe_video']);
        	$p->set_barramentos_agp($row['barramentos_agp']);
        	$p->set_barramentos_m2_nvme($row['barramentos_m2_nvme']);
        	$p->set_barramentos_m2_sata($row['barramentos_m2_sata']);
			$p->set_barramentos_pata($row['barramentos_pata']);
        	$p->set_barramentos_pci($row['barramentos_pci']);
    		$p->set_barramentos_ram($row['barramentos_ram']);
        	$p->set_barramentos_sata($row['barramentos_sata']);
        	$p->set_barramentos_thunderbolt($row['barramentos_thunderbolt']);
        	$p->set_barramentos_x1($row['barramentos_x1']);
        	$p->set_barramentos_x2($row['barramentos_x2']);
        	$p->set_barramentos_x4($row['barramentos_x4']);
        	$p->set_barramentos_x8($row['barramentos_x8']);
        	$p->set_barramentos_x16($row['barramentos_x16']);
			$p->set_comprimento($row['comprimento']);
			$p->set_condicao($row['condicao']);
			$p->set_consumo_energia($row['consumo_energia']);
        	$p->set_cooler_incluso($row['cooler_incluso']);
			$p->set_ean($row['ean']);
			$p->set_fabricante($row['fabricante']);
			$p->set_fab_comp($row['fab_comp']);
			$p->set_fator_forma($row['fator_forma']);
			$p->set_formato_gabinete($row['formato_gabinete']);
			$p->set_frequencia($row['frequencia']);
			$p->set_largura($row['largura']);
			$p->set_linha($row['linha']);
			$p->set_litografia($row['litografia']);
			$p->set_modelo($row['modelo']);
			$p->set_max_ram($row['max_ram']);
			$p->set_nucleos($row['nucleos']);
			$p->set_potencia($row['potencia']);
			$p->set_quantidade_armazenamento($row['quantidade_armazenamento']);
			$p->set_quantidade_pentes($row['quantidade_pentes']);
			$p->set_ram_pente_individual($row['ram_pente_individual']);
			$p->set_ram_placa_video($row['ram_placa_video']);
			$p->set_ram_total($row['ram_total']);
			$p->set_resfriamento($row['resfriamento']);
			$p->set_soquete($row['soquete']);
			$p->set_selo_80_plus($row['selo_80_plus']);
			$p->set_tempo_uso($row['tempo_uso']);
			$p->set_threads($row['threads']);
			$p->set_tipo_armazenamento($row['tipo_armazenamento']);
			$p->set_tipo_ram($row['tipo_ram']);
			$p->set_video_integrado($row['video_integrado']);

			$vetor=[$a, $p];
			array_push($lista, $vetor);
		}

		return $lista;
	}

	function obter_armazenamento_configuracao($placa_mae=null, $busca=''){
		$lista = [];
		if($placa_mae!=null){
			$barramentos_armazenamento="";
			$vetor_barramentos=['pata', 'sata', 'm2_sata', 'm2_nvme'];
			$barramentos_armazenamento="";
			foreach($vetor_barramentos as $barramento){
				$metodo = "get_barramentos_".$barramento;
				if($placa_mae->$metodo())
					$barramentos_armazenamento.= "produtos.barramento_encaixe_armazenamento='".$barramento."' OR ";
			}
			$barramentos_armazenamento=rtrim($barramentos_armazenamento, " OR ");
	
			$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='armazenamento' AND (".$barramentos_armazenamento."))";
		}else{
			$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='armazenamento')";
		}
		

		if($busca!=''){
			$busca=strtolower($busca);

			$result =$this->con->query($query_peca . " AND (LOWER(titulo_anuncio) LIKE'%" . $busca . "%');");
			if ($result->rowCount() == 0){
				$palavras_busca=explode(' ', $busca);
				$query_busca=" AND (";
				foreach($palavras_busca as $palavra){
					$query_busca.="LOWER(titulo_anuncio) LIKE'%" . $palavra . "%' OR ";
				}
				$query_busca= rtrim($query_busca, ' OR ');
				$query_busca.=")";
				$result =$this->con->query($query_peca.$query_busca);
				if ($result->rowCount() == 0)
					return $lista;
			}
		}else{
			$result = $this->con->query($query_peca);
		}
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
			$p = new Produto();

			$a ->set_id_anuncio($row['id_anuncio']);
			$a ->set_id_produto($row['id_produto']);
			$a ->set_id_vendedor($row['id_vendedor']);
			$a ->set_titulo_anuncio($row['titulo_anuncio']);
			$a ->set_categoria_produto($row['categoria_produto']);
			$a ->set_preco($row['preco']);
			$a ->set_estoque($row['estoque']);
			$a ->set_img_princ($row['img_princ']);
			$a ->set_imgs_sec($row['imgs_sec']);
			$a ->set_descricao($row['descricao']);
			$a ->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a ->set_ativo($row['ativo']);
			$a ->set_vendas_registradas($row['vendas_registradas']);

			$p->set_id_produto($row['id_produto']);
			$p->set_id_anuncio($row['id_anuncio']);
			$p->set_id_vendedor($row['id_vendedor']);
			$p->set_altura($row['altura']);
			$p->set_barramento_encaixe_armazenamento($row['barramento_encaixe_armazenamento']);
			$p->set_barramento_encaixe_video($row['barramento_encaixe_video']);
        	$p->set_barramentos_agp($row['barramentos_agp']);
        	$p->set_barramentos_m2_nvme($row['barramentos_m2_nvme']);
        	$p->set_barramentos_m2_sata($row['barramentos_m2_sata']);
			$p->set_barramentos_pata($row['barramentos_pata']);
        	$p->set_barramentos_pci($row['barramentos_pci']);
    		$p->set_barramentos_ram($row['barramentos_ram']);
        	$p->set_barramentos_sata($row['barramentos_sata']);
        	$p->set_barramentos_thunderbolt($row['barramentos_thunderbolt']);
        	$p->set_barramentos_x1($row['barramentos_x1']);
        	$p->set_barramentos_x2($row['barramentos_x2']);
        	$p->set_barramentos_x4($row['barramentos_x4']);
        	$p->set_barramentos_x8($row['barramentos_x8']);
        	$p->set_barramentos_x16($row['barramentos_x16']);
			$p->set_comprimento($row['comprimento']);
			$p->set_condicao($row['condicao']);
			$p->set_consumo_energia($row['consumo_energia']);
        	$p->set_cooler_incluso($row['cooler_incluso']);
			$p->set_ean($row['ean']);
			$p->set_fabricante($row['fabricante']);
			$p->set_fab_comp($row['fab_comp']);
			$p->set_fator_forma($row['fator_forma']);
			$p->set_formato_gabinete($row['formato_gabinete']);
			$p->set_frequencia($row['frequencia']);
			$p->set_largura($row['largura']);
			$p->set_linha($row['linha']);
			$p->set_litografia($row['litografia']);
			$p->set_modelo($row['modelo']);
			$p->set_max_ram($row['max_ram']);
			$p->set_nucleos($row['nucleos']);
			$p->set_potencia($row['potencia']);
			$p->set_quantidade_armazenamento($row['quantidade_armazenamento']);
			$p->set_quantidade_pentes($row['quantidade_pentes']);
			$p->set_ram_pente_individual($row['ram_pente_individual']);
			$p->set_ram_placa_video($row['ram_placa_video']);
			$p->set_ram_total($row['ram_total']);
			$p->set_resfriamento($row['resfriamento']);
			$p->set_soquete($row['soquete']);
			$p->set_selo_80_plus($row['selo_80_plus']);
			$p->set_tempo_uso($row['tempo_uso']);
			$p->set_threads($row['threads']);
			$p->set_tipo_armazenamento($row['tipo_armazenamento']);
			$p->set_tipo_ram($row['tipo_ram']);
			$p->set_video_integrado($row['video_integrado']);

			$vetor=[$a, $p];
			array_push($lista, $vetor);
		}

		return $lista;
	}

	function obter_fonte_configuracao($vetor_config, $busca=''){
		$lista = [];
		$soma_watts=0;
		foreach($vetor_config as $etapa){
			if($etapa!=[]&&is_array($etapa)){
				foreach($etapa as $componente){
					$soma_watts+=intval($componente['produto']->get_consumo_energia())*$componente['quantidade'];
				}
			}
		}
		$min_watts=ceil($soma_watts*1.4);
		$_SESSION['min_watts']=$min_watts;
		$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='fonte') AND (potencia>=".$min_watts.") AND (selo_80_plus NOT LIKE'nenhum')";

		if($busca!=''){
			$busca=strtolower($busca);

			$result =$this->con->query($query_peca . " AND (LOWER(titulo_anuncio) LIKE'%" . $busca . "%');");
			if ($result->rowCount() == 0){
				$palavras_busca=explode(' ', $busca);
				$query_busca=" AND (";
				foreach($palavras_busca as $palavra){
					$query_busca.="LOWER(titulo_anuncio) LIKE'%" . $palavra . "%' OR ";
				}
				$query_busca= rtrim($query_busca, ' OR ');
				$query_busca.=")";
				$result =$this->con->query($query_peca.$query_busca);
				if ($result->rowCount() == 0)
					return $lista;
			}
		}else{
			$result = $this->con->query($query_peca);
		}
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
			$p = new Produto();

			$a ->set_id_anuncio($row['id_anuncio']);
			$a ->set_id_produto($row['id_produto']);
			$a ->set_id_vendedor($row['id_vendedor']);
			$a ->set_titulo_anuncio($row['titulo_anuncio']);
			$a ->set_categoria_produto($row['categoria_produto']);
			$a ->set_preco($row['preco']);
			$a ->set_estoque($row['estoque']);
			$a ->set_img_princ($row['img_princ']);
			$a ->set_imgs_sec($row['imgs_sec']);
			$a ->set_descricao($row['descricao']);
			$a ->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a ->set_ativo($row['ativo']);
			$a ->set_vendas_registradas($row['vendas_registradas']);

			$p->set_id_produto($row['id_produto']);
			$p->set_id_anuncio($row['id_anuncio']);
			$p->set_id_vendedor($row['id_vendedor']);
			$p->set_altura($row['altura']);
			$p->set_barramento_encaixe_armazenamento($row['barramento_encaixe_armazenamento']);
			$p->set_barramento_encaixe_video($row['barramento_encaixe_video']);
       		$p->set_barramentos_agp($row['barramentos_agp']);
        	$p->set_barramentos_m2_nvme($row['barramentos_m2_nvme']);
        	$p->set_barramentos_m2_sata($row['barramentos_m2_sata']);
			$p->set_barramentos_pata($row['barramentos_pata']);
       		$p->set_barramentos_pci($row['barramentos_pci']);
    		$p->set_barramentos_ram($row['barramentos_ram']);
        	$p->set_barramentos_sata($row['barramentos_sata']);
        	$p->set_barramentos_thunderbolt($row['barramentos_thunderbolt']);
        	$p->set_barramentos_x1($row['barramentos_x1']);
        	$p->set_barramentos_x2($row['barramentos_x2']);
        	$p->set_barramentos_x4($row['barramentos_x4']);
        	$p->set_barramentos_x8($row['barramentos_x8']);
        	$p->set_barramentos_x16($row['barramentos_x16']);
			$p->set_comprimento($row['comprimento']);
			$p->set_condicao($row['condicao']);
			$p->set_consumo_energia($row['consumo_energia']);
        	$p->set_cooler_incluso($row['cooler_incluso']);
			$p->set_ean($row['ean']);
			$p->set_fabricante($row['fabricante']);
			$p->set_fab_comp($row['fab_comp']);
			$p->set_fator_forma($row['fator_forma']);
			$p->set_formato_gabinete($row['formato_gabinete']);
			$p->set_frequencia($row['frequencia']);
			$p->set_largura($row['largura']);
			$p->set_linha($row['linha']);
			$p->set_litografia($row['litografia']);
			$p->set_modelo($row['modelo']);
			$p->set_max_ram($row['max_ram']);
			$p->set_nucleos($row['nucleos']);
			$p->set_potencia($row['potencia']);
			$p->set_quantidade_armazenamento($row['quantidade_armazenamento']);
			$p->set_quantidade_pentes($row['quantidade_pentes']);
			$p->set_ram_pente_individual($row['ram_pente_individual']);
			$p->set_ram_placa_video($row['ram_placa_video']);
			$p->set_ram_total($row['ram_total']);
			$p->set_resfriamento($row['resfriamento']);
			$p->set_soquete($row['soquete']);
			$p->set_selo_80_plus($row['selo_80_plus']);
			$p->set_tempo_uso($row['tempo_uso']);
			$p->set_threads($row['threads']);
			$p->set_tipo_armazenamento($row['tipo_armazenamento']);
			$p->set_tipo_ram($row['tipo_ram']);
			$p->set_video_integrado($row['video_integrado']);

			$vetor=[$a, $p];
			array_push($lista, $vetor);
		}

		return $lista;
	}

	function obter_gabinete_configuracao($placa_mae=null, $busca=''){
		$lista = [];
		if($placa_mae!=null){
			if($placa_mae->get_fator_forma()=="eatx"){
				$formato_gabinete="AND (produtos.formato_gabinete='full')";
			}else{
				$formato_gabinete="AND ( produtos.formato_gabinete='full' OR produtos.formato_gabinete='mid')";
			}
	
			$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='gabinete') ".$formato_gabinete."";
		}else{
			$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='gabinete')";
		}
		

		if($busca!=''){
			$busca=strtolower($busca);

			$result =$this->con->query($query_peca . " AND (LOWER(titulo_anuncio) LIKE'%" . $busca . "%');");
			if ($result->rowCount() == 0){
				$palavras_busca=explode(' ', $busca);
				$query_busca=" AND (";
				foreach($palavras_busca as $palavra){
					$query_busca.="LOWER(titulo_anuncio) LIKE'%" . $palavra . "%' OR ";
				}
				$query_busca= rtrim($query_busca, ' OR ');
				$query_busca.=")";
				$result =$this->con->query($query_peca.$query_busca);
				if ($result->rowCount() == 0)
					return $lista;
			}
		}else{
			$result = $this->con->query($query_peca);
		}
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
			$p = new Produto();

			$a ->set_id_anuncio($row['id_anuncio']);
			$a ->set_id_produto($row['id_produto']);
			$a ->set_id_vendedor($row['id_vendedor']);
			$a ->set_titulo_anuncio($row['titulo_anuncio']);
			$a ->set_categoria_produto($row['categoria_produto']);
			$a ->set_preco($row['preco']);
			$a ->set_estoque($row['estoque']);
			$a ->set_img_princ($row['img_princ']);
			$a ->set_imgs_sec($row['imgs_sec']);
			$a ->set_descricao($row['descricao']);
			$a ->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a ->set_ativo($row['ativo']);
			$a ->set_vendas_registradas($row['vendas_registradas']);

			$p->set_id_produto($row['id_produto']);
			$p->set_id_anuncio($row['id_anuncio']);
			$p->set_id_vendedor($row['id_vendedor']);
			$p->set_altura($row['altura']);
			$p->set_barramento_encaixe_armazenamento($row['barramento_encaixe_armazenamento']);
			$p->set_barramento_encaixe_video($row['barramento_encaixe_video']);
        	$p->set_barramentos_agp($row['barramentos_agp']);
        	$p->set_barramentos_m2_nvme($row['barramentos_m2_nvme']);
        	$p->set_barramentos_m2_sata($row['barramentos_m2_sata']);
			$p->set_barramentos_pata($row['barramentos_pata']);
        	$p->set_barramentos_pci($row['barramentos_pci']);
    		$p->set_barramentos_ram($row['barramentos_ram']);
        	$p->set_barramentos_sata($row['barramentos_sata']);
        	$p->set_barramentos_thunderbolt($row['barramentos_thunderbolt']);
        	$p->set_barramentos_x1($row['barramentos_x1']);
        	$p->set_barramentos_x2($row['barramentos_x2']);
        	$p->set_barramentos_x4($row['barramentos_x4']);
        	$p->set_barramentos_x8($row['barramentos_x8']);
        	$p->set_barramentos_x16($row['barramentos_x16']);
			$p->set_comprimento($row['comprimento']);
			$p->set_condicao($row['condicao']);
			$p->set_consumo_energia($row['consumo_energia']);
        	$p->set_cooler_incluso($row['cooler_incluso']);
			$p->set_ean($row['ean']);
			$p->set_fabricante($row['fabricante']);
			$p->set_fab_comp($row['fab_comp']);
			$p->set_fator_forma($row['fator_forma']);
			$p->set_formato_gabinete($row['formato_gabinete']);
			$p->set_frequencia($row['frequencia']);
			$p->set_largura($row['largura']);
			$p->set_linha($row['linha']);
			$p->set_litografia($row['litografia']);
			$p->set_modelo($row['modelo']);
			$p->set_max_ram($row['max_ram']);
			$p->set_nucleos($row['nucleos']);
			$p->set_potencia($row['potencia']);
			$p->set_quantidade_armazenamento($row['quantidade_armazenamento']);
			$p->set_quantidade_pentes($row['quantidade_pentes']);
			$p->set_ram_pente_individual($row['ram_pente_individual']);
			$p->set_ram_placa_video($row['ram_placa_video']);
			$p->set_ram_total($row['ram_total']);
			$p->set_resfriamento($row['resfriamento']);
			$p->set_soquete($row['soquete']);
			$p->set_selo_80_plus($row['selo_80_plus']);
			$p->set_tempo_uso($row['tempo_uso']);
			$p->set_threads($row['threads']);
			$p->set_tipo_armazenamento($row['tipo_armazenamento']);
			$p->set_tipo_ram($row['tipo_ram']);
			$p->set_video_integrado($row['video_integrado']);

			$vetor=[$a, $p];
			array_push($lista, $vetor);
		}

		return $lista;
	}

	function obter_cooler_configuracao($busca=''){
		$lista = [];

		$query_peca= "SELECT anuncios.*, produtos.* FROM anuncios INNER JOIN produtos ON produtos.id_produto=anuncios.id_produto WHERE anuncios.estoque>0 AND anuncios.ativo=1 AND (anuncios.categoria_produto='cooler')";

		if($busca!=''){
			$busca=strtolower($busca);

			$result =$this->con->query($query_peca . " AND (LOWER(titulo_anuncio) LIKE'%" . $busca . "%');");
			if ($result->rowCount() == 0){
				$palavras_busca=explode(' ', $busca);
				$query_busca=" AND (";
				foreach($palavras_busca as $palavra){
					$query_busca.="LOWER(titulo_anuncio) LIKE'%" . $palavra . "%' OR ";
				}
				$query_busca= rtrim($query_busca, ' OR ');
				$query_busca.=")";
				$result =$this->con->query($query_peca.$query_busca);
				if ($result->rowCount() == 0)
					return $lista;
			}
		}else{
			$result = $this->con->query($query_peca);
		}
		
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$a = new Anuncio();
			$p = new Produto();

			$a ->set_id_anuncio($row['id_anuncio']);
			$a ->set_id_produto($row['id_produto']);
			$a ->set_id_vendedor($row['id_vendedor']);
			$a ->set_titulo_anuncio($row['titulo_anuncio']);
			$a ->set_categoria_produto($row['categoria_produto']);
			$a ->set_preco($row['preco']);
			$a ->set_estoque($row['estoque']);
			$a ->set_img_princ($row['img_princ']);
			$a ->set_imgs_sec($row['imgs_sec']);
			$a ->set_descricao($row['descricao']);
			$a ->set_informacoes_adicionais($row['informacoes_adicionais']);
			$a ->set_ativo($row['ativo']);
			$a ->set_vendas_registradas($row['vendas_registradas']);

			$p->set_id_produto($row['id_produto']);
			$p->set_id_anuncio($row['id_anuncio']);
			$p->set_id_vendedor($row['id_vendedor']);
			$p->set_altura($row['altura']);
			$p->set_barramento_encaixe_armazenamento($row['barramento_encaixe_armazenamento']);
			$p->set_barramento_encaixe_video($row['barramento_encaixe_video']);
        	$p->set_barramentos_agp($row['barramentos_agp']);
        	$p->set_barramentos_m2_nvme($row['barramentos_m2_nvme']);
        	$p->set_barramentos_m2_sata($row['barramentos_m2_sata']);
			$p->set_barramentos_pata($row['barramentos_pata']);
        	$p->set_barramentos_pci($row['barramentos_pci']);
    		$p->set_barramentos_ram($row['barramentos_ram']);
        	$p->set_barramentos_sata($row['barramentos_sata']);
        	$p->set_barramentos_thunderbolt($row['barramentos_thunderbolt']);
        	$p->set_barramentos_x1($row['barramentos_x1']);
        	$p->set_barramentos_x2($row['barramentos_x2']);
        	$p->set_barramentos_x4($row['barramentos_x4']);
        	$p->set_barramentos_x8($row['barramentos_x8']);
        	$p->set_barramentos_x16($row['barramentos_x16']);
			$p->set_comprimento($row['comprimento']);
			$p->set_condicao($row['condicao']);
			$p->set_consumo_energia($row['consumo_energia']);
        	$p->set_cooler_incluso($row['cooler_incluso']);
			$p->set_ean($row['ean']);
			$p->set_fabricante($row['fabricante']);
			$p->set_fab_comp($row['fab_comp']);
			$p->set_fator_forma($row['fator_forma']);
			$p->set_formato_gabinete($row['formato_gabinete']);
			$p->set_frequencia($row['frequencia']);
			$p->set_largura($row['largura']);
			$p->set_linha($row['linha']);
			$p->set_litografia($row['litografia']);
			$p->set_modelo($row['modelo']);
			$p->set_max_ram($row['max_ram']);
			$p->set_nucleos($row['nucleos']);
			$p->set_potencia($row['potencia']);
			$p->set_quantidade_armazenamento($row['quantidade_armazenamento']);
			$p->set_quantidade_pentes($row['quantidade_pentes']);
			$p->set_ram_pente_individual($row['ram_pente_individual']);
			$p->set_ram_placa_video($row['ram_placa_video']);
			$p->set_ram_total($row['ram_total']);
			$p->set_resfriamento($row['resfriamento']);
			$p->set_soquete($row['soquete']);
			$p->set_selo_80_plus($row['selo_80_plus']);
			$p->set_tempo_uso($row['tempo_uso']);
			$p->set_threads($row['threads']);
			$p->set_tipo_armazenamento($row['tipo_armazenamento']);
			$p->set_tipo_ram($row['tipo_ram']);
			$p->set_video_integrado($row['video_integrado']);

			$vetor=[$a, $p];
			array_push($lista, $vetor);
		}

		return $lista;
	}
}
