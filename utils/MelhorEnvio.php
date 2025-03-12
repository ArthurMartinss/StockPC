<?php
require_once("../model/MelhorEnvioDAO.php");
require_once("../model/UsuarioDAO.php");
class MelhorEnvioChamadas {
	
	private $token;
	private $refresh;
	
	public function __construct(){
		$dao_me = new MelhorEnvioDAO();
		$me = $dao_me->obter();
		$timestamp_token = strtotime($me->get_data());
		$timestamp_agora = time();
		$this->token = $me->get_token();
		$this->refresh = $me->get_refresh();
		if($timestamp_agora-$timestamp_token>2160000){
        	$obj_resposta = json_decode($this->renovar_token()['resposta']);
			$token = $obj_resposta->access_token;
			$refresh = $obj_resposta->refresh_token;
			$ME_dao = new MelhorEnvioDAO();
			$ME_obj = $ME_dao->obter();
			$ME_obj->set_token($token); 
			$ME_obj->set_refresh($refresh); 
			$ME_obj->set_data(time()); 
			$ME_dao->alterar($ME_obj);
			$this->token=$token;
			$this->refresh=$refresh;
		}

		
	}

	public function renovar_token(){
			$curl = curl_init();

			curl_setopt_array($curl, [
			CURLOPT_URL => "https://sandbox.melhorenvio.com.br/oauth/token",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode([
				'grant_type' => 'refresh_token',
				'client_id' => 3571,
				'client_secret' => 'ySBPLEdglzZJ4dv03e8uif1agnWaLoJx5KYJFvox',
				'refresh_token' => $this->refresh
			]),
			CURLOPT_HTTPHEADER => [
				"Accept: application/json",
				"Content-Type: application/json",
				"User-Agent: Aplicação (email para contato técnico)"
			],
			]);

			$response = curl_exec($curl);
			$err = curl_error($curl);
			$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
			curl_close($curl);
			return $vetor_resposta;
			/*
			exemplo resposta:
			{
				"token_type": "Bearer",
				"expires_in": 2592000,
				"access_token": "eyJ0eXAiOiJKV...9FNA",
				"refresh_token": "def502004257...b5ff"
			}
			link: https://docs.melhorenvio.com.br/reference/solicitacao-do-token
			*/
	}

	public function cotacao_frete($vetor_anuncios){
		$dao_u = new UsuarioDAO();
        $usuario = $dao_u->obter($_SESSION['id_usuario']);
		$string_produtos='';
		foreach($vetor_anuncios as $id_anuncio => $vetor_anuncio){
			if(isset($vetor_anuncio['dimensoes'])){
				$string_produtos.='{
					"id": "'.$id_anuncio.'",
					"width": '.$vetor_anuncio['dimensoes'][0].',
					"height": '.$vetor_anuncio['dimensoes'][1].',
					"length": '.$vetor_anuncio['dimensoes'][2].',
					"weight": '.$vetor_anuncio['massa'].',
					"insurance_value": '.$vetor_anuncio['preco'].',
					"quantity": '.$vetor_anuncio['quantidade'].'
				},';
			}
		}
		$string_produtos = rtrim($string_produtos, ",");

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/calculate',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"from": {
				"postal_code": "'.$vetor_anuncios['cep'].'"
			},
			"to": {
				"postal_code": "'.$usuario->get_cep().'"
			},
			"products": ['.$string_produtos.']
		}',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		return $vetor_resposta;
	}

	public function cotacao_frete_anuncio($anuncio, $cep_saida, $cep_chegada, $metricas){
		$string_produtos='';
		
		$string_produtos.='{
			"id": "'.$anuncio->get_id_anuncio().'",
			"width": '.$metricas[0].',
			"height": '.$metricas[1].',
			"length": '.$metricas[2].',
			"weight": '.$metricas[3].',
			"insurance_value": '.$anuncio->get_preco().',
			"quantity": 1
		}';

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/calculate',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"from": {
				"postal_code": "'.$cep_saida.'"
			},
			"to": {
				"postal_code": "'.$cep_chegada.'"
			},
			"products": ['.$string_produtos.']
		}',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function inserir_frete_carrinho(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/cart',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
		"from": {
			"name": "nome",
			"phone": "string",
			"email": "atenasystemtcc@gmail.com",
			"document": "48425476852",
			"company_document": "63055996000152",
			"state_register": "string",
			"address": "string",
			"complement": "string",
			"number": "string",
			"district": "string",
			"city": "string",
			"country_id": "BR",
			"postal_code": "13081030",
			"state_abbr": "SP",
			"note": "string"
		},
		"to": {
			"name": "string",
			"phone": "string",
			"email": "leonardofilippetto01@gmail.com",
			"document": "23149777852",
			"address": "string",
			"complement": "string",
			"number": "string",
			"district": "string",
			"city": "string",
			"country_id": "BR",
			"postal_code": "13148218",
			"state_abbr": "SP",
			"note": "string"
		},
		"service": 1,
		"agency": 1,
		"products": [
			{
			"name": "nome",
			"unitary_value": "100"
			}
		],
		"volumes": [
			{
			"height": 10,
			"width": 50,
			"length": 50,
			"weight": 2
			}
		],
		"options": [
			{
			"insurance_value": 100,
			"receipt": false,
			"own_hand": false,
			"reverse": false,
			"non_commercial": false
			}
		]
		}',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;

	}
	
	public function listar_fretes_carrinho(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/cart',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function exibir_item_carrinho(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/cart/?OrderId=1',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function deletar_item_carrinho(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/cart/?OrderId=1',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'DELETE',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function comprar_fretes(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/checkout',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"orders": [
				"1"
			]
		}',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function pre_visualizar_fretes(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/preview',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"orders": [
				"1"
			]
		}',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function gerar_etiquetas(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/generate',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"orders": [
				"1"
			]
		}',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function imprimir_etiquetas(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/print',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"mode": "",
			"orders": [
				"1"
			]
		}',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function pesquisar_etiquetas(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/orders/search?q=*******',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function listar_etiquetas_status(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/orders/status={ Pending | Released | Posted | Delivered | Cancelled | Not Delivered }',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function listar_info_etiquetas(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/orders/?OrderId=1',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'DELETE',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function verificar_cancelamento(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/cancellable',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"orders": [
				"1"
			]
		}',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function cancelar_etiqueta(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/cancel',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"order" => [
				"reason_id" => "2", 
				"id" => "1"
			]
		}',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}

	public function rastrear_etiquetas(){
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/api/v2/me/shipment/tracking',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"orders": [
				"1"
			]
		}',
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->token . '',
			'User-Agent: StockPC (leonardofilippetto01@gmail.com)'
		),
	));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$vetor_resposta=['resposta'=>$response, 'erro'=>$err];
		curl_close($curl);
		
		return $vetor_resposta;
	}
}

?>
