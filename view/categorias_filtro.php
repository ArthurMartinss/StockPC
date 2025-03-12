<!-- Universal -->
    <div class="sidebar" id="sidebar" >

        <div class="sticky-side-btn">
            

            <a class="btn-sidebar" id="btn" onclick="pageScrollsubirfiltro()" href="#subir-filtro"> 
                    
                <img src="../img/icons/filtro.png" alt=""> 
            </a>
        </div>
            
        <div class="offcanvas-body-filtro" >
            <H3><b>Filtrar</b></H3>
            <ul class="dropdown">
            ...
            </ul>

            <div class="btn-aplicar"> <button>Aplicar</button> </div>
        </div>

    </div> 


    <script> 

        let btn = document.querySelector('#btn');
        let sidebar = document.querySelector('.sidebar');

        btn.onclick = function (){
            sidebar.classList.toggle('active');
        };

        </script>

        <script> 

        function pageScrollsubirfiltro() {
            document
            .getElementById('subir-filtro')
            .scrollIntoView({ behavior: 'smooth', block: 'center' })
        }

        let progress = document.getElementById('progressbar')
        let totalHeight = document.body.scrollHeight - window.innerHeight

        window.onscroll = function () {
            let progressHeight = (window.pageYOffset / totalHeight) * 100
            progress.style.height = progressHeight + '%'
        }


    </script>
<!-- Fim Universal -->

<!-- Geral -->
    <!-- Preco -->
        <li>
            <input type="checkbox" name="dropdown" id="preco">
            <label for="preco" class="dropdown-label">Preço</label>
            <div class="content content-1">
                <div> 
                    <div>
                        <label for="preco_min">Preço Mínimo: </label>
                        <input class="form-check-input" type="number" name="preco_min" id="preco_min" value="" aria-label="...">
                    </div>
                    <div>
                        <label for="preco_max">Preço Máximo: </label>
                        <input class="form-check-input" type="number" name="preco_max" id="preco_max" value="" aria-label="...">
                    </div>
                </div>
            </div>
        </li>
    <!-- Fim Preco -->
    <!-- Condição -->
        <li>
            <input type="checkbox" name="dropdown" id="condicao">
            <label for="condicao" class="dropdown-label">Condição</label>
            <div class="content content-1">
                <div> 
                    <div>
                        <input class="form-check-input" type="checkbox" id="condicao-novo" value="" name="condicao_1" aria-label="..."><label for="condicao-novo">Novo</label>
                    </div>
                    <div>
                        <input class="form-check-input" type="checkbox" id="condicao-usado" value="" name="condicao_1" aria-label="..."><label for="condicao-usado">Usado</label>
                    </div>
                </div>
            </div>
        </li>
    <!-- Fim Condição -->
<!-- Fim Geral -->

