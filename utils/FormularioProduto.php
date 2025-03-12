<?php

class FormularioProduto{	
	
	public static function monta_formulario($categoria){
        if($categoria=='placa_mae')
            return '<div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="fabricante">Fabricante:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top"
                    data-bs-title="A fabricante é a empresa responsável por projetar, produzir e comercializar a placa-mãe. Algumas das mais conhecidas incluem ASUS, MSI, Gigabyte, ASRock, e outras. Ela pode ser encontrada no logotipo na parte frontal da caixa do produto, etiquetas, adesivos, informações na lateral ou parte traseira. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <input type="text" id="fabricante" name="fabricante" placeholder="ASUS" required>
                <p id="mens_fabricante" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="modelo">Modelo:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Cada placa-mãe possui um modelo único que a distingue das outras. O modelo é geralmente uma combinação de letras e números que identifica a marca, a série e as características específicas da placa-mãe. Pode ser encontrado na caixa da placa-mãe, impresso na própria placa, rótulos, etiquetas ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <input type="text" id="modelo" name="modelo" placeholder="ROG STRIX Z490-A GAMING" required>
                <p id="mens_modelo" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="fab_comp">Fabricante dos processadores compatíveis:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere-se à empresa que projetou e produziu a placa-mãe para acomodar determinados tipos ou gerações de processadores. As placas-mãe são projetadas para serem compatíveis com processadores específicos ou famílias de processadores. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante.">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <select name="fab_comp" id="fab_comp" required>
                    <option value="">Selecione uma opção</option>
                    <option value="AMD">AMD</option>
                    <option value="Intel">Intel</option>
                </select>
                <p id="mens_fab_comp" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="soquete">Soquete do processador:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Também conhecido como soquete da CPU, é o local na placa-mãe onde o processador (CPU) é instalado. Ele é projetado de forma específica para acomodar um determinado tipo ou família de processadores. Cada fabricante de processadores (como Intel ou AMD) pode ter seus próprios designs de soquete, e diferentes gerações de processadores podem exigir soquetes diferentes. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante.">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <input type="text" id="soquete" name="soquete" placeholder="AM4" required oninput="removerCaracteres(event)">
                <p id="mens_soquete" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="frequencia">Frequência base (MHz):*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere-se à frequência de clock do barramento do sistema. O barramento do sistema é a via pela qual os dados viajam entre o processador (CPU) e outros componentes do sistema, como a memória RAM. Pode ser encontrado no manual da placa-mãe, dentro do manual vá para Índice ou Seção de Especificações.">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <input type="number" id="frequencia" name="frequencia" placeholder="3666" required>
                <p id="mens_frequencia" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="slots_ram">Quantidade de Barramentos RAM:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere-se ao número de slots de memória RAM disponíveis na placa para conectar módulos de memória RAM. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <input type="number" id="slots_ram" name="barramentos_ram" placeholder="4" required >
                <p id="mens_slots_ram" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="max_ram">Capacidade máxima de memória RAM (GB):*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere à quantidade máxima de memória RAM que a placa-mãe pode suportar. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a> 
                </div>
                <input type="number" id="max_ram" name="max_ram" placeholder="128" required >
                <p id="mens_max_ram" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="tipo_ram">Geração de memória RAM:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere-se ao tipo específico e à velocidade da memória RAM suportada por uma placa-mãe. Pode ser encontrado no manual da placa-mãe, Exemplos: DDR, DDR2, DDR3, DDR4. Pode ser enconrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a> 
                </div>
                <select name="tipo_ram" id="tipo_ram" required>
                    <option value="">Selecione uma opção</option>
                    <option value="DDR">DDR</option>
                    <option value="DDR2">DDR2</option>
                    <option value="DDR3">DDR3</option>
                    <option value="DDR4">DDR4</option>
                    <option value="DDR5">DDR5</option>
                </select>
                <p id="mens_tipo_ram" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="barramentos_x1">Quantidade de barramentos PCIe X1:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere-se ao número de slots disponíveis para conectar dispositivos PCIe, como placas de vídeo, placas de som, SSDs e outras placas de expansão. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a> 
                </div>
                <select name="barramentos_x1" id="barramentos_x1" required>
                    <option value="">Selecione uma opção</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <p id="mens_barramentos_x1" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="barramentos_x2">Quantidade de barramentos PCIe X2:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere-se ao número de slots disponíveis para conectar dispositivos PCIe, como placas de vídeo, placas de som, SSDs e outras placas de expansão. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a> 
                </div>
                <select name="barramentos_x2" id="barramentos_x2" required>
                    <option value="">Selecione uma opção</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <p id="mens_barramentos_x2" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="barramentos_x4">Quantidade de barramentos PCIe X4:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere-se ao número de slots disponíveis para conectar dispositivos PCIe, como placas de vídeo, placas de som, SSDs e outras placas de expansão. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div> 
                <select name="barramentos_x4" id="barramentos_x4" required>
                    <option value="">Selecione uma opção</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <p id="mens_barramentos_x4" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="barramentos_x8">Quantidade de barramentos PCIe X8:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere-se ao número de slots disponíveis para conectar dispositivos PCIe, como placas de vídeo, placas de som, SSDs e outras placas de expansão. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a> 
                </div>
                <select name="barramentos_x8" id="barramentos_x8" required>
                    <option value="">Selecione uma opção</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <p id="mens_barramentos_x8" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="barramentos_x16">Quantidade de barramentos PCIe X16:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere-se ao número de slots disponíveis para conectar dispositivos PCIe, como placas de vídeo, placas de som, SSDs e outras placas de expansão. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <select name="barramentos_x16" id="barramentos_x16" required>
                    <option value="">Selecione uma opção</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <p id="mens_barramentos_x16" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="barramentos_pci">Quantidade de barramentos PCI:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere ao número de slots PCI disponíveis para conectar periféricos e placas de expansão. Os barramentos PCI são interfaces de hardware padrão que permitem a comunicação entre a placa-mãe e dispositivos como placas de vídeo, placas de som, placas de rede, entre outros. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <select name="barramentos_pci" id="barramentos_pci" required>
                    <option value="">Selecione uma opção</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <p id="mens_barramentos_pci" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="barramentos_agp">Quantidade de barramentos AGP:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="É um tipo de barramento utilizado em placas-mãe para conectar a placa de vídeo ao sistema. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <select name="barramentos_agp" id="barramentos_agp" required>
                    <option value="">Selecione uma opção</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <p id="mens_barramentos_agp" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="barramentos_thunderbolt">Quantidade de barramentos Thunderbolt:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Referem-se ao número de conexões ou portas Thunderbolt disponíveis nessa placa. O Thunderbolt é uma interface de entrada/saída de alta velocidade desenvolvida pela Intel em colaboração com a Apple. Ele permite a transferência de dados, vídeo e energia por meio de um único cabo. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <select name="barramentos_thunderbolt" id="barramentos_thunderbolt" required>
                    <option value="">Selecione uma opção</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <p id="mens_barramentos_thunderbolt" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="barramentos_pata">Quantidade de barramentos PATA:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere ao número de conectores disponíveis para dispositivos de armazenamento IDE, é um padrão de interface para a conexão de dispositivos de armazenamento, como unidades de disco rígido e unidades de CD/DVD. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <select name="barramentos_pata" id="barramentos_pata" required>
                    <option value="">Selecione uma opção</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <p id="mens_barramentos_pata" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="barramentos_sata">Quantidade de barramentos SATA padrão:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere ao número de conectores SATA disponíveis para conexão de dispositivos de armazenamento, como discos rígidos (HDDs) e unidades de estado sólido (SSDs). Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <select name="barramentos_sata" id="barramentos_sata" required>
                    <option value="">Selecione uma opção</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <p id="mens_barramentos_sata" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="barramentos_m2_sata">Quantidade de barramentos para SSD M.2 do tipo SATA (B + M key):*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere-se ao número de conectores disponíveis na placa-mãe para esse tipo específico de SSD. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <select name="barramentos_m2_sata" id="barramentos_m2_sata" required>
                    <option value="">Selecione uma opção</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <p id="mens_barramentos_m2_sata" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="barramentos_m2_nvme">Quantidade de barramentos para SSD M.2 do tipo NVMe (M key):*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere-se ao número de conectores disponíveis na placa-mãe para esse tipo específico de SSD. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <select name="barramentos_m2_nvme" id="barramentos_m2_nvme" required>
                    <option value="">Selecione uma opção</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <p id="mens_barramentos_m2_nvme" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="fator_forma">Fator de forma:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere ao seu tamanho e ao layout físico. Ele determina as dimensões, o design e a disposição dos componentes na placa-mãe. Exemplos: ATX, Micro-ATX, e Mini-ITX. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <select name="fator_forma" id="fator_forma" required>
                    <option value="">Selecione uma opção</option>
                    <option value="atx">ATX</option>
                    <option value="eatx">EATX</option>
                    <option value="mini">Mini ATX</option>
                    <option value="micro">Micro ATX</option>
                </select>
                <p id="mens_fator_forma" class="mens"></p>
            </div>
            <div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="consumo_energia">Consumo de energia estimado (Watts):*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="Refere-se à quantidade de energia elétrica que o componente consome durante o seu funcionamento. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
                <input type="number" placeholder="100" id="consumo_energia" name="consumo_energia" required>
                <p id="mens_consumo_energia" class="mens"></p>
            </div>';
        
        



        if($categoria=='processador')
            return '<div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="fabricante">Fabricante:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="É a empresa ou entidade que projeta, desenvolve e produz o processador. Ela pode ser encontrada no logotipo na parte frontal da caixa do produto, etiquetas, adesivos, informações na lateral ou parte traseira. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <select name="fabricante" id="fabricante" required onchange="verificarProcessador(this)">
                <option value="">Selecione uma opção</option>
                <option value="AMD">AMD</option>
                <option value="Intel">Intel</option>
            </select>
            <p id="mens_fabricante" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="linha">Linha:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere à série ou família específica à qual um processador pertence, e geralmente indica o desempenho e recursos que você pode esperar desse processador. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <select name="linha" id="linha" required disabled>
                <option id="standard_option_processador" value="">Selecione a fabricante do processador primeiro</option>
            </select>
            <p id="mens_barramento" class="mens"></p>
            <!-- <select name="linha" id="linha" required>
                <option value="">Selecione uma opção</option>
                <option value="athlon">Athlon</option>
                <option value="atom">Atom</option>
                <option value="Celeron">Celeron</option>
                <option value="pentium">Pentium</option>
                <option value="i3">Core i3</option>
                <option value="i5">Core i5</option>
                <option value="i7">Core i7</option>
                <option value="i9">Core i9</option>
                <option value="ryzen 3">Ryzen 3</option>
                <option value="ryzen 5">Ryzen 5</option>
                <option value="ryzen 7">Ryzen 7</option>
                <option value="ryzen 9">Ryzen 9</option>
            </select>
            <p id="mens_linha" class="mens"></p> -->
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="modelo">Modelo:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à identificação específica de um processador dentro de uma linha ou série de processadores. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="modelo" name="modelo" placeholder="Ryzen 7 5800x" required>
            <p id="mens_modelo" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="soquete">Soquete:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="É o conector mecânico e elétrico que permite a conexão de um processador (CPU) a uma placa-mãe. Este é o ponto de contato entre a CPU e o resto do sistema, facilitando a transferência de dados e energia entre o processador e outros componentes do computador. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="soquete" name="soquete" placeholder="AM4" required oninput="removerCaracteres(event)">
            <p id="mens_soquete" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="frequencia">Frequência base (MHz):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à velocidade padrão ou nominal com que o processador opera. É medida em Hertz (Hz) e representa a taxa de ciclos de clock por segundo. Os ciclos de clock são os pulsos elétricos que coordenam e sincronizam as operações do processador. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="frequencia" name="frequencia" placeholder="3800" required>
            <p id="mens_frequencia" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="nucleos">Quantidade de núcleos:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se ao número de unidades independentes de processamento dentro do chip. Cada núcleo é capaz de executar instruções separadamente, o que permite que o processador realize múltiplas tarefas simultaneamente, conhecido como processamento paralelo. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="nucleos" name="nucleos" placeholder="8" required>
            <p id="mens_nucleos" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="threads">Quantidade de threads:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se ao número de unidades de execução independentes que podem ser simultaneamente gerenciadas pela CPU. Uma thread é uma sequência de instruções que pode ser executada pela CPU. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="threads" name="threads" placeholder="16" required>
            <p id="mens_threads" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="litografia">Litografia (Nanômetros):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se ao processo de fabricação utilizado para criar os componentes microscópicos no chip. A litografia é medida em nanômetros (nm) e representa a distância média entre os transistores individuais no chip. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="litografia" name="litografia" placeholder="16" required>
            <p id="mens_litografia" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label>GPU integrada:</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se a uma Unidade de Processamento Gráfico que está incorporada no próprio chip do processador. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <div class="checkbox">
            <input type="checkbox" id="gpu" name="video_integrado" value="1"> <label for="gpu">Possui GPU integrada</label><br>
            </div>
            <p id="mens_gpu" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label>Cooler:</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="É um componente que tem a função de dissipar o calor gerado pelo processador durante seu funcionamento. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <div class="checkbox">
            <input type="checkbox" id="cooler_incluso" name="cooler_incluso" value="1"> <label for="cooler_incluso">Possui cooler incluso</label><br>
            </div>
            <p id="mens_cooler_incluso" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="consumo_energia">Consumo de energia estimado (Watts):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à quantidade de energia elétrica que o componente consome durante o seu funcionamento. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" placeholder="100" id="consumo_energia" name="consumo_energia" required>
            <p id="mens_consumo_energia" class="mens"></p>
        </div>';




        if($categoria=='ram')
            return '<div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="fabricante">Fabricante:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="É uma empresa ou entidade responsável pela produção e venda de módulos de memória RAM. Ela pode ser encontrada no logotipo na parte frontal da caixa do produto, etiquetas, adesivos, informações na lateral ou parte traseira. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="fabricante" name="fabricante" placeholder="Kingston" required>
            <p id="mens_fabricante" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="modelo">Modelo:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere à série ou tipo específico da memória. Isso inclui não apenas o nome da marca, mas também a linha de produtos e, por vezes, informações mais detalhadas sobre a especificação da memória. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="modelo" name="modelo" placeholder="Fury Beast" required>
            <p id="mens_modelo" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label>Kit de pentes:</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere a um conjunto de módulos de memória RAM que são vendidos juntos como uma unidade. Cada módulo individual é chamado de "pente" de memória. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <div class="checkbox">
                <input type="checkbox" id="kit" name="kit" value="1" onchange="alterarPentes(this)"> <label for="kit">Anúncio inclui múltiplos pentes</label><br>
            </div>
            <p id="mens_kit" class="mens"></p>
        </div>
        <div class="entrar-items" id="div_quant_pentes" style="display:none;">
            <div class="entrar-items-content-1">
                <label for="pentes">Quantidade de pentes:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="pentes" name="quantidade_pentes" placeholder="2" required value="1">
            <p id="mens_pentes" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="frequencia">Frequência base (MHz):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à velocidade nominal ou à taxa de transferência de dados que uma memória RAM pode atingir. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="frequencia" name="frequencia" placeholder="3666" required>
            <p id="mens_frequencia" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="quant_ram">Quantidade de memória do pente (GB):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à capacidade de armazenamento desse módulo específico. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="quant_ram" name="ram_pente_individual" placeholder="8" required>
            <p id="mens_quant_ram" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="tipo_ram">Tipo de memória RAM:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à geração ou padrão específico de tecnologia de memória utilizada nos módulos de memória. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante.">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <select name="tipo_ram" id="tipo_ram" required>
                <option value="">Selecione uma opção</option>
                <option value="DDR">DDR</option>
                <option value="DDR2">DDR2</option>
                <option value="DDR3">DDR3</option>
                <option value="DDR4">DDR4</option>
                <option value="DDR5">DDR5</option>
            </select>
            <p id="mens_tipo_ram" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="consumo_energia">Consumo de energia estimado (Watts):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à quantidade de energia elétrica que o componente consome durante o seu funcionamento. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" placeholder="100" id="consumo_energia" name="consumo_energia" required>
            <p id="mens_consumo_energia" class="mens"></p>
        </div>';




        if($categoria=='placa_video')
            return '<div class="entrar-items">
                <div class="entrar-items-content-1">
                    <label for="fabricante">Fabricante:*</label>
                    <a class="a-tooltip" 
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" 
                    data-bs-title="É uma empresa ou entidade responsável pela produção e venda de módulos de memória RAM. Ela pode ser encontrada no logotipo na parte frontal da caixa do produto, etiquetas, adesivos, informações na lateral ou parte traseira. ">
                        <i class="bi bi-question-circle"></i>
                    </a>
                </div>
            <input type="text" id="fabricante" name="fabricante" placeholder="Nvidia" required>
            <p id="mens_fabricante" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="modelo">Modelo:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere ao modelo específico ou à série de placas de vídeo produzidas por um fabricante. Cada placa de vídeo é projetada com um conjunto único de características, desempenho e capacidades, e essas características são agrupadas sob um nome específico, que é o modelo da placa. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="modelo" name="modelo" placeholder="RTX 2060 super" required>
            <p id="mens_modelo" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="frequencia">Frequência base da GPU (MHz):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à velocidade de operação padrão da placa de vídeo. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="frequencia" name="frequencia" placeholder="1470" required>
            <p id="mens_frequencia" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="quant_ram">Quantidade de memória RAM (GB):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se a memória usada para armazenar temporariamente dados que a GPU precisa acessar rapidamente durante suas operações, como texturas, buffers de quadros, geometria de modelos 3D, entre outros. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="quant_ram" name="ram_placa_video" placeholder="8" required>
            <p id="mens_quant_ram" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="barramento">Barramento de encaixe:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title=" Conector ou slot no qual a placa de vídeo é encaixada na placa-mãe. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <select name="barramento_encaixe_video" id="barramento" required>
                <option value="">Selecione uma opção</option>
                <option value="x1">PCIe X1</option>
                <option value="x2">PCIe X2</option>
                <option value="x4">PCIe X4</option>
                <option value="x8">PCIe X8</option>
                <option value="x16">PCIe X16</option>
                <option value="pci">PCI</option>
                <option value="agp">AGP</option>
                <option value="thunderbolt">Thunderbolt</option>
            </select>
            <p id="mens_barramento" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="consumo_energia">Consumo de energia estimado (Watts):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à quantidade de energia elétrica que o componente consome durante o seu funcionamento. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" placeholder="100" id="consumo_energia" name="consumo_energia" required>
            <p id="mens_consumo_energia" class="mens"></p>
        </div>';



        if($categoria=='armazenamento')
            return '<div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="fabricante">Fabricante:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere à empresa ou entidade que projeta, produz e vende dispositivos de armazenamento de dados, como discos rígidos (HDDs), unidades de estado sólido (SSDs), cartões de memória, pen drives, entre outros. Ela pode ser encontrada no logotipo na parte frontal da caixa do produto, etiquetas, adesivos, informações na lateral ou parte traseira. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="fabricante" name="fabricante" placeholder="Seagate" required>
            <p id="mens_fabricante" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="modelo">Modelo:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Tipo específico ou design do dispositivo. Cada dispositivo de armazenamento pode ser caracterizado por suas especificações, capacidades e tecnologias subjacentes. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="modelo" name="modelo" placeholder="Barracuda Q5" required>
            <p id="mens_modelo" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="tipo_armazenamento">Tipo de armazenamento:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Tipo de tecnologia de armazenamento utilizada. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <select id="tipo_armazenamento" name="tipo_armazenamento" onchange="verificarTipo(this)" required>
                <option value="">Selecione uma opção</option>
                <option value="HD">HD</option>
                <option value="SSD">SSD</option>
            </select>
            <p id="mens_tipo_armazenamento" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="memoria">Quantidade de memória (GB):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à capacidade de armazenamento de dados que o dispositivo pode conter. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="memoria" name="quantidade_armazenamento" placeholder="1000" required>
            <p id="mens_memoria" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="barramento_encaixe_armazenamento">Barramento de encaixe:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à capacidade de armazenamento de dados que o dispositivo pode conter. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <select name="barramento_encaixe_armazenamento" id="barramento_encaixe_armazenamento" required disabled>
                <option id="standard_option" value="">Selecione o tipo de armazenamento primeiro</option>
            </select>
            <p id="mens_barramento" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="consumo_energia">Consumo de energia estimado (Watts):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à quantidade de energia elétrica que o componente consome durante o seu funcionamento. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" placeholder="100" id="consumo_energia" name="consumo_energia" required>
            <p id="mens_consumo_energia" class="mens"></p>
        </div>';




        if($categoria=='gabinete')
            return '<div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="fabricante">Fabricante:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Fabricante de gabinete de computador seria uma empresa que projeta, produz e vende esses gabinetes. Essas empresas geralmente oferecem uma variedade de estilos e tamanhos. Ela pode ser encontrada no logotipo na parte frontal da caixa do produto, etiquetas, adesivos, informações na lateral ou parte traseira. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="fabricante" name="fabricante" placeholder="TGT" required>
            <p id="mens_fabricante" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="modelo">Modelo:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Referir a diferentes aspectos do design e da estrutura de um gabinete de computador. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="modelo" name="modelo" placeholder="Carbon" required>
            <p id="mens_modelo" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="comprimento">Comprimento (mm):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à dimensão física que indica a extensão ou medida ao longo de uma linha reta do gabinete. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="comprimento" name="comprimento" placeholder="330" required>
            <p id="mens_comprimento" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="largura">Largura (mm):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à medida horizontal. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="largura" name="largura" placeholder="180" required>
            <p id="mens_largura" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="altura">Altura (mm):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à medida Vertical. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="altura" name="altura" placeholder="410" required>
            <p id="mens_largura" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="formato">Formato:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à sua estrutura física e design externo. Existem vários formatos e tamanhos. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
        <select name="formato_gabinete" id="formato" required>
            <option value="">Selecione uma opção</option>
            <option value="full">Full Tower</option>
            <option value="mid">Mid Tower</option>
            <option value="mini">Mini Tower</option>
        </select>
        <p id="mens_formato" class="mens"></p>
        </div>';



        if($categoria=='fonte')
            return '<div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="fabricante">Fabricante:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere à empresa ou entidade responsável por projetar, desenvolver e produzir fontes de alimentação elétrica. Ela pode ser encontrada no logotipo na parte frontal da caixa do produto, etiquetas, adesivos, informações na lateral ou parte traseira.">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="fabricante" name="fabricante" placeholder="Corsair" required>
            <p id="mens_fabricante" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="modelo">Modelo:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere a uma designação específica atribuída pelo fabricante para identificar e distinguir entre diferentes modelos de fontes de alimentação. Esse modelo é muitas vezes uma combinação de letras e números que fornecem informações sobre as características e especificações da fonte. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="modelo" name="modelo" placeholder="CV550" required>
            <p id="mens_modelo" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="potencia">Potência (W):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Indica a quantidade máxima de energia que a fonte pode fornecer aos componentes do computador. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="potencia" name="potencia" placeholder="550" required>
            <p id="mens_potencia" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="fator_forma">Formato:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Especificam o design físico da fonte de alimentação e a disposição dos conectores. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <select name="fator_forma" id="fator_forma" required>
                <option value="">Selecione uma opção</option>
                <option value="atx">ATX</option>
                <option value="sfx">SFX</option>
                <option value="tfx">TFX</option>
            </select>
            <p id="mens_fator_forma" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="certificacao">Certificação 80 Plus:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="É um padrão de eficiência energética. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <select name="selo_80_plus" id="certificacao" required>
                <option value="">Selecione uma opção</option>
                <option value="nenhum">Nenhum</option>
                <option value="padrao">Padrao</option>
                <option value="bronze">Bronze</option>
                <option value="silver">Silver</option>
                <option value="gold">Gold</option>
                <option value="platinum">Platinum</option>
                <option value="titanium">Titanium</option>
            </select>
            <p id="mens_certificacao" class="mens"></p>
        </div>';


        if($categoria=='cooler')
            return '<div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="fabricante">Fabricante:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="É a empresa ou marca que projeta, fabrica e comercializa o cooler. Ela pode ser encontrada no logotipo na parte frontal da caixa do produto, etiquetas, adesivos, informações na lateral ou parte traseira.">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="fabricante" name="fabricante" placeholder="Deepcool" required>
            <p id="mens_fabricante" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="modelo">Modelo:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere ao tipo ou design específico. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="text" id="modelo" name="modelo" placeholder="Ak500" required>
            <p id="mens_modelo" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="comprimento">Comprimento (mm):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à dimensão física que representa a extensão ou tamanho do cooler em uma determinada direção. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="comprimento" name="comprimento" placeholder="120" required>
            <p id="mens_comprimento" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="largura">Largura (mm):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à dimensão física que representa a extensão ou tamanho do cooler em uma determinada direção. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="largura" name="largura" placeholder="120" required>
            <p id="mens_largura" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="altura">Altura (mm):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à dimensão física que representa a extensão ou tamanho do cooler em uma determinada direção. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" id="altura" name="altura" placeholder="120" required>
            <p id="mens_largura" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="resfriamento">Resfriamento:*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se ao tipo de resfriamento. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <select name="resfriamento" id="resfriamento" required>
                <option value="">Selecione uma opção</option>
                <option value="air">Air Cooler</option>
                <option value="liquid">Liquid Cooler</option>
            </select>
            <p id="mens_resfriamento" class="mens"></p>
        </div>
        <div class="entrar-items">
            <div class="entrar-items-content-1">
                <label for="consumo_energia">Consumo de energia estimado (Watts):*</label>
                <a class="a-tooltip" 
                data-bs-toggle="tooltip" 
                data-bs-placement="top" 
                data-bs-title="Refere-se à quantidade de energia elétrica que o componente consome durante o seu funcionamento. Pode ser encontrado no manual do produto, caixa do produto, ou site do fabricante. ">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>
            <input type="number" placeholder="100" id="consumo_energia" name="consumo_energia" required>
            <p id="mens_consumo_energia" class="mens"></p>
        </div>';
    }

}
?>
