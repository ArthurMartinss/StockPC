<?php

class Configuracao{	

    public const VETOR_ETAPAS = ['processador', 'cooler', 'placa_mae', 'ram', 'placa_video', 'armazenamento', 'fonte', 'gabinete', 'revisao'];
	
	public static function monta_listagem($vetor_listagem){
        $string_listagem='';
        if($vetor_listagem!=[]){
            $string_listagem = (($vetor_listagem[0][0]->get_categoria_produto() != "ram" || $vetor_listagem[0][0]->get_categoria_produto() != "armazenamento") ? "<div id='grid'>" : "<div id='lista'>");
            foreach($vetor_listagem as $bloco) {
                $anuncio = $bloco[0];
                $produto = $bloco[1];
                $id_anunc=($anuncio->get_id_anuncio());
                $id_vend=($anuncio->get_id_vendedor());
                $nome_prod=($anuncio->get_titulo_anuncio());
                $preco=($anuncio->get_preco());
                $img_princ=($anuncio->get_img_princ());

                $string_propriedades='';
                foreach($produto->obter_vetor_atributos() as $propriedade=>$valor){
                    if($propriedade)
                        $string_propriedades.="<input type='hidden' id='".$propriedade."_".$anuncio->get_id_anuncio()."' value='".$valor."' >";
                }
                $string_propriedades.="<input type='hidden' id='estoque_".$anuncio->get_id_anuncio()."' value='".$anuncio->get_estoque()."' >";
                
                if($anuncio->get_categoria_produto()=='ram'||$anuncio->get_categoria_produto()=='armazenamento'){
                    //$pentes=$row['quantidade_pentes'];
                    //$ram_total=$row['ram_total'];
                    if($anuncio->get_categoria_produto()=='ram' && isset($_SESSION['config']['placa_mae'][0]['produto'])){
                        $onclick_retirar = "onclick='retirar_ram(this)'";
                        $onclick_adicionar = "onclick='adicionar_ram(this)'";
                    }else if($anuncio->get_categoria_produto()=='armazenamento' && isset($_SESSION['config']['placa_mae'][0]['produto'])){
                        $onclick_retirar = "onclick='retirar_armazenamento(this)'";
                        $onclick_adicionar = "onclick='adicionar_armazenamento(this)'";
                    }else{
                        $onclick_retirar = "onclick='retirar_generico(this)'";
                        $onclick_adicionar = "onclick='adicionar_generico(this)'";
                    }
                    $string_listagem.="<div class='anuncio anuncio_lista' id='".$id_anunc."' onclick='pagAnunc(event)'>".$string_propriedades."
                    <div class='img_anunc img_anunc_lista'>
                        <img src='../img/".$img_princ."' >
                    </div>
                    <div class='info-prod'>
                        <span class='titulo_anunc titulo_anunc_lista'>$nome_prod</span>
                        <span id='preco_".$id_anunc."' class='preco preco_lista'>R$ ".number_format($preco, 2, ',', '.')."</span>
                        <div class='container_botoes'><button disabled class='btn_selecionar btn_retirar disabled' id='retirar_".$id_anunc."' ".$onclick_retirar."><img class='icone' src='../img/icons/menos.png'></button><button class='btn_selecionar btn_adicionar' id='adicionar_".$id_anunc."' ".$onclick_adicionar."><img class='icone' src='../img/icons/mais.png'></button></div>
                    </div>
                    </div>";
                    
                }else{
                    $string_listagem.="<div class='anuncio' id='".$id_anunc."' onclick='pagAnunc(event)'>".$string_propriedades."
                    <input type='checkbox' id='check_".$id_anunc."' onchange='selecionarPeca(this)' autocomplete='off'>
                    <div class='img_anunc'>
                        <img src='../img/".$img_princ."' >
                    </div>
                    <section class='preco-titulo'>
                        <span class='titulo_anunc'>$nome_prod</span>
                        <span id='preco_".$id_anunc."' class='preco'>R$ ".number_format($preco, 2, ',', '.')."</span>
                    </section>
                    </div>";
                }
            }
            $string_listagem.="</div>";  
        }
        return $string_listagem;
    }
    
