<?php
session_start();
if(!isset($_SESSION['hidden_inputs']))
    header("Location:../view/index.php");

$hidden_inputs=$_SESSION['hidden_inputs'];
unset($_SESSION['hidden_inputs']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../css/cadastro.css">
    <link rel="stylesheet" type="text/css" href="../css/default.css">
    <!-- <link rel="stylesheet" type="text/css" href="../css/editar_usuario.css"> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-... (hash)" crossorigin="anonymous" referrerpolicy="no-referrer"> -->
    <title>Cadastro de Usuário - StockPC </title>
    <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">
    <script defer src="../js/cadastro_final.js"></script>
</head>
<body>
<header>
    <a class="btn-voltar" href="cadastro_inicio.php"> <h1><i class="fa-solid fa-arrow-left fa-lx" style="color: #0075ff;"></i> Voltar</h1></a>
</header>
<div class="formulario-cadastro">
    <form method="POST" action="../controller/confirmar_email.php">
        <div class="cadastre-se">
            <div class="cadastro">
                <h2>Cadastro de endereço</h2>
                <div class="entrar-items">
                  <label for="cep">CEP:*</label>
                    <input type="text" oninput="handleCEP(event)" onKeyPress="if(this.value.length==9) return false;" id="cep" name="cep" required> <!-- onInput="completarEndereco()" -->
                    <p id="mens_cep" class="mens"></p>
                </div>
                <div class="entrar-items">
                  <label for="logradouro">Logradouro:*</label>
                    <input id="logradouro" type="text" id="l" name="logradouro" required >
                    <p id="mens_logradouro" class="mens"></p>
                </div>
                <div class="entrar-items">
                  <label for="numero">Numero:*</label>
                    <input  id="numero" type="number" id="numero" name="numero" required >
                    <p id="mens_numero" class="mens"></p>
                </div>
                <div class="entrar-items">
                  <label for="complemento">Complemento:</label>
                    <input id="complemento" type="text" id="complemento" name="complemento">
                    <p id="mens_complemento" class="mens"></p>
                </div>
                <div class="entrar-items">
                  <label for="bairro">Bairro:*</label>
                    <input id="bairro" type="text" id="bairro" name="bairro" required>
                    <p id="mens_bairro" class="mens"></p>
                </div>
                <div class="entrar-items-localidade">
                    <div class="entrar-items">
                      <label for="cidade">Cidade:*</label>
                        <input id="cidade" type="text" id="cidade" name="cidade" required>
                        <p id="mens_cidade" class="mens"></p>
                    </div>
                    
                    <div class="entrar-items estado">
                      <label for="estado">Estado:*</label>
                      <select id="estados" name="estado" required>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AP">AP</option>
                        <option value="AM">AM</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MT">MT</option>
                        <option value="MS">MS</option>
                        <option value="MG">MG</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PR">PR</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RS">RS</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="SC">SC</option>
                        <option value="SP">SP</option>
                        <option value="SE">SE</option>
                        <option value="TO">TO</option>
                      </select>
                    </div>
                </div>
                <div class="entrar-items">
                  <label for="referencia">Referência:</label>
                    <input type="text" id="referencia" name="referencia">
                    <p id="mens_referência" class="mens"></p>
                </div>
                <p style="font-size:12px; color:#a6a6a6;">(*) - Campos obrigatórios</p><br>
                <?php echo $hidden_inputs; ?>
                <div class="btn-cad justify"><input type="submit" onclick="return verificarEnd()" value="Prosseguir"></div>
                
            </div>
        </div>
    </form>

</div>
    <script src="https://kit.fontawesome.com/9e879c63ad.js" crossorigin="anonymous"></script>
</body>

<?php
        require "req_footer.php" 
    ?>

</html>
