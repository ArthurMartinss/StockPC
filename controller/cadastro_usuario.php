<?php
session_start();
require_once('../model/UsuarioDAO.php');
$dao = new UsuarioDAO();
$usuario = new Usuario();

$usuario->set_numero($_POST['numero']);
$usuario->set_complemento($_POST['complemento']);
$usuario->set_logradouro($_POST['logradouro']);
$usuario->set_bairro($_POST['bairro']);
$cep=str_replace('-', '', $_POST['cep']);
$usuario->set_cep($cep);
$usuario->set_cidade($_POST['cidade']);
$usuario->set_estado($_POST['estado']);
$usuario->set_referencia($_POST['referencia']);

$usuario->set_nome($_POST['nome']);
$usuario->set_email($_POST['email']);
$celular=str_replace('-', '', $_POST['celular']);
$celular=str_replace('(', '', $celular);
$celular=str_replace(')', '', $celular);
$celular=str_replace(' ', '', $celular);
$usuario->set_celular($celular);
$usuario->set_data_nasc($_POST['data_nasc']);
$usuario->set_senha($_POST['senha']);


if($_POST['cad']=="fis"){
    $cpf=str_replace('.', '', $_POST['cpf']);
    $cpf=str_replace('-', '', $cpf);
    $usuario->set_cpf($cpf);
    $usuario->set_genero($_POST['genero']);
}else{
    $cnpj=str_replace('.', '', $_POST['cnpj']);
    $cnpj=str_replace('-', '', $cnpj);
    $cnpj=str_replace('/', '', $cnpj);
    $usuario->set_cnpj($cnpj);
    $usuario->set_nome_fantasia($_POST['nome_fant']);
    $usuario->set_razao_social($_POST['raz_soc']);
    $usuario->set_tributo($_POST['tributo']);
    if(isset($_POST['tel'])){
        $telefone=str_replace('-', '', $_POST['tel']);
        $telefone=str_replace('(', '', $telefone);
        $telefone=str_replace(')', '', $telefone);
        $telefone=str_replace(' ', '', $telefone);
        $usuario->set_telefone_empresa($telefone);
    }
}


if($dao->inserir($usuario)){
    $_SESSION["email_usuario"] = $usuario->get_email();
    $_SESSION["id_usuario"] = $usuario->get_id_usuario();
    $_SESSION['sucesso'] = true;
    header("Location:../view/login.php");
}else{
    header("Location:../view/index.php");
}

?>
