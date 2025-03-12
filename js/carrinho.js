

/*async function alterarCarrinho(btn) {
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
        let vetorResposta = resposta.split("ªº")
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
        
        document.querySelector("#preco_"+id_anunc).innerHTML=numeroString(stringNumero(precoItem))
        document.querySelector("#preco_produtos").innerHTML=numeroString(stringNumero(precoProdutos))
        if (resposta){
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
*/
function atualizarPrecoFrete(){
  let valorFrete=0
  document.querySelectorAll("[type='radio']").forEach((radio) => {
    if(radio.checked){
      valorFrete+=stringNumero(document.querySelector("#"+radio.id.replace("frete", "preco")).innerHTML)
    }
  })
  document.querySelector("#preco_frete").innerHTML=numeroString(valorFrete);
}

function enviarFormulario(event){
  event.preventDefault()
  var form = document.querySelector("#form_frete");
  var radioGroups = {};
  // Iterate through all radio buttons in the form
  var radioButtons = form.querySelectorAll('input[type="radio"]');
  radioButtons.forEach(function(radioButton) {
      
          radioGroups[radioButton.name] = false;
      
  });
  radioButtons.forEach(function(radioButton) {
    if (radioButton.checked) {
        radioGroups[radioButton.name] = true;
    }
});

  for (var groupName in radioGroups) {
      if (radioGroups[groupName] === false) {
        alert("Selecione uma opção para todos os fretes.");
        return
      }
  }
  document.querySelector("#form_frete").submit()
}

function uncheckAllRadioButtons() {
  var radioButtons = document.querySelectorAll('input[type="radio"]');
  for (var i = 0; i < radioButtons.length; i++) {
      radioButtons[i].checked = false;
  }
}

window.onload = uncheckAllRadioButtons;