<!-- Processador -->
    <!-- Fabricante -->
    <li>
        <input type="checkbox" name="dropdown" id="fabricantes">
        <label for="fabricantes" class="dropdown-label">Fabricante</label>
        <div class="content content-1">
            <div> 
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_1" id="amd" value="='AMD'" aria-label="AMD">
                    <label for="amd">AMD</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_2" id="intel" value="='INTEL'" aria-label="intel">
                    <label for="intel">Intel</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Fabricante -->
    <!-- Linha -->
    <li>
        <input type="checkbox" name="dropdown" id="linha-proc">
        <label for="linha-proc" class="dropdown-label">Linha do Processador</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="linha_1" id="athlon" value="='athlon'" aria-label="..."><label for="athlon">Athlon</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="linha_2" id="atom" value="='atom'" aria-label="..."><label for="atom">Atom</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="linha_3" id="='celeron'" value="celeron" aria-label="..."><label for="celeron">Celeron</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="linha_4" id="='pentium'" value="pentium" aria-label="..."><label for="pentium">Pentium</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="linha_5" id="i3" value="='i3'" aria-label="..."><label for="i3">Core i3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="linha_6" id="i5" value="='i5'" aria-label="..."><label for="i5">Core i5</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="linha_7" id="i7" value="='i7'" aria-label="..."><label for="i7">Core i7</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="linha_8" id="i9" value="='i9'" aria-label="..."><label for="i9">Core i9</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="linha_9" id="ryzen3" value="='ryzen 3'" aria-label="..."><label for="ryzen3">Ryzen 3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="linha_10" id="ryzen5" value="='ryzen 5'" aria-label="..."><label for="ryzen5">Ryzen 5</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="linha_11" id="ryzen7" value="='ryzen 7'" aria-label="..."><label for="ryzen7">Ryzen 7</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="linha_12" id="ryzen9" value="='ryzen 9'" aria-label="..."><label for="ryzen9">Ryzen 9</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Linha -->
    <!-- Soquete -->
    <li>
        <input type="checkbox" name="dropdown" id="soquete-proc">
        <label for="soquete-proc" class="dropdown-label">Soquete</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="soquete_1" id="AM4" value="='AM4'" aria-label="..."><label for="AM4">AM4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="soquete_2" id="LGA1200" value="='LGA1200'" aria-label="..."><label for="LGA1200">LGA1200</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="soquete_3" id="LGA1151" value="='LGA1151'" aria-label="..."><label for="LGA1151">LGA1151</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="soquete_4" id="AM5" value="='AM5'" aria-label="..."><label for="AM5">AM5</label>
                </div>
                <!-- Adicione outros soquetes aqui conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Soquete -->
    <!-- Frequência -->
    <li>
        <input type="checkbox" name="dropdown" id="freq-proc">
        <label for="freq-proc" class="dropdown-label">Frequência Base (MHz)</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_1" id="2000mhz" value="=2000" aria-label="..."><label for="2000mhz">2000</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_2" id="2500mhz" value="=2500" aria-label="..."><label for="2500mhz">2500</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_3" id="3000mhz" value="=3000" aria-label="..."><label for="3000mhz">3000</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_4" id="3500mhz" value="=3500" aria-label="..."><label for="3500mhz">3500</label>
                </div>
                <!-- Adicione outras frequências aqui conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Frequência -->
    <!-- Núcleos -->
    <li>
        <input type="checkbox" name="dropdown" id="nucleos-proc">
        <label for="nucleos-proc" class="dropdown-label">Núcleos</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="nucleos_1" id="2-cores" value="=2" aria-label="..."><label for="2-cores">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="nucleos_2" id="4-cores" value="=4" aria-label="..."><label for="4-cores">4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="nucleos_3" id="6-cores" value="=6" aria-label="..."><label for="6-cores">6</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="nucleos_4" id="8-cores" value="=8" aria-label="..."><label for="8-cores">8</label>
                </div>
                <!-- Adicione outros números de núcleos conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Núcleos -->
    <!-- Threads -->
    <li>
        <input type="checkbox" name="dropdown" id="threads-proc">
        <label for="threads-proc" class="dropdown-label">Threads</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="threads_1" id="4-threads" value="=4" aria-label="..."><label for="4-threads">4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="threads_2" id="8-threads" value="=8" aria-label="..."><label for="8-threads">8</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="threads_3" id="12-threads" value="=12" aria-label="..."><label for="12-threads">12</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="threads_4" id="16-threads" value="=16" aria-label="..."><label for="16-threads">16</label>
                </div>
                <!-- Adicione outros números de threads conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Threads -->
    <!-- Litografia -->
    <div>
        <label for="litografia" class="dropdown-label">Litografia (nm)</label>
        <div class="content content-2">
            <div>
                <input class="form-check-input" type="checkbox" name="litografia_1" id="litografia-5" value="=5" aria-label="..."><label for="litografia-5">5 nm</label>
            </div>
            <div>
                <input class="form-check-input" type="checkbox" name="litografia_2" id="litografia-7" value="=7" aria-label="..."><label for="litografia-7">7 nm</label>
            </div>
            <div>
                <input class="form-check-input" type="checkbox" name="litografia_3" id="litografia-10" value="=10" aria-label="..."><label for="litografia-10">10 nm</label>
            </div>
            <div>
                <input class="form-check-input" type="checkbox" name="litografia_4" id="litografia-14" value="=14" aria-label="..."><label for="litografia-14">14 nm</label>
            </div>
            <div>
                <input class="form-check-input" type="checkbox" name="litografia_5" id="litografia-22" value="=22" aria-label="..."><label for="litografia-22">22 nm</label>
            </div>
            <div>
                <input class="form-check-input" type="checkbox" name="litografia_6" id="litografia-32" value="=32" aria-label="..."><label for="litografia-32">32 nm</label>
            </div>
            <div>
                <input class="form-check-input" type="checkbox" name="litografia_7" id="litografia-45" value="=45" aria-label="..."><label for="litografia-45">45 nm</label>
            </div>
            <div>
                <input class="form-check-input" type="checkbox" name="litografia_8" id="litografia-65" value="=65" aria-label="..."><label for="litografia-65">65 nm</label>
            </div>
            <div>
                <input class="form-check-input" type="checkbox" name="litografia_9" id="litografia-90" value="=90" aria-label="..."><label for="litografia-90">90 nm</label>
            </div>
            <div>
                <input class="form-check-input" type="checkbox" name="litografia_10" id="litografia-130" value="=130" aria-label="..."><label for="litografia-130">130 nm</label>
            </div>
            <div>
                <input class="form-check-input" type="checkbox" name="litografia_11" id="litografia-180" value="=180" aria-label="..."><label for="litografia-180">180 nm</label>
            </div>
            <div>
                <input class="form-check-input" type="checkbox" name="litografia_12" id="litografia-250" value="=250" aria-label="..."><label for="litografia-250">250 nm</label>
            </div>
        </div>
    </div>
    <!-- Fim Litografia -->
    <!-- GPU Integrada -->
    <li>
        <input type="checkbox" name="dropdown" id="gpu-integrada">
        <label for="gpu-integrada" class="dropdown-label">GPU Integrada</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="video_integrado_1" id="sim-gpu" value="=1" aria-label="..."><label for="sim-gpu">Sim</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="video_integrado_2" id="nao-gpu" value="=0" aria-label="..."><label for="nao-gpu">Não</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim GPU Integrada -->
    <!-- Cooler Incluso -->
    <li>
        <input type="checkbox" name="dropdown" id="cooler-incluso">
        <label for="cooler-incluso" class="dropdown-label">Cooler Incluso</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="cooler_incluso_1" id="sim-cooler" value="=1" aria-label="..."><label for="sim-cooler">Sim</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="cooler_incluso_2" id="nao-cooler" value="='nao-cooler'" aria-label="..."><label for="nao-cooler">Não</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Cooler Incluso -->
<!-- Fim Processador -->

