<?php

class Asaas {
	
	private $asaas_url;
	private $asaas_access_token;
	
	public function __construct() {
		$this->asaas_url='https://sandbox.asaas.com/api/v3/';
		$this->asaas_access_token='$aact_YTU5YTE0M2M2N2I4MTliNzk0YTI5N2U5MzdjNWZmNDQ6OjAwMDAwMDAwMDAwMDAwMzgzMDE6OiRhYWNoXzc5ZGM1ZGYzLTlkNGEtNDMxMy05ZmUzLTBjODllZWVkOTI4MA==';
	}

// ++++++++++++++++++++++++
// EXECUÇÃO API CURL

	function retorna_id($nome,$cpf_cnpj) {

		$request='POST';
		$path='/customers';
		$payload='{
			"name": "'.$nome.'",
			"cpfCnpj": "'.$cpf_cnpj.'",
			"notificationDisabled":true
		}';
		$asaas_access_token=$this->asaas_access_token;
		$asaas_url=$this->asaas_url;
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => $asaas_url.$path,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => $request,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'access_token:'.$asaas_access_token
		),
		));

		if ($payload!='')
			curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

		$resposta=curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$retorno['resposta']=$resposta;
		$retorno['erro']=$err;
		return json_decode($retorno['resposta'])->id;
	}

	function executa_curl($request,$path,$params,$payload=null) {

		// $request='POST';
		// $path='/customers';
		// $params=''; //assoc array
		// $payload='{
		// 	"name": "AtenaSystems Company",
		// 	"cpfCnpj": "29984994000100"
	  	// }';
		// $query='';	
		//echo "<br>Payload: $payload<br><br>";
		$asaas_access_token=$this->asaas_access_token;
		$asaas_url=$this->asaas_url;
		$query='';
		if (is_array($params)) {
			$query="?";
			foreach ($params as $chave=>$valor) {
				$query.=$chave."=".$valor."&";
			}
		}
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $asaas_url.$path.$query,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $request,
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'access_token:'.$asaas_access_token
		  ),
		));

		if ($payload!='')
			curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);

		$resposta=curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$retorno['resposta']=$resposta;
		$retorno['erro']=$err;
		return $retorno;
	}
	
}


//id: cus_000005447012;
?>