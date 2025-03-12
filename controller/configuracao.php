<?php

require_once('../model/AnuncioDAO.php');
require_once('../model/ProdutoDAO.php');
require_once('../utils/Configuracao.php');
session_start();
if(!isset($_POST['proxima_etapa'])&&!isset($_POST['busca'])&&!isset($_SESSION['config'])&&!isset($_POST['pular']))
    header("Location:../view/index.php");

$dao_a = new AnuncioDAO();
$dao_p = new ProdutoDAO();

$p = new Produto();
$a = new Anuncio();

$busca='';
if(isset($_POST['busca']))
    $busca=$_POST['busca'];

$vetor_etapas=['processador', 'cooler', 'placa_mae', 'ram', 'placa_video', 'armazenamento', 'fonte', 'gabinete', 'revisao'];


$max_quant_anunc=1;
$subtotal=0;

if(isset($_POST['search'])){
    $etapa = $_POST['etapa'];
    $busca=$_POST['search'];
    $_SESSION['info']=Configuracao::monta_vetor_informacoes($_SESSION['config'], $busca);

    foreach($_SESSION['config'] as $etapa_config){
        foreach($etapa_config as $vetor_anuncio){
            $subtotal+=$vetor_anuncio['preco']*$vetor_anuncio['quantidade'];
        }
    }
    $_SESSION['config_subtotal']=$subtotal;
    
    header("Location:../view/configuracao.php");
}

if(isset($_POST['voltar'])){
    $etapa = $_POST['voltar'];
    $inicio=array_search($etapa, $vetor_etapas);
    for($i=$inicio;$i<count($vetor_etapas);$i++){
        $indice=$vetor_etapas[$i];
        unset($_SESSION['config'][$indice]);
    }
    foreach($_SESSION['config'] as $etapa_config){
        foreach($etapa_config as $vetor_anuncio){
            $subtotal+=$vetor_anuncio['preco']*$vetor_anuncio['quantidade'];
        }
    }
    $_SESSION['config_subtotal']=$subtotal;
    //echo "<pre>"; print_r($_SESSION['config']); echo "</pre>";
    //$_SESSION['info']=Configuracao::monta_vetor_informacoes($_SESSION['config']);
    
    header("Location:../view/configuracao.php");
}

if(!isset($_SESSION['config']))
    $_SESSION['config']=[];

if(isset($_POST['proxima_etapa'])){
    $etapa=$_POST['proxima_etapa'];

    if(!isset($_POST['pular'])){
        for($i=0;$i<$_POST['quant_anunc'];$i++){
            $indice_id="id_anuncio_".$i;
            $indice_quantidade="quantidade_".$i;
            $indice_preco="preco_anunc_".$i;
    
            $produto = $dao_p->obter_por_anuncio($_POST[$indice_id]);
            
            $_SESSION['config'][$vetor_etapas[(array_search($etapa, $vetor_etapas)-1)]][$i]['id_anuncio']=$_POST[$indice_id];
            $_SESSION['config'][$vetor_etapas[(array_search($etapa, $vetor_etapas)-1)]][$i]['quantidade']=$_POST[$indice_quantidade];
            $_SESSION['config'][$vetor_etapas[(array_search($etapa, $vetor_etapas)-1)]][$i]['preco']=$_POST[$indice_preco];
            $_SESSION['config'][$vetor_etapas[(array_search($etapa, $vetor_etapas)-1)]][$i]['produto']=$produto;
        }
    }else{
        $_SESSION['config'][$vetor_etapas[(array_search($etapa, $vetor_etapas)-1)]]=[];
    }
    
    foreach($_SESSION['config'] as $etapa_config){
        foreach($etapa_config as $vetor_anuncio){
            $subtotal+=$vetor_anuncio['preco']*$vetor_anuncio['quantidade'];
        }
    }
    if($etapa=='revisao'){
        $_SESSION['listagem']=Configuracao::monta_revisao($_SESSION['config']);
        $_SESSION['subtotal']=$subtotal;
        $_SESSION['config_subtotal']=$subtotal;
        echo $_SESSION['config_subtotal'];
        header("Location:../view/revisao.php");
    }
}

