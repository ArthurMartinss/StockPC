<?php
session_start();
if(isset($_POST['id_usuario'])){
    require_once("../model/UsuarioDAO.php");
    $dao = new UsuarioDAO();
    $usuario = $dao->obter($_SESSION['id_usuario']);
    $usuariov = $dao->obter_por_email($_GET['email']);

    if(!empty($_POST['senha']) && !empty($_POST['conf_senha']) && $_POST['senha'] === $_POST['conf_senha']){
        
        $usuario->set_senha(password_hash($_POST['senha'], PASSWORD_DEFAULT));
    }elseif(empty($_POST['senha']) && empty($_POST['conf_senha'])){

    }else{
        $_SESSION['edit_senha_err']=true;
    }
    
    if (isset($_SESSION['cpf'])) {
        if ($_POST['nome'] != $_SESSION['nome']) {
            $usuario->set_nome($_POST['nome']);
        }
    
        if ($_POST['cpf'] != $_SESSION['cpf']) {
            $usuario->set_cpf($_POST['cpf']);
        }
    
        if ($_POST['data_nasc'] != $_SESSION['data_nasc']) {
            $usuario->set_data_nasc($_POST['data_nasc']);
        }
    
        if ($_POST['celular'] != $_SESSION['celular']) {
            $usuario->set_celular($_POST['celular']);
        }
    
        if ($_POST['cep'] != $_SESSION['cep']) {
            $usuario->set_cep($_POST['cep']);
        }
    
        if ($_POST['logradouro'] != $_SESSION['logradouro']) {
            $usuario->set_logradouro($_POST['logradouro']);
        }
    
        if ($_POST['numero'] != $_SESSION['numero']) {
            $usuario->set_numero($_POST['numero']);
        }
    
        if ($_POST['complemento'] != $_SESSION['complemento']) {
            $usuario->set_complemento($_POST['complemento']);
        }
    
        if ($_POST['bairro'] != $_SESSION['bairro']) {
            $usuario->set_bairro($_POST['bairro']);
        }
    
        if ($_POST['cidade'] != $_SESSION['cidade']) {
            $usuario->set_cidade($_POST['cidade']);
        }
    
        if ($_POST['estado'] != $_SESSION['estado']) {
            $usuario->set_estado($_POST['estado']);
        }
    
        if ($_POST['referencia'] != $_SESSION['referencia']) {
            $usuario->set_referencia($_POST['referencia']);
        }
    
    } else {
        if ($_POST['nome'] != $_SESSION['nome']) {
            $usuario->set_nome($_POST['nome']);
        }
    
        if ($_POST['cnpj'] != $_SESSION['cnpj']) {
            $usuario->set_cnpj($_POST['cnpj']);
        }
    
        if ($_POST['data_nasc'] != $_SESSION['data_nasc']) {
            $usuario->set_data_nasc($_POST['data_nasc']);
        }
    
        if ($_POST['celular'] != $_SESSION['celular']) {
            $usuario->set_celular($_POST['celular']);
        }
    
        if ($_POST['raz_soc'] != $_SESSION['raz_soc']) {
            $usuario->set_razao_social($_POST['raz_soc']);
        }
    
        if ($_POST['tributo'] != $_SESSION['tributo']) {
            $usuario->set_tributo($_POST['tributo']);
        }
    
        if ($_POST['nome_fant'] != $_SESSION['nome_fant']) {
            $usuario->set_nome_fantasia($_POST['nome_fant']);
        }
    
        if ($_POST['telefone_empresa'] != $_SESSION['telefone_empresa']) {
            $usuario->set_telefone_empresa($_POST['telefone_empresa']);
        }
    
        if ($_POST['cep'] != $_SESSION['cep']) {
            $usuario->set_cep($_POST['cep']);
        }
    
        if ($_POST['logradouro'] != $_SESSION['logradouro']) {
            $usuario->set_logradouro($_POST['logradouro']);
        }
    
        if ($_POST['numero'] != $_SESSION['numero']) {
            $usuario->set_numero($_POST['numero']);
        }
    
        if ($_POST['complemento'] != $_SESSION['complemento']) {
            $usuario->set_complemento($_POST['complemento']);
        }
    
        if ($_POST['bairro'] != $_SESSION['bairro']) {
            $usuario->set_bairro($_POST['bairro']);
        }
    
        if ($_POST['cidade'] != $_SESSION['cidade']) {
            $usuario->set_cidade($_POST['cidade']);
        }
    
        if ($_POST['estado'] != $_SESSION['estado']) {
            $usuario->set_estado($_POST['estado']);
        }
    
        if ($_POST['referencia'] != $_SESSION['referencia']) {
            $usuario->set_referencia($_POST['referencia']);
        }
    }    

    if($dao->alterar($usuario)){
        header("Location:../view/meuperfil.php");
    } else{
        header("Location:../view/meuperfil.php");
    }
}
?>

// if($_POST['email'] == $_SESSION['email'] or empty($_POST['email'])){
            //     echo "";
            // }elseif($usuariov){
            //     echo $usuario->get_email();
            // }else{
            //     $usuario->set_email($_POST['email']);
            // }
