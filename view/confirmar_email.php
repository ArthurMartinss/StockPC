<?php
session_start();
if(!isset($_SESSION['codigo'])||!isset($_SESSION['string_inputs'])){
    header("Location:index.php");
}
$mensagem='';
$string_inputs = $_SESSION['string_inputs'];
$email = $_SESSION['email'];
unset($_SESSION['string_inputs']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar email</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-... (hash)" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/confirmar_email.css">
    <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">
    <script defer src="../js/confirmar_email.js"></script>
</head>
<body>




    <div class="logo-stock" style="justify-content:center; display: flex;"><a href="index.php"><img src="../img/stockpc/logo preta cortada.png"></a></div>
<div class="form-email-div">
    <form action="../controller/cadastro_usuario.php" method="post" autocomplete="off" id="form_confirmacao">
        <div class="login">
            <h1>Insira o código de confirmação</h1>
            <p>Foi enviado um código de confirmação para <u><b><?php echo $email; ?></b></u></p>
            
            <input type="number" name="codigo" autofocus required placeholder="123456" id="input_codigo" onKeyPress="if(this.value.length==6) return false;">
            <?php echo $string_inputs; ?>
            <button id="reenviar" type="button">Reenviar</button>
            <p class="mensagem" id="p_mensagem"><?php echo $mensagem; ?></p>
            
            <button id="botao" type="button">Confirmar</button>
        </div>
    </form>
</div>
    
        <?php
            require "req_footer.php" 
        ?>

        <script src="https://kit.fontawesome.com/9e879c63ad.js" crossorigin="anonymous"></script>

</body>
</html>