<!-- Placa-mãe -->
    <!-- Fabricante -->
    <li>
        <input type="checkbox" name="dropdown" id="fabricantes">
        <label for="fabricantes" class="dropdown-label">Fabricante</label>
        <div class="content content-1">
            <div> 
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_1" id="asus" value="='ASUS'" aria-label="...">
                    <label for="asus">ASUS</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_2" id="asrock" value="='ASROCK'" aria-label="...">
                    <label for="asrock">ASROCK</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_3" id="msi" value="='MSI'" aria-label="...">
                    <label for="msi">MSI</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_4" id="gigabyte" value="='GIGABYTE'" aria-label="...">
                    <label for="gigabyte">GIGABYTE</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Fabricante -->
    <!-- Fabricante processador-->
    <li>
        <input type="checkbox" name="dropdown" id="fabricante-proc">
        <label for="fabricante-proc" class="dropdown-label">Fabricante do Processador</label>
        <div class="content content-1">
            <div> 
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fab_comp)_1" id="amd" value="='AMD'" aria-label="AMD">
                    <label for="amd">AMD</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fab_comp)_2" id="intel" value="='INTEL'" aria-label="intel">
                    <label for="intel">Intel</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Fabricante processador -->
    <!-- Soquete -->
    <li>
        <input type="checkbox" name="dropdown" id="soquete-proc">
        <label for="soquete-proc" class="dropdown-label">Soquete</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="soquete_1" id="AM4" value="='AM4'" aria-label="..."><label for="AM4">AM4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="soquete_2" id="LGA1200" value="='LGA1200'" aria-label="..."><label for="LGA1200">LGA1200</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="soquete_3" id="LGA1151" value="='LGA1151'" aria-label="..."><label for="LGA1151">LGA1151</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="soquete_4" id="AM5" value="='AM5'" aria-label="..."><label for="AM5">AM5</label>
                </div>
                <!-- Adicione outros soquetes aqui conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Soquete -->
    <!-- Frequência -->
    <li>
        <input type="checkbox" name="dropdown" id="freq-proc">
        <label for="freq-proc" class="dropdown-label">Frequência Base (MHz)</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_1" id="2000mhz" value="=2000" aria-label="..."><label for="2000mhz">2000</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_2" id="2500mhz" value="=2500" aria-label="..."><label for="2500mhz">2500</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_3" id="3000mhz" value="=3000" aria-label="..."><label for="3000mhz">3000</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_4" id="3500mhz" value="=3500" aria-label="..."><label for="3500mhz">3500</label>
                </div>
                <!-- Adicione outras frequências aqui conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Frequência -->
    <!-- Quantidade de Barramentos RAM -->
    <li>
        <input type="checkbox" name="dropdown" id="quantidade-ram">
        <label for="quantidade-ram" class="dropdown-label">Barramentos RAM</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_ram_1" id="2-barramentos-ram" value="=2" aria-label="..."><label for="2-barramentos-ram">2 Barramentos</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_ram_2" id="4-barramentos-ram" value="=4" aria-label="..."><label for="4-barramentos-ram">4 Barramentos</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_ram_3" id="8-barramentos-ram" value="=8" aria-label="..."><label for="8-barramentos-ram">8 Barramentos</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos RAM -->

    <!-- Capacidade Máxima de RAM -->
    <li>
        <input type="checkbox" name="dropdown" id="capacidade-ram">
        <label for="capacidade-ram" class="dropdown-label">Capacidade Máxima de RAM</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="max_ram_1" id="16GB-ram" value="=16" aria-label="..."><label for="16GB-ram">16GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="max_ram_2" id="32GB-ram" value="=32" aria-label="..."><label for="32GB-ram">32GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="max_ram_3" id="64GB-ram" value="=64" aria-label="..."><label for="64GB-ram">64GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="max_ram_4" id="128GB-ram" value="=128" aria-label="..."><label for="128GB-ram">128GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="max_ram_5" id="256GB-ram" value="=256" aria-label="..."><label for="256GB-ram">256GB</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Capacidade Máxima de RAM -->
    <!-- Geração de Memória RAM -->
    <li>
        <input type="checkbox" name="dropdown" id="geracao-ram">
        <label for="geracao-ram" class="dropdown-label">Geração de Memória RAM</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="tipo_ram_1" id="DDR" value="='DDR'" aria-label="..."><label for="DDR">DDR</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="tipo_ram_2" id="DDR2" value="='DDR2'" aria-label="..."><label for="DDR2">DDR2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="tipo_ram_3" id="DDR3" value="='DDR3'" aria-label="..."><label for="DDR3">DDR3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="tipo_ram_4" id="DDR4" value="='DDR4'" aria-label="..."><label for="DDR4">DDR4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="tipo_ram_5" id="DDR5" value="='DDR5'" aria-label="..."><label for="DDR5">DDR5</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Geração de Memória RAM -->
    <!-- Quantidade de Barramentos PCIe X1 -->
    <li>
        <input type="checkbox" name="dropdown" id="barramentos-pcie-x1">
        <label for="barramentos-pcie-x1" class="dropdown-label">Quantidade de Barramentos PCIe X1</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x1_1" id="1-barramento-pcie-x1" value="=1" aria-label="..."><label for="1-barramento-pcie-x1">1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x1_2" id="2-barramentos-pcie-x1" value="=2" aria-label="..."><label for="2-barramentos-pcie-x1">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x1_3" id="3-barramentos-pcie-x1" value="=3" aria-label="..."><label for="3-barramentos-pcie-x1">3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x1_4" id="24-barramentos-pcie-x1" value="='4-barramentos-pcie-x1'" aria-label="..."><label for="4-barramentos-pcie-x1">4</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos PCIe X1 -->

    <!-- Quantidade de Barramentos PCIe X2 -->
    <li>
        <input type="checkbox" name="dropdown" id="barramentos-pcie-x2">
        <label for="barramentos-pcie-x2" class="dropdown-label">Quantidade de Barramentos PCIe X2</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x2_1" id="1-barramento-pcie-x2" value="=1" aria-label="..."><label for="1-barramento-pcie-x2">1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x2_2" id="2-barramentos-pcie-x2" value="=2" aria-label="..."><label for="2-barramentos-pcie-x2">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x2_3" id="3-barramentos-pcie-x2" value="=3" aria-label="..."><label for="3-barramentos-pcie-x2">3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x2_4" id="24-barramentos-pcie-x2" value="='4-barramentos-pcie-x2'" aria-label="..."><label for="4-barramentos-pcie-x2">4</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos PCIe X2 -->

    <!-- Quantidade de Barramentos PCIe X4 -->
    <li>
        <input type="checkbox" name="dropdown" id="barramentos-pcie-x4">
        <label for="barramentos-pcie-x4" class="dropdown-label">Quantidade de Barramentos PCIe x4</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x4_1" id="1-barramento-pcie-x4" value="=1" aria-label="..."><label for="1-barramento-pcie-x4">1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x4_2" id="2-barramentos-pcie-x4" value="=2" aria-label="..."><label for="2-barramentos-pcie-x4">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x4_3" id="3-barramentos-pcie-x4" value="=3" aria-label="..."><label for="3-barramentos-pcie-x4">3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x4_4" id="24-barramentos-pcie-x4" value="='4-barramentos-pcie-x4'" aria-label="..."><label for="4-barramentos-pcie-x4">4</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos PCIe X4 -->

    <!-- Quantidade de Barramentos PCIe X8 -->
    <li>
        <input type="checkbox" name="dropdown" id="barramentos-pcie-x8">
        <label for="barramentos-pcie-x8" class="dropdown-label">Quantidade de Barramentos PCIe x8</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x8_1" id="1-barramento-pcie-x8" value="=1" aria-label="..."><label for="1-barramento-pcie-x8">1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x8_2" id="2-barramentos-pcie-x8" value="=2" aria-label="..."><label for="2-barramentos-pcie-x8">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x8_3" id="3-barramentos-pcie-x8" value="=3" aria-label="..."><label for="3-barramentos-pcie-x8">3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x8_4" id="24-barramentos-pcie-x8" value="='4-barramentos-pcie-x8'" aria-label="..."><label for="4-barramentos-pcie-x8">4</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos PCIe X8 -->

    <!-- Quantidade de Barramentos PCIe X16 -->
    <li>
        <input type="checkbox" name="dropdown" id="barramentos-pcie-x16">
        <label for="barramentos-pcie-x16" class="dropdown-label">Quantidade de Barramentos PCIe x16</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x16_1" id="1-barramento-pcie-x16" value="=1" aria-label="..."><label for="1-barramento-pcie-x16">1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x16_2" id="2-barramentos-pcie-x16" value="=2" aria-label="..."><label for="2-barramentos-pcie-x16">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x16_3" id="3-barramentos-pcie-x16" value="=3" aria-label="..."><label for="3-barramentos-pcie-x16">3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_x16_4" id="24-barramentos-pcie-x16" value="='4-barramentos-pcie-x16'" aria-label="..."><label for="4-barramentos-pcie-x16">4</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos PCIe X16 -->
    <!-- Quantidade de Barramentos PCI -->
    <li>
        <input type="checkbox" name="dropdown" id="barramentos-pci">
        <label for="barramentos-pci" class="dropdown-label">Quantidade de Barramentos PCI</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_pci_1" id="1-barramento-pci" value="=1" aria-label="..."><label for="1-barramento-pci">1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_pci_2" id="2-barramento-pci" value="=2" aria-label="..."><label for="2-barramento-pci">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_pci_3" id="3-barramento-pci" value="=3" aria-label="..."><label for="3-barramento-pci">3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_pci_4" id="4-barramento-pci" value="=4" aria-label="..."><label for="4-barramento-pci">4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_pci_5" id="5-barramento-pci" value="=5" aria-label="..."><label for="5-barramento-pci">5</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos PCI -->
    <!-- Quantidade de Barramentos AGP -->
    <li>
        <input type="checkbox" name="dropdown" id="barramentos-agp">
        <label for="barramentos-agp" class="dropdown-label">Quantidade de Barramentos agp</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_agp_1" id="1-barramento-agp" value="=1" aria-label="..."><label for="1-barramento-agp">1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_agp_2" id="2-barramento-agp" value="=2" aria-label="..."><label for="2-barramento-agp">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_agp_3" id="3-barramento-agp" value="=3" aria-label="..."><label for="3-barramento-agp">3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_agp_4" id="4-barramento-agp" value="=4" aria-label="..."><label for="4-barramento-agp">4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_agp_5" id="5-barramento-agp" value="=5" aria-label="..."><label for="5-barramento-agp">5</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos AGP -->
    <!-- Quantidade de Barramentos Thunderbolt -->
    <li>
        <input type="checkbox" name="dropdown" id="barramentos-thunderbolt">
        <label for="barramentos-thunderbolt" class="dropdown-label">Quantidade de Barramentos Thunderbolt</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_thunderbolt_1" id="1-barramento-thunderbolt" value="=1" aria-label="..."><label for="1-barramento-thunderbolt">1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_thunderbolt_2" id="2-barramento-thunderbolt" value="=2" aria-label="..."><label for="2-barramento-thunderbolt">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_thunderbolt_3" id="3-barramento-thunderbolt" value="=3" aria-label="..."><label for="3-barramento-thunderbolt">3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_thunderbolt_4" id="4-barramento-thunderbolt" value="=4" aria-label="..."><label for="4-barramento-thunderbolt">4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_thunderbolt_5" id="5-barramento-thunderbolt" value="=5" aria-label="..."><label for="5-barramento-thunderbolt">5</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos Thunderbolt -->
    <!-- Quantidade de Barramentos PATA -->
    <li>
        <input type="checkbox" name="dropdown" id="barramentos-pata">
        <label for="barramentos-pata" class="dropdown-label">Quantidade de Barramentos PATA</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_pata_1" id="1-barramento-pata" value="=1" aria-label="..."><label for="1-barramento-pata">1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_pata_2" id="2-barramento-pata" value="=2" aria-label="..."><label for="2-barramento-pata">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_pata_3" id="3-barramento-pata" value="=3" aria-label="..."><label for="3-barramento-pata">3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_pata_4" id="4-barramento-pata" value="=4" aria-label="..."><label for="4-barramento-pata">4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_pata_5" id="5-barramento-pata" value="=5" aria-label="..."><label for="5-barramento-pata">5</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos PATA -->
    <!-- Quantidade de Barramentos SATA padrão-->
    <li>
        <input type="checkbox" name="dropdown" id="barramentos-sata">
        <label for="barramentos-sata" class="dropdown-label">Quantidade de Barramentos SATA padrão</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_sata_1" id="1-barramento-sata" value="=1" aria-label="..."><label for="1-barramento-sata">1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_sata_2" id="2-barramento-sata" value="=2" aria-label="..."><label for="2-barramento-sata">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_sata_3" id="3-barramento-sata" value="=3" aria-label="..."><label for="3-barramento-sata">3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_sata_4" id="4-barramento-sata" value="=4" aria-label="..."><label for="4-barramento-sata">4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_sata_5" id="5-barramento-sata" value="=5" aria-label="..."><label for="5-barramento-sata">5</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos SATA padrão-->
    <!-- Quantidade de Barramentos M.2 SATA padrão-->
    <li>
        <input type="checkbox" name="dropdown" id="barramentos-m.2-sata">
        <label for="barramentos-m.2-sata" class="dropdown-label">Quantidade de Barramentos M.2 SATA padrão</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_m.2_sata_1" id="1-barramento-m.2-sata" value="=1" aria-label="..."><label for="1-barramento-m.2-sata">1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_m.2_sata_2" id="2-barramento-m.2-sata" value="=2" aria-label="..."><label for="2-barramento-m.2-sata">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_m.2_sata_3" id="3-barramento-m.2-sata" value="=3" aria-label="..."><label for="3-barramento-m.2-sata">3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_m.2_sata_4" id="4-barramento-m.2-sata" value="=4" aria-label="..."><label for="4-barramento-m.2-sata">4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_m.2_sata_5" id="5-barramento-m.2-sata" value="=5" aria-label="..."><label for="5-barramento-m.2-sata">5</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos M.2 SATA padrão-->
    <!-- Quantidade de Barramentos M.2 NVME padrão-->
    <li>
        <input type="checkbox" name="dropdown" id="barramentos-m.2-nvme">
        <label for="barramentos-m.2-nvme" class="dropdown-label">Quantidade de Barramentos M.2 NVME padrão</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_m.2_nvme_1" id="1-barramento-m.2-nvme" value="=1" aria-label="..."><label for="1-barramento-m.2-nvme">1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_m.2_nvme_2" id="2-barramento-m.2-nvme" value="=2" aria-label="..."><label for="2-barramento-m.2-nvme">2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_m.2_nvme_3" id="3-barramento-m.2-nvme" value="=3" aria-label="..."><label for="3-barramento-m.2-nvme">3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_m.2_nvme_4" id="4-barramento-m.2-nvme" value="=4" aria-label="..."><label for="4-barramento-m.2-nvme">4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramentos_m.2_nvme_5" id="5-barramento-m.2-nvme" value="=5" aria-label="..."><label for="5-barramento-m.2-nvme">5</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de Barramentos M.2 NVME padrão-->
