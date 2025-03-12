<?php
require_once("../model/ProdutoDAO.php");
require_once("../model/AnuncioDAO.php");

class Filtro{

    public const CAMPOS = ['processador'=>['fabricante', 'linha', 'soquete', 'frequencia', 'nucleos', 'threads', 'litografia', 'video_integrado', 'cooler_incluso'], 'placa_mae'=>['fabricante', 'fab_comp', 'soquete', 'frequencia', 'barramentos_ram', 'max_ram', 'tipo_ram', 'barramentos_x1', 'barramentos_x2', 'barramentos_x4', 'barramentos_x8', 'barramentos_x16', 'barramentos_pci', 'barramentos_agp', 'barramentos_thunderbolt', 'barramentos_pata', 'barramentos_sata', 'barramentos_m2_sata', 'barramentos_m2_nvme', 'fator_forma'], 'ram'=>['fabricante', 'quantidade_pentes', 'frequencia', 'ram_pente_individual', 'ram_total', 'tipo_ram'], 'placa_video'=>['fabricante', 'frequencia', 'ram_placa_video', 'barramento_encaixe_video'], 'armazenamento'=>['fabricante', 'tipo_armazenamento', 'quantidade_armazenamento', 'barramento_encaixe_armazenamento'], 'gabinete'=>['fabricante', 'formato_gabinete'], 'fonte'=>['fabricante', 'potencia', 'fator_forma', 'selo_80_plus'], 'cooler'=>['fabricante', 'resfriamento']];
    public const TITULOS = ['fabricante'=>'Fabricante', 'fab_comp'=>'Processadores compatíveis', 'soquete'=>'Soquete', 'frequencia'=>'Frequência base (MHz)', 'barramentos_ram'=>'Slots de memória RAM', 'max_ram'=>'Limite de memória RAM (GB)', 'tipo_ram'=>'Geração da memória RAM', 'barramentos_x1'=>'Barramentos PCIe X1', 'barramentos_x2'=>'Barramentos PCIe X2', 'barramentos_x4'=>'Barramentos PCIe X4', 'barramentos_x8'=>'Barramentos PCIe X8', 'barramentos_x16'=>'Barramentos PCIe X16', 'barramentos_pci'=>'Barramentos PCI', 'barramentos_agp'=>'Barramentos AGP', 'barramentos_thunderbolt'=>'Barramentos Thunderbolt', 'barramentos_pata'=>'Barramentos PATA', 'barramentos_sata'=>'Barramentos SATA padrão', 'barramentos_m2_sata'=>'Barramentos M.2 SATA', 'barramentos_m2_nvme'=>'Barramentos M.2 NVMe', 'fator_forma'=>'Fator de forma', 'linha'=>'Linha', 'nucleos'=>'Núcleos', 'threads'=>'Threads', 'litografia'=>'Litografia (nm)', 'video_integrado'=>'GPU integrada', 'cooler_incluso'=>'Cooler incluso', 'quantidade_pentes'=>'Pentes por anúncio', 'ram_pente_individual'=>'Memória por pente (GB)', 'ram_total'=>'Total de memória dos pentes (GB)', 'ram_placa_video'=>'Memória RAM da placa (GB)', 'barramento_encaixe_video'=>'Barramento de encaixe', 'tipo_armazenamento'=>'Tipo de armazenamento', 'quantidade_armazenamento'=>'Capacidade de armazenamento (GB)', 'barramento_encaixe_armazenamento'=>'Barramento de encaixe', 'formato_gabinete'=>'Formato do gabinete', 'potencia'=>'Potência', 'selo_80_plus'=>'Selo 80 plus', 'resfriamento'=>'Resfriamento'];
    