$proxima_etapa=$vetor_etapas[(array_search($etapa, $vetor_etapas)+1)];
$metodo = "obter_" . $etapa . "_configuracao"; 
if($etapa=='ram'||$etapa=='placa_video'||$etapa=='armazenamento'||$etapa=='gabinete'){
    if(isset($_SESSION['config']['placa_mae'][0]['produto'])){
        $vetor_listagem=$dao_a->$metodo($_SESSION['config']['placa_mae'][0]['produto'], $busca);
    }else{
        $vetor_listagem=$dao_a->$metodo(busca: $busca);
    }
}elseif($etapa=='processador'||$etapa=='cooler'){
    $vetor_listagem=$dao_a->$metodo($busca);
}elseif($etapa=='fonte'){
    $vetor_listagem=$dao_a->$metodo($_SESSION['config'], $busca);
}else{
    if(isset($_SESSION['config']['processador'][0]['produto'])){
        $vetor_listagem=$dao_a->$metodo($_SESSION['config']['processador'][0]['produto'], $busca);
    }else{
        $vetor_listagem=$dao_a->$metodo(busca: $busca);
    }
}

$string_listagem=Configuracao::monta_listagem($vetor_listagem);

$confirm = "confirm('A sua configuração atual não irá funcionar sem uma peça desta etapa! Tem certeza que deseja pular a etapa atual?')";
$_SESSION['info']['string_opcional']='
<form action="../controller/configuracao.php" method="post" id="frm_pular">
    <input type="hidden" name="proxima_etapa" id="input_proxima_etapa_pular" value="'.$proxima_etapa.'">
    <input type="hidden" name="pular" value="pular">
    <input type="submit" onclick="return '.$confirm.'" id="submit_pular" class="desaconselhado" value="Pular etapa">
</form>';

if((isset($_SESSION['config']['processador'][0]['produto']))){
    if((($etapa=='cooler')&&($_SESSION['config']['processador'][0]['produto']->get_cooler_incluso()))||(($etapa=='placa_video')&&($_SESSION['config']['processador'][0]['produto']->get_video_integrado()))){
        $confirm = "confirm('Deseja pular a etapa atual?')";
        $_SESSION['info']['string_opcional']='
        <form action="../controller/configuracao.php" method="post" id="frm_pular">
            <input type="hidden" name="proxima_etapa" id="input_proxima_etapa_pular" value="'.$proxima_etapa.'">
            <input type="hidden" name="pular" value="pular">
            <input type="submit" onclick="return '.$confirm.'" id="submit_pular" class="permitido" value="Pular etapa">
        </form>';
    }
}


if((isset($_SESSION['config']['placa_mae'][0]['produto']))&&($etapa=='ram')){
    $max_quant_anunc=$_SESSION['config']['placa_mae'][0]['produto']->get_barramentos_ram();
}

$restricoes="";
if(($etapa!='placa_mae')&&(isset($_SESSION['config']['placa_mae'][0]['produto'])))
    $restricoes=Configuracao::monta_restricoes($etapa, $_SESSION['config']['placa_mae'][0]['produto']);

$titulo_etapa=Configuracao::retorna_titulo($etapa);

$_SESSION['info']['string_barra_etapas']=Configuracao::monta_barra_etapas($etapa);
$_SESSION['info']['string_listagem']=$string_listagem;
$_SESSION['info']['etapa']=$etapa;
$_SESSION['info']['proxima_etapa']=$proxima_etapa;
$_SESSION['info']['titulo_etapa']=$titulo_etapa;
$_SESSION['info']['restricoes']=$restricoes;
$_SESSION['info']['max_quant_anunc']=$max_quant_anunc;

$_SESSION['config_subtotal']=$subtotal;

header("Location:../view/configuracao.php");
?>