<!-- Fim Placa-mãe -->
<!-- Memória RAM -->
    <!-- Fabricante -->
    <li>
        <input type="checkbox" name="dropdown" id="fabricantes">
        <label for="fabricantes" class="dropdown-label">Fabricante</label>
        <div class="content content-1">
            <div> 
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_1" id="kingston" value="='KINGSTON'" aria-label="...">
                    <label for="asus">KINGSTON</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_2" id="corsair" value="='CORSAIR'" aria-label="...">
                    <label for="asrock">CORSAIR</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_3" id="husky" value="='HUSKY'" aria-label="...">
                    <label for="msi">HUSKY</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_4" id="xpg" value="='XPG'" aria-label="...">
                    <label for="gigabyte">XPG</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Fabricante -->
    <!-- Frequência -->
    <li>
        <input type="checkbox" name="dropdown" id="freq-proc">
        <label for="freq-proc" class="dropdown-label">Frequência Base (MHz)</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_1" id="2000mhz" value="=2000" aria-label="..."><label for="2000mhz">2000</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_2" id="2500mhz" value="=2500" aria-label="..."><label for="2500mhz">2500</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_3" id="3000mhz" value="=3000" aria-label="..."><label for="3000mhz">3000</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_4" id="3500mhz" value="=3500" aria-label="..."><label for="3500mhz">3500</label>
                </div>
                <!-- Adicione outras frequências aqui conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Frequência -->
    <!-- Quantidade de pentes -->
    <li>
        <input type="checkbox" name="dropdown" id="quantidade-ram">
        <label for="quantidade-ram" class="dropdown-label">Pentes por anúncio</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quantidade_pentes_1" id="1-quantidade-pentes" value="=1" aria-label="..."><label for="1-quantidade-pentes">1 Barramentos</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quantidade_pentes_2" id="2-quantidade-pentes" value="=2" aria-label="..."><label for="2-quantidade-pentes">2 Barramentos</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quantidade_pentes_3" id="3-quantidade-pentes" value="=3" aria-label="..."><label for="3-quantidade-pentes">3 Barramentos</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quantidade_pentes_4" id="4-quantidade-pentes" value="=4" aria-label="..."><label for="4-quantidade-pentes">4 Barramentos</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade de pentes -->
    <!-- Memória pente individual -->
    <li>
        <input type="checkbox" name="dropdown" id="capacidade-ram">
        <label for="capacidade-ram" class="dropdown-label">Memória do pente</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="ram_pente_individual_1" id="1GB-ram" value="=1" aria-label="..."><label for="1GB-ram">1GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="ram_pente_individual_2" id="2GB-ram" value="=2" aria-label="..."><label for="2GB-ram">2GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="ram_pente_individual_3" id="4GB-ram" value="=4" aria-label="..."><label for="4GB-ram">4GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="ram_pente_individual_4" id="8GB-ram" value="=8" aria-label="..."><label for="8GB-ram">8GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="ram_pente_individual_5" id="16GB-ram" value="=16" aria-label="..."><label for="16GB-ram">16GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="ram_pente_individual_6" id="32GB-ram" value="=32" aria-label="..."><label for="32GB-ram">32GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="ram_pente_individual_7" id="64GB-ram" value="=64" aria-label="..."><label for="64GB-ram">64GB</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Memória pente individual -->
    <!-- Geração de Memória RAM -->
    <li>
        <input type="checkbox" name="dropdown" id="geracao-ram">
        <label for="geracao-ram" class="dropdown-label">Geração de Memória RAM</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="tipo_ram_1" id="DDR" value="='DDR'" aria-label="..."><label for="DDR">DDR</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="tipo_ram_2" id="DDR2" value="='DDR2'" aria-label="..."><label for="DDR2">DDR2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="tipo_ram_3" id="DDR3" value="='DDR3'" aria-label="..."><label for="DDR3">DDR3</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="tipo_ram_4" id="DDR4" value="='DDR4'" aria-label="..."><label for="DDR4">DDR4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="tipo_ram_5" id="DDR5" value="='DDR5'" aria-label="..."><label for="DDR5">DDR5</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Geração de Memória RAM -->
