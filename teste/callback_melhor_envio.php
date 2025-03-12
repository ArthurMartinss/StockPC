<?php
	$client_ID=3571;
	$secret='ySBPLEdglzZJ4dv03e8uif1agnWaLoJx5KYJFvox';
	$scope='cart-read cart-write companies-read companies-write coupons-read coupons-write notifications-read orders-read products-read products-write purchases-read shipping-calculate shipping-cancel shipping-checkout shipping-companies shipping-generate shipping-preview shipping-print shipping-share shipping-tracking ecommerce-shipping transactions-read users-read users-write';
	$redirect_uri="https://stockpc.store/teste/callback_melhor_envio.php";
if (empty($_GET['code'])){
	header("Location: https://sandbox.melhorenvio.com.br/oauth/authorize?client_id=$client_ID&redirect_uri=$redirect_uri&response_type=code&scope=$scope");
}

if (isset($_GET['code'])) {
	$code = $_GET['code'];

	$curl = curl_init();

	curl_setopt_array($curl, [
		CURLOPT_URL => 'https://sandbox.melhorenvio.com.br/oauth/token',
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => http_build_query([
			'grant_type' => 'authorization_code',
			'client_id' => $client_ID,
			'client_secret' => $secret,
			'redirect_uri' => $redirect_uri,
			'code' => $code
		]),	
		CURLOPT_HTTPHEADER => [
			'cache-control: no-cache',
			'content-type: application/x-www-form-urlencoded'
		]
	]);

	$response = curl_exec($curl);

	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		var_dump($err);
	} else {
		echo '<br><br>RESPOSTA:<br><pre>';
		print_r($response);
		echo '</pre><br><br>';
		
		$response = json_decode($response);

		$novo_token = $response->access_token;
		$novo_refresh_token = $response->refresh_token;

		echo $novo_token."<br><br>";
		echo $novo_refresh_token;
	}
}

?>