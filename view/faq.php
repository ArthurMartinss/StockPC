<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/faq.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/default.css">
        <link rel="stylesheet" href="../css/index.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
        <script async src="https://kit.fontawesome.com/0e01c81990.js" crossorigin="anonymous"></script>
        <!-- icones? -->
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
        <!-- <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet"> -->          
        
        <script async src="../js/index.js"></script>
        <link rel="icon" type="image/x-icon" href="../img/favicon/pc2.png">
        <title>Perguntas Frequentes - StockPC</title>
</head>
<body>
    
<?php
        require "req_navbar.php" 
?>

    <div class="faq-div">
        <div class="faq-section">
            <div class="heading">
                <h2> <i class="ri-questionnaire-fill"></i> Dúvidas frequentes</h2>
                <p> Respostas para algumas dúvidas que você possa ter.</p>
            </div>
        
            <div class="perguntas">
                <ul class="dropdown">

                    <li>
                        <input type="checkbox" name="dropdown" id="pergunta1" >
                        <label for="pergunta1" class="dropdown-label"><h3 class='titulo_secao'> Para que serve um(a)  Placa-mãe? </h3> </label>
                        <div class="content content-1">
                                <div>
                                    <p>
                                        Uma placa mãe é como o cérebro de um computador. Ela é uma placa de circuito que conecta todas as peças do computador, como o processador, a memória, o armazenamento e outros componentes. Sua função é permitir que todas essas partes se comuniquem e trabalhem juntas para que o computador funcione. É como o "coração" do computador, onde todas as informações são processadas e distribuídas para que você possa usar o computador para tarefas como navegar na internet, jogar jogos, escrever documentos e muito mais
                                    </p>
                                </div>
                        </div>
                    </li>
                    <li>
                        <input type="checkbox" name="dropdown" id="cpu" >
                        <label for="cpu" class="dropdown-label"><h3 class='titulo_secao'> Para que serve um(a)  Processador? </h3> </label>
                        <div class="content content-1">
                            <div>
                                <p>Um processador é como o "cérebro" de um computador. Ele é responsável por executar cálculos e tarefas muito rapidamente. Pense nele como um trabalhador muito eficiente que faz todos os cálculos necessários para que o computador funcione. <br> <br>
                                Quando você clica em um programa, joga um jogo ou navega na internet, o processador realiza cálculos complexos para processar todas essas ações. Quanto mais poderoso for o processador, mais rápido ele pode fazer esses cálculos, tornando o computador mais rápido e capaz de lidar com tarefas mais pesadas. <br> <br>
                                Em resumo, o processador é o componente-chave que permite que um computador execute todas as tarefas que você deseja, e a sua velocidade e eficiência influenciam o desempenho geral do computador.</p>
                            </div>
                        </div>
                    </li>

                    <li>
                        <input type="checkbox" name="dropdown" id="memoria-ram" >
                        <label for="memoria-ram" class="dropdown-label"><h3 class='titulo_secao'> Para que serve um(a)  Memória RAM? </h3> </label>
                        <div class="content content-1">
                            <div>
                                <p>A memória RAM, ou Memória de Acesso Aleatório, é como a "mesa de trabalho" de um computador. Ela é um tipo de memória que armazena temporariamente informações que o computador precisa para funcionar de maneira rápida e eficiente. <br> <br>
                                Quando você abre um programa ou um arquivo, o computador transfere esses dados da unidade de armazenamento (como um disco rígido) para a memória RAM. Isso permite que o processador acesse rapidamente essas informações e as utilize para executar tarefas. A memória RAM é muito mais rápida do que a memória de armazenamento, tornando o computador mais ágil. <br> <br>
                                Imagine a memória RAM como uma mesa de trabalho onde você coloca os documentos com os quais está trabalhando atualmente. Quanto mais memória RAM um computador tiver, mais "espaço na mesa" ele terá para lidar com várias tarefas ao mesmo tempo e de forma eficiente. <br> <br>
                                Em resumo, a memória RAM é essencial para a velocidade e a capacidade de multitarefa de um computador, permitindo que ele acesse e manipule informações rapidamente enquanto você o utiliza.</p>
                            </div>
                        </div>
                    </li>

                    <li>
                        <input type="checkbox" name="dropdown" id="dispositivo-de-armazenamento" >
                        <label for="dispositivo-de-armazenamento" class="dropdown-label"><h3 class='titulo_secao'> Para que serve um(a)  Dispositivo de Armazenamento? </h3> </label>
                        <div class="content content-1">
                            <div>
                                <p>Os dispositivos de armazenamento são como "armários" onde um computador guarda todas as suas informações. Eles são usados para guardar documentos, fotos, vídeos, programas e todos os dados que você precisa no seu computador.<br> <br>
                                Existem diferentes tipos de dispositivos de armazenamento, como discos rígidos (HDDs) e unidades de estado sólido (SSDs). Os HDDs são como armários com prateleiras onde os dados são armazenados em discos giratórios. Os SSDs são como armários mais modernos, onde os dados são guardados em chips de memória sem partes móveis.<br> <br>
                                Quando você salva um arquivo ou instala um programa, o computador o coloca dentro desses "armários". Quando você deseja acessar esses dados, o computador os retira do armazenamento e os coloca na memória RAM, onde podem ser usados pelo processador.<br> <br>
                                Em resumo, os dispositivos de armazenamento são onde o computador guarda todas as informações importantes, permitindo que você as acesse quando precisar. Eles são essenciais para manter seus arquivos e programas seguros e disponíveis para uso a qualquer momento.</p>
                            </div>
                        </div>
                    </li>

                    <li>
                        <input type="checkbox" name="dropdown" id="placa-de-video" >
                        <label for="placa-de-video" class="dropdown-label"><h3 class='titulo_secao'> Para que serve um(a)  Placa de Vídeo? </h3> </label>
                        <div class="content content-1">
                            <div>
                                <p>Uma placa de vídeo, também chamada de GPU (Unidade de Processamento Gráfico), é como o "artista gráfico" do seu computador. Ela é responsável por cuidar de todas as imagens e gráficos que você vê na tela, seja enquanto joga jogos, assiste a vídeos, navega na internet ou realiza tarefas gráficas.<br> <br>
                                Quando você joga um jogo ou assiste a um vídeo em alta resolução, a placa de vídeo é responsável por processar todas as imagens e garantir que elas sejam exibidas de forma suave e com boa qualidade. Ela é especialmente importante para jogos, onde precisa realizar cálculos complexos para criar gráficos 3D impressionantes.<br> <br>
                                Em resumo, a placa de vídeo é um componente essencial para a qualidade visual do seu computador. Quanto mais poderosa for a placa de vídeo, melhor será a experiência gráfica no seu computador, tornando jogos e outras atividades visuais mais agradáveis e realistas.
                                </p>
                            </div>
                        </div>
                    </li>

                    <li>
                        <input type="checkbox" name="dropdown" id="fonte-de-alimentacao" >
                        <label for="fonte-de-alimentacao" class="dropdown-label"><h3 class='titulo_secao'> Para que serve um(a)  Fonte de Alimentação? </h3> </label>
                        <div class="content content-1">
                            <div>
                                <p>Uma fonte de alimentação é como o "fornecimento de energia" do seu computador. Ela é responsável por fornecer eletricidade a todos os componentes do computador, garantindo que ele funcione corretamente.<br> <br>
                                Assim como você precisa de energia elétrica para ligar e usar aparelhos em casa, um computador também precisa de energia para funcionar. A fonte de alimentação converte a eletricidade da tomada em uma forma que o computador pode usar. Ela fornece energia para o processador, a placa-mãe, a memória, a placa de vídeo e todos os outros componentes.<br> <br>
                                Uma fonte de alimentação é medida em watts, e sua capacidade deve ser suficiente para atender a todos os componentes do computador. Se a fonte de alimentação não for poderosa o suficiente, o computador pode não funcionar corretamente ou até mesmo se desligar inesperadamente.<br> <br>
                                Em resumo, a fonte de alimentação é o componente responsável por fornecer eletricidade ao seu computador, permitindo que ele funcione. É como a "tomada de energia" do computador.
                                </p>
                            </div>
                        </div>
                    </li>

                    <li>
                        <input type="checkbox" name="dropdown" id="gabinete" >
                        <label for="gabinete" class="dropdown-label"><h3 class='titulo_secao'> Para que serve um(a)  Gabinete? </h3> </label>
                        <div class="content content-1">
                            <div>
                                <p>O gabinete é como a "casa" do seu computador. Ele é a estrutura que abriga todos os componentes internos do seu PC, como a placa-mãe, o processador, a memória, a placa de vídeo e outros.  <br> <br>
    
                                Além de fornecer um local seguro para todos esses componentes, o gabinete também possui aberturas e ventoinhas para ajudar a manter o computador resfriado. Isso é importante porque os componentes internos do computador geram calor durante o funcionamento, e o superaquecimento pode ser prejudicial. <br> <br>

                                Os gabinetes vêm em diferentes tamanhos e designs, permitindo que você escolha um que atenda às suas necessidades e preferências estéticas. Alguns gabinetes são mais compactos e adequados para computadores menores, enquanto outros são maiores e oferecem mais espaço para atualizações e personalizações. <br> <br>

                                Em resumo, o gabinete é a estrutura que abriga e protege todos os componentes do seu computador, proporcionando um ambiente de resfriamento adequado e permitindo que você personalize o visual do seu PC. É como a "casa" onde tudo acontece no seu computador.</p>
                            </div>
                        </div>
                    </li>

                    <li>
                        <input type="checkbox" name="dropdown" id="cooler" >
                        <label for="cooler" class="dropdown-label"><h3 class='titulo_secao'> Para que serve um(a)  Cooler? </h3> </label>
                        <div class="content content-1">
                            <div>
                                <p>
                                Um cooler, também conhecido como ventoinha, é como o "ventilador" do seu computador. Sua principal função é manter os componentes internos do computador, como o processador, a placa de vídeo e a placa-mãe, resfriados. <br> <br>

                                À medida que o computador funciona, os componentes geram calor. Se o calor não for controlado, pode prejudicar o desempenho e até mesmo danificar os componentes. É aí que entra o cooler. Ele é responsável por dissipar o calor, movendo o ar dentro do gabinete do computador.<br> <br>

                                Os coolers podem estar localizados em diferentes partes do computador, como em cima do processador (cooler de CPU) ou nas laterais do gabinete. Alguns computadores também têm ventoinhas adicionais para um resfriamento mais eficaz.<br> <br>

                                Em resumo, um cooler é um componente importante para manter a temperatura interna do computador dentro de limites seguros, garantindo que todos os componentes funcionem corretamente e evitando danos causados pelo superaquecimento. É como o "ventilador" do seu computador.    
                                </p>
                            </div>
                        </div>
                    </li>

                    <li>
                        <input type="checkbox" name="dropdown" id="dissipadores-de-calor" >
                        <label for="dissipadores-de-calor" class="dropdown-label"><h3 class='titulo_secao'> Para que serve um(a)  Dissipadores de Calor? </h3> </label>
                        <div class="content content-1">
                            <div>
                                <p>
                                Um dissipador de calor, também chamado de "heat sink," é como o "resfriador passivo" do seu computador. Sua principal função é ajudar a dissipar o calor gerado por componentes eletrônicos, como o processador. <br> <br>

                                Quando os componentes eletrônicos, especialmente o processador, estão em funcionamento, eles geram calor. Um dissipador de calor é projetado para absorver esse calor e, em seguida, dispersá-lo no ambiente para mantê-los em uma temperatura segura de operação. <br> <br>

                                O dissipador de calor é frequentemente composto de materiais condutores de calor, como alumínio ou cobre, e possui uma superfície com muitas aletas. Quando o calor é gerado pelo componente eletrônico, o dissipador de calor absorve esse calor e as aletas aumentam a área de superfície para facilitar a dissipação térmica. Além disso, muitos dissipadores de calor são combinados com uma ventoinha (cooler) para aumentar a eficiência do resfriamento. <br> <br>

                                Em resumo, um dissipador de calor é um componente importante para manter os componentes eletrônicos do computador dentro das temperaturas de operação seguras, evitando o superaquecimento e garantindo que o computador funcione de maneira confiável. É como um "resfriador passivo" que ajuda a manter a temperatura dos componentes eletrônicos sob controle.
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>




<?php
        require "req_footer.php" 
?>

</body>
</html>