<!-- Fim Memória RAM -->
<!-- Placa de vídeo -->
    <!-- Fabricante -->
    <li>
        <input type="checkbox" name="dropdown" id="fabricantes">
        <label for="fabricantes" class="dropdown-label">Fabricante da Placa</label>
        <div class="content content-1">
            <div> 
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_1" id="asus" value="='ASUS'" aria-label="...">
                    <label for="asus">ASUS</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_2" id="asrock" value="='ASROCK'" aria-label="...">
                    <label for="asrock">ASROCK</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_3" id="msi" value="='MSI'" aria-label="...">
                    <label for="msi">MSI</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_4" id="gigabyte" value="='GIGABYTE'" aria-label="...">
                    <label for="gigabyte">GIGABYTE</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Fabricante -->
    <!-- Fabricante da GPU -->
    <li>
        <input type="checkbox" name="dropdown" id="fabricantes">
        <label for="fabricantes" class="dropdown-label">Fabricante da GPU</label>
        <div class="content content-1">
            <div> 
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante_gpu)_1" id="gpu_amd" value="='AMD'" aria-label="...">
                    <label for="gpu_amd">AMD</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante_gpu)_2" id="gpu_nvidia" value="='NVIDIA'" aria-label="...">
                    <label for="gpu_nvidia">NVIDIA</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Fabricante da GPU -->
    <!-- Modelo -->
    <li>
        <input type="checkbox" name="dropdown" id="fabricantes">
        <label for="fabricantes" class="dropdown-label">Linha</label>
        <div class="content content-1">
            <div> 
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_1" id="2060" value=" LIKE '%RTX 2060%'" aria-label="...">
                    <label for="asus">RTX 2060</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_2" id="2070" value=" LIKE '%RTX 2070%'" aria-label="...">
                    <label for="asus">RTX 2070</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_3" id="2080" value=" LIKE '%RTX 2080%'" aria-label="...">
                    <label for="asus">RTX 2080</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_4" id="2090" value=" LIKE '%RTX 2090%'" aria-label="...">
                    <label for="asus">RTX 2090</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_5" id="3060" value=" LIKE '%RTX 3060%'" aria-label="...">
                    <label for="asus">RTX 3060</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_6" id="3070" value=" LIKE '%RTX 3070%'" aria-label="...">
                    <label for="asus">RTX 3070</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_7" id="3080" value=" LIKE '%RTX 3080%'" aria-label="...">
                    <label for="asus">RTX 3080</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_8" id="3090" value=" LIKE '%RTX 3090%'" aria-label="...">
                    <label for="asus">RTX 3090</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_9" id="4060" value=" LIKE '%RTX 4060%'" aria-label="...">
                    <label for="asus">RTX 4060</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_10" id="4070" value=" LIKE '%RTX 4070%'" aria-label="...">
                    <label for="asus">RTX 4070</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_11" id="4080" value=" LIKE '%RTX 4080%'" aria-label="...">
                    <label for="asus">RTX 4080</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_12" id="4090" value=" LIKE '%RTX 4090%'" aria-label="...">
                    <label for="asus">RTX 4090</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_13" id="5600" value=" LIKE '%RADEON 5600%'" aria-label="...">
                    <label for="asus">RADEON 5600</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_14" id="5700" value=" LIKE '%RADEON 5700%'" aria-label="...">
                    <label for="asus">RADEON 5700</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_15" id="6700" value=" LIKE '%RADEON 6700%'" aria-label="...">
                    <label for="asus">RADEON 6700</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(modelo)_16" id="6800" value=" LIKE '%RADEON 6800%'" aria-label="...">
                    <label for="asus">RADEON 6800</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Modelo -->
    <!-- Frequência -->
    <li>
        <input type="checkbox" name="dropdown" id="freq-proc">
        <label for="freq-proc" class="dropdown-label">Frequência Base (MHz)</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_1" id="2000mhz" value="=2000" aria-label="..."><label for="2000mhz">2000</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_2" id="2500mhz" value="=2500" aria-label="..."><label for="2500mhz">2500</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_3" id="3000mhz" value="=3000" aria-label="..."><label for="3000mhz">3000</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="frequencia_4" id="3500mhz" value="=3500" aria-label="..."><label for="3500mhz">3500</label>
                </div>
                <!-- Adicione outras frequências aqui conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Frequência -->
    <!-- Quantidade RAM -->
    <li>
        <input type="checkbox" name="dropdown" id="ram-video">
        <label for="ram-video" class="dropdown-label">Memória RAM</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quant_ram_1" id="1GB-ram" value="=1" aria-label="..."><label for="1GB-ram">1GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quant_ram_2" id="2GB-ram" value="=2" aria-label="..."><label for="2GB-ram">2GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quant_ram_3" id="4GB-ram" value="=4" aria-label="..."><label for="4GB-ram">4GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quant_ram_4" id="6GB-ram" value="=6" aria-label="..."><label for="6GB-ram">6GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quant_ram_5" id="8GB-ram" value="=8" aria-label="..."><label for="8GB-ram">8GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quant_ram_6" id="12GB-ram" value="=12" aria-label="..."><label for="12GB-ram">12GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quant_ram_7" id="16GB-ram" value="=16" aria-label="..."><label for="16GB-ram">16GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quant_ram_8" id="32GB-ram" value="=32" aria-label="..."><label for="32GB-ram">32GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quant_ram_9" id="64GB-ram" value="=64" aria-label="..."><label for="64GB-ram">64GB</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade RAM -->
    <!-- Barramento de Encaixe de Vídeo -->
    <li>
        <input type="checkbox" name="dropdown" id="barramento-encaixe-video">
        <label for="barramento-encaixe-video" class="dropdown-label">Barramento de Encaixe</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramento_encaixe_video_1" id="pcie-x1" value="='x1'" aria-label="..."><label for="pcie-x1">PCIe X1</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramento_encaixe_video_2" id="pcie-x2" value="='x2'" aria-label="..."><label for="pcie-x2">PCIe X2</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramento_encaixe_video_3" id="pcie-x4" value="='x4'" aria-label="..."><label for="pcie-x4">PCIe X4</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramento_encaixe_video_4" id="pcie-x8" value="='x8'" aria-label="..."><label for="pcie-x8">PCIe X8</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramento_encaixe_video_5" id="pcie-x16" value="='x16'" aria-label="..."><label for="pcie-x16">PCIe X16</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramento_encaixe_video_6" id="pci" value="='pci'" aria-label="..."><label for="pci">PCI</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramento_encaixe_video_7" id="agp" value="='agp'" aria-label="..."><label for="agp">AGP</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramento_encaixe_video_8" id="thunderbolt" value="='thunderbolt'" aria-label="..."><label for="thunderbolt">Thunderbolt</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Barramento de Encaixe de Vídeo -->
