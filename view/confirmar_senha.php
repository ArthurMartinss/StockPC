<?php
$mensagem="";
session_start();
if(isset($_SESSION['erro_senha'])){
    $mensagem="Senha incorreta!";
    unset($_SESSION['erro_senha']);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirme sua senha</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-... (hash)" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">

</head>
<body>
     
        <header>
            <a class="btn-voltar" href="meuperfil.php"> <h1><i class="fa-solid fa-arrow-left fa-lx" style="color: #0075ff;"></i> Voltar</h1></a>
        </header>
        <div class="logo-stock" style="justify-content:center; display: flex;"><img src="../img/stockpc/logo preta cortada.png"></div>
 <!-- <a href="index.php" class="logo-stockpc"><img src="img/stockpc/stockpc_escrito.png" alt=""></a> -->

  
        <form action="../controller/confirmar_senha.php" method="post" autocomplete="off">
            <div class="login login-confirm-senha">
                <h1>Confirme sua senha</h1>
                <input type="password" name="senha" required placeholder="Senha"><br>
                <span class="mensagem"><?php echo $mensagem; ?></span>
                <button id="botao">Confirmar</button>
            </div>
        </form>
                      
        <?php
            require "req_footer.php" 
        ?>

        <script src="https://kit.fontawesome.com/9e879c63ad.js" crossorigin="anonymous"></script>

</body>
</html>