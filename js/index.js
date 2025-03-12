document.querySelector("#lupa").addEventListener("click", (event)=>{
  event.preventDefault
  if(document.querySelector("#busca").value==""){
    return false
  }

  document.querySelector("#frm_busca").submit()
})

function pagAnunc(e){
    let id =""
    let element = e.target
    if(element.nodeName=="INPUT"||element.nodeName=="BUTTON"){
        return
    }
    if(element.nodeName=="FORM"||element.nodeName=="SPAN"||element.className=="img_anunc"){
        id = element.parentNode.id.split('_')[0]
    }else if(element.nodeName=="IMG"){
        id = element.parentNode.parentNode.id.split('_')[0]
    }else if(element.nodeName=="DIV"){    
        id = element.id.split('_')[0]
    }else{
        id = element.id.split('_')[0]
    }
    console.log(id)
    if(id!="")
        window.location.href = "anuncio.php?id_anunc="+id;
}

async function alterarCarrinho(btn){
    let operacao = btn.id.split("_")[0];
    let id_anunc = btn.id.split("_")[1];
    let  config=""
    if(btn.classList.contains('config'))
      config="&config='true'"
    let httpRequest = new XMLHttpRequest();
    let url = "https://stockpc.store/controller/ajax_alterar_carrinho.php?operacao="+operacao+"&id_anunc="+id_anunc+config;  
    let promise = new Promise((resolve, reject) => {
      httpRequest.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          let resposta = this.responseText
          console.log(resposta)
          if (resposta){
            if(operacao=="inserir"||operacao=="retirar"){
              if(resposta=="alert"){
                if(operacao=='inserir'){
                  alert("Produto já se encontra no carrinho!")
                }else{
                  alert("Produto não se encontra no carrinho!")
                }
              }else{
                document.querySelector("#itens_carrinho").innerHTML=resposta
                document.querySelector("#itens_carrinho").style.opacity = (resposta==0)?(0):(1)
    
                if (operacao == 'inserir') {
                  btn.innerHTML = '<i class="bi bi-cart-x-fill"></i>';
                  btn.id = "retirar_" + id_anunc;
                  btn.classList.remove("btn_adc_carrinho");
                  btn.classList.add("retirar_carrinho");
                } else {
                  btn.innerHTML = '<i class="bi bi-cart-plus-fill"></i>';
                  btn.id = "inserir_" + id_anunc;
                  btn.classList.remove("retirar_carrinho");
                  btn.classList.add("btn_adc_carrinho");
                }
                
              }
            } else if(operacao=="adicionar"||operacao=="subtrair"){
              let vetorResposta = resposta.split("ªº")
              console.log(vetorResposta)
              let quantidade = vetorResposta[0]
              let precoItem = vetorResposta[1]
              let precoProdutos = vetorResposta[2]
              if(typeof vetorResposta[3] !== undefined){
                let range = document.createRange();
                let str_frete = range.createContextualFragment(vetorResposta[3]);
                document.querySelector("#fretes").parentNode.removeChild(document.querySelector("#fretes"))
                document.querySelector("#endereco").parentNode.insertBefore(str_frete, document.querySelector("#endereco").nextSibling);
                document.querySelector("#preco_frete").innerHTML="R$ -";
              }
              
              document.querySelector("#preco_"+id_anunc).innerHTML=numeroString(stringNumero(precoItem))//************************ */
              document.querySelector("#preco_produtos").innerHTML=numeroString(stringNumero(precoProdutos))//***************** */
              console.log("return true!");
              console.log(id_anunc);
              document.querySelector("#subtrair_"+id_anunc).disabled=false
              document.querySelector("#subtrair_"+id_anunc).classList.remove("btn_disabled")
              document.querySelector("#adicionar_"+id_anunc).disabled=false
              document.querySelector("#adicionar_"+id_anunc).classList.remove("btn_disabled")

              if(quantidade<=1){
                document.querySelector("#subtrair_"+id_anunc).disabled=true
                document.querySelector("#subtrair_"+id_anunc).classList.add("btn_disabled")
              }
              
              let estoque = ((config=='')?(sessionData[id_anunc]['estoque']):(sessionData['config'][id_anunc]['estoque']))
              if(quantidade>=estoque){
                document.querySelector("#adicionar_"+id_anunc).disabled=true
                document.querySelector("#adicionar_"+id_anunc).classList.add("btn_disabled")
              }
              if(config!=""){
                sessionData['config'][id_anunc]['quantidade']=quantidade
              }else{
                sessionData[id_anunc]['quantidade']=quantidade
              }
              document.querySelector("#quantidade_"+id_anunc).innerHTML=quantidade
            }
            resolve(true);
          } else {
            console.log("return false!");
            resolve(false);
          }
        }
      };
    });
  
    httpRequest.open("GET", url, true);
    httpRequest.send();
  
    let res = await promise;
    return res;

   
}