<!-- Fim Placa de video -->
<!-- Armazenamento -->
    <!-- Fabricante -->
    <li>
        <input type="checkbox" name="dropdown" id="fabricantes">
        <label for="fabricantes" class="dropdown-label">Fabricante</label>
        <div class="content content-1">
            <div> 
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_1" id="kingston" value="='KINGSTON'" aria-label="...">
                    <label for="kingston">KINGSTON</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_2" id="western digital" value="='WESTERN DIGITAL'" aria-label="...">
                    <label for="western digital">WESTERN DIGITAL</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_3" id="husky" value="='HUSKY'" aria-label="...">
                    <label for="husky">HUSKY</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_4" id="seagate" value="='SEAGATE'" aria-label="...">
                    <label for="seagate">SEAGATE</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Fabricante -->
    <!-- Tipo de Armazenamento -->
    <li>
        <input type="checkbox" name="dropdown" id="tipo-armazenamento">
        <label for="tipo-armazenamento" class="dropdown-label">Tipo de Armazenamento</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="tipo_armazenamento_1" id="hd" value="='hd'" aria-label="..."><label for="hd">HD</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="tipo_armazenamento_2" id="ssd" value="='ssd'" aria-label="..."><label for="ssd">SSD</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Tipo de Armazenamento -->
    <!-- Quantidade de armazenamento -->
    <li>
        <input type="checkbox" name="dropdown" id="capacidade-memoria">
        <label for="capacidade-memoria" class="dropdown-label">Capacidade de memória</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quantidade_armazenamento_1" id="128GB" value="=128" aria-label="..."><label for="128GB">128GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quantidade_armazenamento_2" id="256GB" value="=256" aria-label="..."><label for="256GB">256GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quantidade_armazenamento_3" id="512GB" value="=512" aria-label="..."><label for="512GB">512GB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quantidade_armazenamento_4" id="1TB" value="=1000" aria-label="..."><label for="1TB">1TB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quantidade_armazenamento_5" id="2TB" value="=2000" aria-label="..."><label for="2TB">2TB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quantidade_armazenamento_6" id="4TB" value="=4000" aria-label="..."><label for="4TB">4TB</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="quantidade_armazenamento_7" id="8TB" value="=8000" aria-label="..."><label for="8TB">8TB</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Quantidade armazenamento -->
    <!-- Barramento de Encaixe de Armazenamento -->
    <li>
        <input type="checkbox" name="dropdown" id="barramento-encaixe-armazenamento">
        <label for="barramento-encaixe-armazenamento" class="dropdown-label">Barramento de Encaixe</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramento_encaixe_armazenamento_1" id="pata" value="='pata'" aria-label="..."><label for="pata">PATA</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramento_encaixe_armazenamento_2" id="sata" value="='sata'" aria-label="..."><label for="sata">SATA</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramento_encaixe_armazenamento_3" id="m2_sata" value="='m2_nvme'" aria-label="..."><label for="m2_sata">M.2 SATA</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="barramento_encaixe_armazenamento_4" id="m2_nvme" value="='m2_sata'" aria-label="..."><label for="m2_nvme">M.2 NVMe</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Barramento de Encaixe de Armazenamento -->