    public static function montar_query($vetor_get, $categoria=""){
        $query = (($categoria=="")?("(anuncios.categoria_produto IS NOT NULL)"):("(anuncios.categoria_produto='".$categoria."')"));
        $campo_atual = "";
        foreach($vetor_get as $nome => $string){
            if($nome!='dropdown'&&$nome!='search'&&$nome!='categoria'&&$nome!='des'){
                $tabela = ($nome=="preco_min"||$nome=="preco_max")?("anuncios"):("produtos");//******* */
            
                $campo = substr($nome, 0, strrpos($nome, "_"));
    
                if($campo=="preco"){
                    if($nome=="preco_min"){
                        $string = ">=".$string;
                    }else{
                        $string = "<=".$string;
                    }
                }
                if($campo_atual == $campo){
                    if($campo=="preco"){
                        $query.=" AND ".$tabela.".".$campo.$string;
                    }elseif(str_contains($nome, "UPPER")){
                        $campo=str_replace("produtos_", "produtos.", $campo);
                        $string = str_replace("ª", " ", $string);
                        $query.= " OR ".$campo.$string;
                    }else{
                        $query.= " OR ".$tabela.".".$campo.$string;
                    }
                }else{
                    if($campo_atual!="")
                        $query.= ")";
                        $campo_atual = $campo;
                    if(str_contains($nome, "UPPER")){
                        $campo=str_replace("produtos_", "produtos.", $campo);
                        $string = str_replace("ª", " ", $string);
                        $query.= " AND (".$campo.$string;
                    }else{
                        $query.= " AND (".$tabela.".".$campo.$string;
                    }
                }
            }
        }
        if($query[strlen($query) - 1] !== ")")
            $query.=")";    
        return $query;
    }

    public static function montar_filtro($vetor_get=[], $categoria=""){
        $string_indices = "";
        foreach($vetor_get as $indice => $valor){
            $string_indices .= $indice.",";
        }

        $dao_a = new AnuncioDAO();
        $precos = $dao_a->obter_preco_min_max($categoria);

        $step = 1;
        $min = ((isset($vetor_get['preco_min']))?($vetor_get['preco_min']):(floor($precos['min'])));
        $max = ((isset($vetor_get['preco_max']))?($vetor_get['preco_max']):(ceil($precos['max'])));
        $checked_novo = ((isset($vetor_get['condicao_novo']))?("checked"):(""));
        $checked_usado = ((isset($vetor_get['condicao_usado']))?("checked"):(""));
        $checked_condicao = (($checked_usado=="checked"||$checked_novo=="checked")?("checked"):(""));
        $right = (1 - (($max-floor($precos['min']))/(ceil($precos['max'])-floor($precos['min']))))*100;
        $left = ($min-floor($precos['min']))/(ceil($precos['max'])-floor($precos['min']))*100;
        

        $input_categoria = (($categoria=="")?(""):("<input type='hidden' name='categoria' value='".$categoria."'>"));

        $string_categoria = (($categoria=="")?(""):("?categoria=".$categoria));

        $string_filtro= $input_categoria.'<div class="sidebar" id="sidebar" >

        <div class="sticky-side-btn">
            

            <a class="btn-sidebar" id="btn" > <!-- href="#subirfiltro"  onclick="pageScrollsubirfiltro()"-->
                    
                <i class="bi bi-sliders"></i>
            </a>
        </div>
            
        <div class="offcanvas-body-filtro" >
            <div class="body-filtro-content-1">
                <H3><b>Filtrar</b></H3>

                <a href = "index.php'.$string_categoria.'" class="btn-remover-alt">Limpar filtros</a>

                <ul class="dropdown">

                <div class="wrapper">
                    <header>
                        <h2>Por preço</h2>
                        <p>Deslize para definir o preço.</p>
                    </header>
                    <div class="price-input">
                        <div class="field">
                        <span>Min (R$)</span>
                        <input type="number" style="border: none; color: #000; background-color: #fff;" name="preco_min" class="input-min" value="'.$min.'" readOnly="true">
                        </div>
                        <div class="field">
                        <span>Max (R$)</span>
                        <input type="number" style="border: none; color: #000; background-color: #fff;" name="preco_max" class="input-max" value="'.$max.'" readOnly="true">
                        </div>
                    </div>
                    <div class="slider">
                        <div class="progress" style="left: '.$left.'%; right: '.$right.'%;"></div>
                    </div>
                    <div class="range-input">
                        <input type="range" class="range-min" min="'.floor($precos['min']).'" max="'.ceil($precos['max']).'" value="'.$min.'" step="'.$step.'">
                        <input type="range" class="range-max" min="'.floor($precos['min']).'" max="'.ceil($precos['max']).'" value="'.$max.'" step="'.$step.'">
                    </div>
                </div>

                <li>
                    <input type="checkbox" name="dropdown" id="condicao" '.$checked_condicao.'>
                    <label for="condicao" class="dropdown-label">Condição</label>
                    <div class="content content-1">
                        <div> 
                            <div>
                                <input class="form-check-input" type="checkbox" id="condicao-novo" value="=\'novo\'" name="condicao_novo" '.$checked_novo.'><label for="condicao-novo">Novo</label>
                            </div>
                            <div>
                                <input class="form-check-input" type="checkbox" id="condicao-usado" value="=\'usado\'" name="condicao_usado" '.$checked_usado.'><label for="condicao-usado">Usado</label>
                            </div>
                        </div>
                    </div>
                </li>';

                if($categoria!=""){
                    $string_campos='';
                    foreach(self::CAMPOS[$categoria] as $campo){ 
                        $checked='';
                        if(str_contains($string_indices, $campo))
                            $checked='checked';
                        $string_campos .= '<li>
                            <input type="checkbox" name="dropdown" id="'.$campo.'" '.$checked.'>
                            <label for="'.$campo.'" class="dropdown-label">'.self::TITULOS[$campo].'</label>
                            <div class="content content-1">
                                <div>';
                        $string_campos .= self::montar_valores_campos($categoria, $campo, $vetor_get);
                        $string_campos.='</div></div></li>';
                    }
                    $string_filtro.=$string_campos;
                }
                    

                $string_filtro.='</ul>
            </div>
            <div class="btn-aplicar"> <button>Aplicar</button> </div>
        </div>
    </div> 

        <script> 
            let btn = document.querySelector("#btn");
            let sidebar = document.querySelector(".sidebar");

            btn.onclick = function (){
                sidebar.classList.toggle("active");
            };

            </script>

            <script> 

            function pageScrollsubirfiltro() {
                document
                .getElementById("subir-filtro")
                .scrollIntoView({ behavior: "smooth", block: "center" })
            }

            let progress = document.getElementById("progressbar")
            let totalHeight = document.body.scrollHeight - window.innerHeight

            window.onscroll = function () {
                let progressHeight = (window.pageYOffset / totalHeight) * 100
                progress.style.height = progressHeight + "%"
            }
        </script>';

        return $string_filtro;
    }