    public static function monta_restricoes($etapa, $placa_mae=null){
        if($etapa=='ram'&&$placa_mae!=null){
            $slots = $placa_mae->get_barramentos_ram();
            $max_ram = $placa_mae->get_max_ram();
    
            return "<p id='limite_slots'><span id='label_slots'>Slots usados: </span><span id='slots_usados'>0</span><span id='slots_totais'>/".$slots."</span></p>
            <p id='limite_ram'><span id='label_ram'>Limite de memória: </span><span id='ram_usada'>0GB</span><span id='capacidade_ram'>/".$max_ram."GB</span></p>";

        }else if($etapa=='armazenamento'&&$placa_mae!=null){
            $string = "";
            if($placa_mae->get_barramentos_sata())
                $string.="<p id='barramentos_sata'><span id='label_barramentos_sata'>Slots SATA padrão: </span><span id='barramentos_sata_usados'>0</span><span id='limite_barramentos_sata'>/".$placa_mae->get_barramentos_sata()."</span></p>";
            if($placa_mae->get_barramentos_m2_sata())
                $string.="<p id='barramentos_m2_sata'><span id='label_barramentos_m2_sata'>Slots M.2 SATA: </span><span id='barramentos_m2_sata_usados'>0</span><span id='limite_barramentos_m2_sata'>/".$placa_mae->get_barramentos_m2_sata()."</span></p>";
            if($placa_mae->get_barramentos_m2_nvme())
                $string.="<p id='barramentos_m2_nvme'><span id='label_barramentos_m2_nvme'>Slots M.2 NVMe: </span><span id='barramentos_m2_nvme_usados'>0</span><span id='limite_barramentos_m2_nvme'>/".$placa_mae->get_barramentos_m2_nvme()."</span></p>";
            if($placa_mae->get_barramentos_pata())
                $string.="<p id='barramentos_pata'><span id='label_barramentos_pata'>Slots PATA: </span><span id='barramentos_pata_usados'>0</span><span id='limite_barramentos_pata'>/".$placa_mae->get_barramentos_pata()."</span></p>";
            return $string;
        }

        return "";
    }

    public static function retorna_titulo($etapa){
        if($etapa=="processador"||$etapa=="gabinete"||$etapa=="armazenamento")
            return ucfirst($etapa);

        if($etapa=="fonte")
            return "Fonte de alimentação";

        if($etapa=="cooler")
            return "Resfriamento da CPU";

        if($etapa=="ram")
            return "Memória RAM";
        
        if($etapa=="placa_mae")
            return "Placa-mãe";
        
        if($etapa=="placa_video")
            return "Placa de vídeo";

        if($etapa=="perifericos")
            return "Periféricos";  
        
        if($etapa=="revisao")
            return "Revisão"; 
    }

    public static function monta_revisao($vetor_config){
        $string_listagem="";
        foreach($vetor_config as $etapa){
            if($etapa!=[]){
                foreach($etapa as $componente){
                    $dao_a = new AnuncioDAO();
    
                    $anuncio = $dao_a->obter($componente['id_anuncio']);
    
                    $quantidade = $componente['quantidade'];
    
                    $string_unidades = ($quantidade>1)? $quantidade." unidades" : $quantidade." unidade";
    
                    $img_princ=$anuncio->get_img_princ();
                    $titulo=$anuncio->get_titulo_anuncio();
                    $preco=$anuncio->get_preco();
                    $string_listagem.="
                    <div class='anuncio anuncio_lista'>
                    <!--    <div class='img_anunc img_anunc_lista'> -->
                            <img src='../img/".$img_princ."' >
                     <!--   </div> -->
                     <div class='div_titulo_anunc'> <span class='titulo_anunc titulo_anunc_lista'>$titulo</span> </div> 
                             
                            <div class='div_unid_preco'>
                                <div class='div_preco'>   <span class='preco preco_lista'>R$ ".number_format($preco*$quantidade, 2, ',', '.')."</span> </div>
                                <div class='div_unidades'>  <span class='unidades_rev'>$string_unidades</span> </div>
                            </div>
                    </div>";
                }
            }
            
        }
        return $string_listagem;
    }

