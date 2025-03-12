<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
session_start();

if(!isset($_SESSION['id_usuario'])){
    header('Location: ../view/login.php');
}

if(!isset($_SESSION['correspondencia'])){
    header("Location:confirmar_senha.php");
}else{
    unset($_SESSION['correspondencia']);
}

require_once('../model/UsuarioDAO.php');
$dao = new UsuarioDAO();
$usuario = $dao->obter($_SESSION['id_usuario']);

$mensagem_senha="";
if(isset($_SESSION['edit_err'])){
    $mensagem_senha="Campos não coincidem!";
    unset($_SESSION['edit_err']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Meu Perfil - StockPC</title>
        <link rel="stylesheet" href="../css/default.css">
        <link rel="stylesheet" href="../css/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script defer src="https://kit.fontawesome.com/0e01c81990.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script async src="../js/index.js"></script>
        <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">

        <link rel="stylesheet" href="../css/sidebar_gerenciamento.css">

    <link rel="stylesheet" href="../css/senha.css">

    <link rel="stylesheet" href="../css/editar_usuario.css">
</head>
    <body>
        <?php 
            require("req_sidebar_gerenciamento.php");
        ?>

    <div class="sct-body">
        <div class="sct-top"> 
        <a class="btn-voltar-compras" href="meuperfil.php"> <i class="fa-solid fa-arrow-left-long"></i> Voltar para meu perfil </a>
            <h2 class="sct-h2"><i class="bi bi-person-fill"></i> Meu Perfil: <span class="editar-top"> Editar </span> </h2> 
        </div>
            <div class="info-meuperfil">
                <div class="info">
                    <div class="info-top"> <h2>Editar Informações</h2> </div>
                    <div class="info-perfil">
                    <?php 
                        if($usuario->get_cnpj()){
                            echo '<form action="../controller/editar_usuario.php" method="post" id="form_cnpj">
                    <div class="grid-info-1">
                        <div class="editar_usuario">
                            <label for="jur_nome">Nome Completo do Responsável:</label>
                            <input type="text" value="' . $usuario->get_nome() . '" id="jur_nome" name="nome" placeholder="João Santos" required>
                        </div>
                        <div class="editar_usuario">
                            <label for="jur_cnpj">CNPJ:</label>
                            <input type="number" value="' . $usuario->get_cnpj() . '" onKeyPress="if(this.value.length==14) return false;" id="jur_cnpj" name="cnpj" placeholder="12.345.678/0001-90" required>
                        </div>
                        <div class="editar_usuario">
                            <label for="jur_nome_fant">Nome Fantasia:</label>
                            <input type="text" value="' . $usuario->get_nome_fantasia() . '" id="jur_nome_fant" name="nome_fant" placeholder="Samsung" required>
                        </div>
                        <div class="editar_usuario">
                            <label for="jur_raz_soc">Razão Social:</label>
                            <input type="text" value="' . $usuario->get_razao_social() . '" id="jur_raz_soc" name="raz_soc" placeholder="Samsung Electronics Co., Ltd." required >
                        </div>
                        <div class="editar_usuario">
                            <label for="jur_tributo">Informações Tributárias:</label>
                            <select name="tributo" id="jur_tributo" required>
                                <option value="' . $usuario->get_tributo() . '">' . $usuario->get_tributo() . '</option>
                                <option value="contribuinte">Contribuinte ICMS</option>
                                <option value="naocontribuinte">Não contribuinte ICMS</option>
                                <option value="isento">Isento de inscrição estadual</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid-info-2">
                        <div class="editar_usuario">
                            <label for="jur_email">Email da Empresa:</label>
                            <input type="email" value="' . $usuario->get_email() . '" id="jur_email" name="email" placeholder="email@email.com" required>
                        </div>
                        <div class="editar_usuario">
                            <label for="jur_senha">Senha:</label>
                            <input type="password" value="" id="jur_senha" name="senha" placeholder="Sua nova senha" required>
                        </div>
                        <div class="editar_usuario">
                            <label for="jur_conf_senha">Confirmar senha:*</label>
                            <input type="password" value="" id="jur_senha" name="conf_senha" placeholder="Confirmar senha">';
                            echo $mensagem_senha;

                            echo'</div>
                        <div class="editar_usuario">
                            <label for="jur_celular">Celular da Empresa:</label>
                            <input type="tel" value="' . $usuario->get_celular() . '" oninput="handlePhone(event)" id="jur_celular" maxlength="15" name="celular" placeholder="(19) 99999-9999" required>
                        </div>
                        <div class="editar_usuario">
                            <label for="jur_tel">Telefone da Empresa:</label>
                            <input type="number" value="' . $usuario->get_telefone_empresa() . '" onKeyPress="if(this.value.length==10) return false;"  id="jur_tel" placeholder="(19) 9999-9999" name="tel" >
                        </div>
                        <div class="editar_usuario">
                            <label for="jur_data_nasc">Data de Fundação:</label>
                            <input type="date" value="' . $usuario->get_data_nasc() . '" id="jur_data_nasc" name="data_nasc" required>
                        </div>
                    </div>
                    <div class="grid-info-3">
                        <div class="editar_usuario">
                            <label for="jur_logradouro">Logradouro:</label>
                            <input type="text" name="logradouro" id="jur_logradouro" value="' . $usuario->get_logradouro() . '">
                        </div>
                        <div class="editar_usuario">
                            <label for="jur_numero">Número:</label>
                            <input type="number" name="numero" id="jur_numero" value="' . $usuario->get_numero() . '">
                        </div>
                        <div class="editar_usuario">
                            <label for="jur_complemento">Complemento:</label>
                            <input type="text" name="complemento" id="jur_complemento" value="' . $usuario->get_complemento() . '">
                        </div>
                        <div class="editar_usuario">
                            <label for="jur_bairro">Bairro:</label>
                            <input type="text" name="bairro" id="jur_bairro" value="' . $usuario->get_bairro() . '">
                        </div>
                        <div class="editar_usuario_localidade">
                            <div class="editar_usuario">
                                <label for="fis_cidade">Cidade:</label>
                                <input type="text" name="cidade" id="fis_cidade" value="' . $usuario->get_cidade() . '">
                            </div>
                            <div class="editar_usuario estado">
                                <label for="estado">Estado:*</label>
                                <select id="estados" name="estado" required>
                                    <option value="' . $usuario->get_estado() . '">' . $usuario->get_estado() .  '</option>
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
                        <div class="editar_usuario">
                            <label for="jur_referencia">Referência:</label>
                            <input type="text" name="referencia" id="jur_referencia" value="' . $usuario->get_referencia() . '">
                        </div>
                    </div>
                    <div class="grid-botao">
                            <input type="hidden" name="id_usuario" value="' . $usuario->get_id_usuario() . '">
                            <div class="btn-cad btn-confirm-edit onclick="" justify"><input type="submit" value="Confirmar edições"><i class="ri-check-line"></i></div>
               
                    </form>
                    
                
                   <form action="../controller/excluir_usuario.php" method="post">
                        <div class="excluir">
                        <input type="hidden" name="id_usuario" value="' . $usuario->get_id_usuario() . '">
                        <input type="hidden" name="excluir" value="' . $_SESSION['excluir']=true . '">
                            <div class="btn-cad btn-excluir justify"><i class="bi bi-trash-fill"></i><input type="submit" value="Excluir perfil"></div>
                        </div>
                    </form>
                </div> 
                    ';
                        }else{
                            echo '<form method="POST" action="../controller/editar_usuario.php" id="form_cpf">
                      <div class="grid-info-1">
                        <div class="editar_usuario">
                            <label for="fis_nome">Nome:</label>
                            <input type="text" name="nome" id="fis_nome" value="' . $usuario->get_nome() . '" required>
                        </div>
                        <div class="editar_usuario">
                            <label for="fis_email">Email:</label>
                            <input type="text" name="email" id="fis_email" value="' . $usuario->get_email() . '" required>
                        </div>
                        <div class="editar_usuario">
                            <label for="fis_senha">Senha:</label>
                            <input type="password" value="" id="fis_senha" name="senha" placeholder="Sua nova senha">
                        </div>
                        <div class="editar_usuario">
                            <label for="fis_conf_senha">Confirmar senha:</label>
                            <input type="password" value="" id="fis_conf_senha" name="conf_senha" placeholder="Confirmar senha">';
                            echo $mensagem_senha;
                            
                            echo'
                        </div>
                    </div>
                    <div class="grid-info-2">
                        <div class="editar_usuario">
                            <label for="fis_cpf">CPF:</label>
                            <input type="text" name="cpf" id="fis_cpf" value="' . $usuario->get_cpf() . '" required>
                        </div class="editar_usuario">
                        <div class="editar_usuario">
                            <label for="fis_data_nasc">Data de Nascimento: </label>
                            <input type="date" name="data_nasc" id="fis_data_nasc" value="' . $usuario->get_data_nasc() . '" required>
                        </div>
                        <div class="editar_usuario">
                            <label for="fis_celular">Celular:</label>
                            <input type="tel" oninput="handlePhone(event)" value="' . $usuario->get_celular() . '" id="fis_celular" maxlength="15" name="celular" placeholder="(19) 99999-9999">
                        </div>
                    </div>
                    <div class="grid-info-3">
                        <div class="editar_usuario">
                            <label for="fis_cep">CEP:</label>
                            <input type="number" name="cep" id="fis_cep" value="' . $usuario->get_cep() . '">
                        </div>
                        <div class="editar_usuario">
                            <label for="fis_logradouro">Logradouro:</label>
                            <input type="text" name="logradouro" id="fis_logradouro" value="' . $usuario->get_logradouro() . '">
                        </div>
                        <div class="editar_usuario">
                            <label for="fis_numero">Número:</label>
                            <input type="number" name="numero" id="fis_numero" value="' . $usuario->get_numero() . '">
                        </div>
                        <div class="editar_usuario">
                            <label for="fis_complemento">Complemento:</label>
                            <input type="text" name="complemento" id="fis_complemento" value="' . $usuario->get_complemento() . '">
                        </div>
                        <div class="editar_usuario">
                            <label for="fis_bairro">Bairro:</label>
                            <input type="text" name="bairro" id="fis_bairro" value="' . $usuario->get_bairro() . '">
                        </div>
                        <div class="editar_usuario_localidade">
                            <div class="editar_usuario">
                                <label for="fis_cidade">Cidade:</label>
                                <input type="text" name="cidade" id="fis_cidade" value="' . $usuario->get_cidade() . '">
                            </div>
                            <div class="editar_usuario estado">
                                <label for="estado">Estado:*</label>
                                <select id="estados" name="estado" required>
                                    <option value="' . $usuario->get_estado() . '">' . $usuario->get_estado() .  '</option>
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
                        
                        <div class="editar_usuario">
                            <label for="fis_referencia">Referência:</label>
                            <input type="text" name="referencia" id="fis_referencia" value="' . $usuario->get_referencia() . '">
                        </div>
                    </div>
                <div class="grid-botao">
                            <input type="hidden" name="id_usuario" value="' . $usuario->get_id_usuario() . '">
                            <div class="btn-cad btn-confirm-edit onclick="" justify"><input type="submit" value="Confirmar edições"><i class="ri-check-line"></i></div>
               
                    </form>
                    

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="bi bi-trash-fill"></i>Excluir perfil
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Excluir perfil</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           Tem certeza que deseja excluir seu perfil?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                           
                            <form action="../controller/excluir_usuario.php" method="post">
                                
                                <input type="hidden" name="id_usuario" value="' . $usuario->get_id_usuario() . '">
                                <input type="hidden" name="excluir" value="' . $_SESSION['excluir']=true . '">
                                    <div class="btn btn-primary"><input type="submit" value="Sim"></div>
                            </form>

                        </div>
                        </div>
                    </div>
                    </div>
                
                   
                </div> ';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
        

        
    </body>
</html>