    public static function montar_valores_campos($categoria, $campo, $vetor_get){
        
        $dao_p = new ProdutoDAO();
        $vetor_valores=$dao_p->obter_valores($categoria, $campo);
        $vetor_strings=[];

        foreach($vetor_valores as $valor){
            if($valor!=""&&$valor!=null){

                if(is_numeric($valor)){
                    $name = $campo."_".$valor;
                    $value = "=".$valor;
                }else{
                    $valor_post = str_replace(" ", "ª", $valor);
                    $name = "UPPER(produtos_".$campo.")_".$valor_post;
                    $value = "='".$valor_post."'";
                }
    
                $id = $campo."_".$valor;
                $checked = "";
    
                if(isset($vetor_get[$name])){
                    $checked="checked";
                }
    
                if($campo=="cooler_incluso"||$campo=="video_integrado")
                    $valor = (($valor==0)?("Não"):("Sim"));
                
                $vetor_strings[$valor]='<div>
                    <input class="form-check-input" type="checkbox" name="'.$name.'" id="'.$id.'" value="'.$value.'" '.$checked.'><label for="'.$id.'">'.$valor.'</label>
                </div>';
            }
        }
        ksort($vetor_strings);
        $string_valores = implode(" ", $vetor_strings);
        return $string_valores;
    }



}
?>

<?php
//* TESTE * * TESTE * * TESTE * * TESTE * * TESTE * * TESTE * * TESTE * * TESTE * * TESTE * * TESTE * * TESTE * * TESTE * * TESTE * * TESTE * * TESTE * * TESTE * 
/*$vetor_get_teste = ['UPPER(soquete)_AM4'=>"='AM4'", 'UPPER(soquete)_LGA1200'=>"='LGA1200'", 'UPPER(fabricante)_AMD'=>"='AMD'", 'UPPER(fabricante)_INTEL'=>"='INTEL'", 'UPPER(fabricante)_AMD'=>"='AMD'"];
$categoria_teste = "processador";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TESTE FILTRO</title>
    <link rel="stylesheet" href="../css/index.css">
    <script src="../js/index.js"></script>
</head>
<body>
    <div style="height: 100vh; width: 6rem; margin-right: auto;">
    <?php
    echo Filtro::montar_query($vetor_get_teste)."<br><br><br>";
    echo Filtro::montar_filtro($vetor_get_teste, $categoria_teste);
    ?>
    </div>
</body>
</html>*/