    public static function monta_vetor_informacoes($vetor_config, $busca=''){
        $dao_a = new AnuncioDAO();
        if($vetor_config==[]){
            $vetor_info['etapa']="processador";
            $vetor_info['max_quant_anunc']=1;
            $vetor_info['restricoes']='';
            $vetor_info['subtotal']=0;
            $vetor_info['titulo_etapa']='Processador';
            $vetor_info['proxima_etapa']='cooler';
            $vetor_info['string_opcional']='';
            $vetor_info['string_listagem']=Configuracao::monta_listagem($dao_a->obter_processador_configuracao($busca));
            $vetor_info['string_barra_etapas']=Configuracao::monta_barra_etapas($vetor_info['etapa']);
            $confirm = "confirm('A sua configuração atual não irá funcionar sem uma peça desta etapa! Tem certeza que deseja pular a etapa atual?')";
            $vetor_info['string_opcional']='
            <form action="../controller/configuracao.php" method="post" id="frm_pular">
                <input type="hidden" name="proxima_etapa" id="input_proxima_etapa_pular" value="'.$vetor_info['proxima_etapa'].'">
                <input type="hidden" name="pular" value="pular">
                <input type="submit" onclick="return '.$confirm.'" id="submit_pular" class="desaconselhado" value="Pular etapa" style="background-color:#d60000;">
            </form>';
            return $vetor_info;
        }

        $vetor_info=[];

        $vetor_info['subtotal']=0;

        foreach($vetor_config as $etapa_config){
            foreach($etapa_config as $vetor_anuncio){
                $vetor_info['subtotal']+=$vetor_anuncio['preco']*$vetor_anuncio['quantidade'];
            }
        }


        $vetor_info['etapa']=Configuracao::VETOR_ETAPAS[array_search(array_key_last($vetor_config), Configuracao::VETOR_ETAPAS)+1];

        if($vetor_info['etapa']=="revisao"){
                $_SESSION['listagem']=Configuracao::monta_revisao($vetor_config);
                $_SESSION['subtotal']=$vetor_info['subtotal'];
                $_SESSION['config_subtotal']=$vetor_info['subtotal'];
                echo $_SESSION['config_subtotal'];
                header("Location:../view/revisao.php");
        }
        
            

        $vetor_info['proxima_etapa']=Configuracao::VETOR_ETAPAS[array_search(array_key_last($vetor_config), Configuracao::VETOR_ETAPAS)+2];

        $vetor_info['restricoes']=Configuracao::monta_restricoes($vetor_info['etapa'], (isset($vetor_config['placa_mae'][0]['produto']))?($vetor_config['placa_mae'][0]['produto']):(null));


        $vetor_info['titulo_etapa']=Configuracao::retorna_titulo($vetor_info['etapa']);

        $vetor_info['max_quant_anunc']=($vetor_info['etapa']=='ram'&&isset($vetor_config['placa_mae'][0]['produto']))?$vetor_config['placa_mae'][0]['produto']->get_barramentos_ram():1;

        $vetor_info['string_opcional']='';
        if(((isset($vetor_config['processador'][0]['produto']))&&(($vetor_info['etapa']=='cooler')&&($vetor_config['processador'][0]['produto']->get_cooler_incluso()))||(isset($vetor_config['processador'][0]['produto']))&&($vetor_info['etapa']=='placa_video')&&($vetor_config['processador'][0]['produto']->get_video_integrado()))){
            $confirm = "confirm('Deseja pular a etapa atual?')";
            $vetor_info['string_opcional']='
            <form action="../controller/configuracao.php" method="post" id="frm_pular">
                <input type="hidden" name="proxima_etapa" id="input_proxima_etapa_pular" value="'.$vetor_info['proxima_etapa'].'">
                <input type="hidden" name="pular" value="pular">
                <input type="submit" onclick="return '.$confirm.'" id="submit_pular" class="permitido" value="Pular etapa">
            </form>';
        }else{
            $confirm = "confirm('A sua configuração atual não irá funcionar sem uma peça desta etapa! Tem certeza que deseja pular a etapa atual?')";
            $vetor_info['string_opcional']='
            <form action="../controller/configuracao.php" method="post" id="frm_pular">
                <input type="hidden" name="proxima_etapa" id="input_proxima_etapa_pular" value="'.$vetor_info['proxima_etapa'].'">
                <input type="hidden" name="pular" value="pular">
                <input type="submit" onclick="return '.$confirm.'" id="submit_pular" value="Pular etapa" class="desaconselhado" style="background-color:#e30000;">
            </form>';
        }
        $metodo = "obter_".$vetor_info['etapa']."_configuracao";

        $processador = ((isset($vetor_config['processador'][0]['produto']))?($vetor_config['processador'][0]['produto']):(null));
        $placa_mae = ((isset($vetor_config['placa_mae'][0]['produto']))?($vetor_config['placa_mae'][0]['produto']):(null));

        if($vetor_info['etapa']=='ram'||$vetor_info['etapa']=='placa_video'||$vetor_info['etapa']=='armazenamento'||$vetor_info['etapa']=='gabinete'){
            $vetor_info['string_listagem']=Configuracao::monta_listagem($dao_a->$metodo($placa_mae, $busca));
        }elseif($vetor_info['etapa']=='processador'||$vetor_info['etapa']=='cooler'){
            $vetor_info['string_listagem']=Configuracao::monta_listagem($dao_a->$metodo($busca));
        }elseif($vetor_info['etapa']=='fonte'){
            $vetor_info['string_listagem']=Configuracao::monta_listagem($dao_a->$metodo($vetor_config, $busca));
        }else{
            $vetor_info['string_listagem']=Configuracao::monta_listagem($dao_a->$metodo($processador, $busca));
        }
        $vetor_info['string_barra_etapas']=Configuracao::monta_barra_etapas($vetor_info['etapa']);
        return $vetor_info;

    }