<!-- Fim Armazenamento -->
<!-- Gabinete -->
    <!-- Fabricante -->
    <li>
        <input type="checkbox" name="dropdown" id="fabricantes">
        <label for="fabricantes" class="dropdown-label">Fabricante</label>
        <div class="content content-1">
            <div> 
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_1" id="kingston" value="='ASUS'" aria-label="...">
                    <label for="asus">ASUS</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_2" id="western digital" value="='CORSAIR'" aria-label="...">
                    <label for="asrock">CORSAIR</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_3" id="husky" value="='MSI'" aria-label="...">
                    <label for="msi">MSI</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_4" id="xpg" value="='XPG'" aria-label="...">
                    <label for="gigabyte">XPG</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Fabricante -->
    <!-- Formato do Gabinete -->
    <li>
        <input type="checkbox" name="dropdown" id="formato-gabinete">
        <label for="formato-gabinete" class="dropdown-label">Formato do Gabinete</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="formato_gabinete_1" id="full-tower" value="='full'" aria-label="..."><label for="full-tower">Full Tower</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="formato_gabinete_2" id="mid-tower" value="='mid'" aria-label="..."><label for="mid-tower">Mid Tower</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="formato_gabinete_3" id="mini-tower" value="='mini'" aria-label="..."><label for="mini-tower">Mini Tower</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Formato do Gabinete -->