// window.onscroll = function() {
//   mostrarOcultarBotao();
// };

// function mostrarOcultarBotao() {
//   var botaoTopo = document.getElementById("botao-topo");
//   if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
//       botaoTopo.style.opacity = "1";
//   } else {
//       botaoTopo.style.opacity = "0";
//   }
// }

// // Função para rolar suavemente para o topo da página
// function scrollParaOTopo() {
//   document.body.scrollTop = 0;
//   document.documentElement.scrollTop = 0;
// }


// RANGE PREÇO FILTRO 

const rangeInput = document.querySelectorAll(".range-input input"),
priceInput = document.querySelectorAll(".price-input input"),
range = document.querySelector(".slider .progress");
let priceGap = 25;
priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);
        
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});
rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let absMin = parseInt(rangeInput[0].min)
        let absMax = parseInt(rangeInput[1].max)
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);
        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = (((minVal-absMin) / (absMax-absMin)) * 100) + "%";
            range.style.right = 100 - ((maxVal-absMin) / (absMax-absMin)) * 100 + "%";
        }
    });
});

// Reconhece a url e adiciona o active-categorias na classe do botao

  // Obtém a URL atual
  const currentURL = window.location.href;

  // Captura todos os elementos <a> com a classe 'nav-link'
  const links = document.querySelectorAll('.nav-link');

  // Itera sobre os links para verificar se a URL contém a parte 'categoria=' ou é 'index.php'
  links.forEach(link => {
    // Obtém a URL do link atual no loop
    const linkURL = link.href;

    // Verifica se a URL do link contém 'categoria=' ou é 'index.php'
    if (linkURL.includes('categoria=') || linkURL.endsWith('index.php')) {
      // Obtém o valor da categoria na URL atual
      const urlParams = new URLSearchParams(window.location.search);
      const categoriaParam = urlParams.get('categoria');

      // Obtém o valor da categoria no link
      const linkParams = new URLSearchParams(linkURL.split('?')[1]);
      const linkCategoriaParam = linkParams.get('categoria');

      // Verifica se a categoria na URL atual corresponde à categoria no link
      if (categoriaParam === linkCategoriaParam) {
        // Adiciona a classe 'active-categorias' ao link correspondente
        link.classList.add('active-categorias');
      }
    }
  });

  
  function checkScreenWidth() {
    const screenWidth = window.innerWidth;

    // Seleciona o elemento <a> com a classe 'btn-sidebar'
    const btn = document.querySelector('.btn-sidebar');

    // Verifica se a largura da tela é menor que 667 pixels
    if (screenWidth < 667) {
      // Adiciona o atributo href ao elemento <a>
      btn.setAttribute('href', '#subirfiltro');
    } else {
      // Remove o atributo href se a largura da tela for maior ou igual a 667 pixels
      btn.removeAttribute('href');
    }
  }

  // Verifica a largura da tela quando a página é carregada
  checkScreenWidth();

  // Adiciona um ouvinte de evento de redimensionamento da janela
  window.addEventListener('resize', checkScreenWidth);