    public static function monta_barra_etapas($etapa){
        $string_barra_etapas = "<div id='etapas'>";
        $indice=array_search($etapa, Configuracao::VETOR_ETAPAS);
        for($i=0;$i<count(Configuracao::VETOR_ETAPAS);$i++){
            if($i<$indice){
                $string_barra_etapas.="<form action='../controller/configuracao.php' method='post'>
                <input type='hidden' value='".Configuracao::VETOR_ETAPAS[$i]."' name='voltar'>
                <input class='etapa etapa_concluida' type='submit' value='".Configuracao::retorna_titulo(Configuracao::VETOR_ETAPAS[$i])."'>
                </form>";
            }elseif($i==$indice){
                $string_barra_etapas.="<form action='../controller/configuracao.php' method='post'>
                <input type='hidden' value='".Configuracao::VETOR_ETAPAS[$i]."' name='voltar'>
                <input class='etapa' id='current' type='submit' value='".Configuracao::retorna_titulo(Configuracao::VETOR_ETAPAS[$i])."' onclick='return false' disabled>
                </form>";
            }else{
                $string_barra_etapas.="<form action='../controller/configuracao.php' method='post'>
                <input type='hidden' value='".Configuracao::VETOR_ETAPAS[$i]."' name='voltar'>
                <input class='etapa' type='submit' value='".Configuracao::retorna_titulo(Configuracao::VETOR_ETAPAS[$i])."' onclick='return false' disabled>
                </form>";
            }
        }
        $string_barra_etapas.="</div>";
        return $string_barra_etapas;
    }
}
?>