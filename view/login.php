<?php
$mensagem="";
session_start();
if(isset($_SESSION['login_err'])){
    $mensagem="Email ou senha inválidos!";
    unset($_SESSION['login_err']);
}
$redirect='';
if(isset($_SESSION['redirect'])){
    $redirect="<input type='hidden' name='redirect' value='".$_SESSION['redirect']."'>";
    unset($_SESSION['redirect']);
}elseif(isset($_POST['redirect'])){
    $redirect="<input type='hidden' name='redirect' value='".$_POST['redirect']."'>";
}

if(isset($_SESSION['sucesso'])){
    unset($_SESSION['sucesso']);
    echo "<script defer>alert('Cadastro realizado com sucesso! Faça login para acessar a sua conta.')</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-... (hash)" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/default.css">
    <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">

</head>
<body>
     
        <header>
            <a class="btn-voltar" href="index.php"> <h1><i class="fa-solid fa-arrow-left fa-lx" style="color: #0075ff;"></i> Voltar</h1></a>
        </header>
        <div class="logo-stock" style="justify-content:center; display: flex;"><img src="../img/stockpc/logo preta cortada.png"></div>
 <!-- <a href="index.php" class="logo-stockpc"><img src="img/stockpc/stockpc_escrito.png" alt=""></a> -->

  
        <form action="../controller/login.php" method="post" autocomplete="off">
            <div class="login">
                <h1> Entrar na StockPC</h1>
                <input type="email" name="email" autofocus required placeholder="Email"><br>
                <input type="password" name="senha"  required placeholder="Senha"><br>
                <?php echo $redirect; ?>
                <span class="mensagem"><?php echo $mensagem; ?></span>
                <button id="botao">Entrar</button>
                <p><b>Novo na StockPC?<a href="cadastro_inicio.php">Crie uma nova conta.</a></b></p>
            </div>
        </form>
                      
        <?php
            require "req_footer.php" 
        ?>

        <script src="https://kit.fontawesome.com/9e879c63ad.js" crossorigin="anonymous"></script>

</body>
</html>