<!-- Fim Gabinete -->
<!-- Fonte -->
    <!-- Fabricante -->
    <li>
        <input type="checkbox" name="dropdown" id="fabricantes">
        <label for="fabricantes" class="dropdown-label">Fabricante</label>
        <div class="content content-1">
            <div> 
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_1" id="asus" value="='ASUS'" aria-label="...">
                    <label for="asus">ASUS</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_2" id="corsair" value="='CORSAIR'" aria-label="...">
                    <label for="corsair">CORSAIR</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_3" id="msi" value="='MSI'" aria-label="...">
                    <label for="msi">MSI</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_4" id="xpg" value="='XPG'" aria-label="...">
                    <label for="gigabyte">XPG</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Fabricante -->
    <!-- Potência -->
    <li>
        <input type="checkbox" name="dropdown" id="potencia-fonte">
        <label for="potencia-fonte" class="dropdown-label">Potência</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="potencia_1" id="500W" value="=500" aria-label="..."><label for="500W">500W</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="potencia_2" id="550W" value="=550" aria-label="..."><label for="550W">550W</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="potencia_3" id="600W" value="=600" aria-label="..."><label for="600W">600W</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Potência -->
    <!-- Selo 80 PLUS -->
    <li>
        <input type="checkbox" name="dropdown" id="selo-80-plus">
        <label for="selo-80-plus" class="dropdown-label">Certificação 80 PLUS</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="selo_80_plus_1" id="nenhum" value="='nenhum'" aria-label="..."><label for="nenhum">Nenhum</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="selo_80_plus_2" id="padrao" value="='padrao'" aria-label="..."><label for="padrao">Padrão</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="selo_80_plus_3" id="bronze" value="='bronze'" aria-label="..."><label for="bronze">Bronze</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="selo_80_plus_4" id="silver" value="='silver'" aria-label="..."><label for="silver">Silver</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="selo_80_plus_5" id="gold" value="='gold'" aria-label="..."><label for="gold">Gold</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="selo_80_plus_6" id="platinum" value="='platinum'" aria-label="..."><label for="platinum">Platinum</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="selo_80_plus_7" id="titanium" value="='titanium'" aria-label="..."><label for="titanium">Titanium</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Selo 80 PLUS -->
<!-- Fim Fonte -->
<!-- Cooler -->
    <!-- Fabricante -->
    <li>
        <input type="checkbox" name="dropdown" id="fabricantes">
        <label for="fabricantes" class="dropdown-label">Fabricante</label>
        <div class="content content-1">
            <div> 
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_1" id="kingston" value="='ASUS'" aria-label="...">
                    <label for="asus">ASUS</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_2" id="deepcool" value="='DEEPCOOL'" aria-label="...">
                    <label for="deepcool">DEEPCOOL</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_3" id="cooler master" value="='COOLER MASTER'" aria-label="...">
                    <label for="cooler master">COOLER MASTER</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="UPPER(fabricante)_4" id="tgt" value="='TGT'" aria-label="...">
                    <label for="tgt">TGT</label>
                </div>
            </div>
        </div>
    </li>
    <!-- Fim Fabricante -->
    <!-- Resfriamento -->
    <li>
        <input type="checkbox" name="dropdown" id="resfriamento">
        <label for="resfriamento" class="dropdown-label">Método de Resfriamento</label>
        <div class="content content-1">
            <div>
                <div>
                    <input class="form-check-input" type="checkbox" name="resfriamento_1" id="air" value="='air'" aria-label="..."><label for="air">Ar</label>
                </div>
                <div>
                    <input class="form-check-input" type="checkbox" name="resfriamento_2" id="liquid" value="='liquid'" aria-label="..."><label for="liquid">Líquido</label>
                </div>
                <!-- Adicione outras opções conforme necessário -->
            </div>
        </div>
    </li>
    <!-- Fim Resfriamento -->
<!-- Fim Cooler -->