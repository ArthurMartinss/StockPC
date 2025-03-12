document.getElementById("botao").onclick=async (e)=>{
    
    e.preventDefault();

    if(document.querySelector("#input_codigo").value.length != 6){
        alert("Insira seis digítos no campo!")
    }else{
        if(await verificarEmailBd(document.querySelector("#input_codigo").value)){
            document.querySelector("#form_confirmacao").submit()
        }
    }

}

document.getElementById("reenviar").onclick=async (e)=>{
    
    e.preventDefault();

    if(await verificarEmailBd(0, "reenviar")){
        alert("Outro código foi enviado para o email fornecido.")
    }
    
}

async function verificarEmailBd(codigo, reenviar="") {
    let httpRequest = new XMLHttpRequest();
    let url
    if(reenviar == ""){
        url = "https://stockpc.store/controller/ajax_confirmar_email.php?codigo=" + codigo;
    }else{
        url = "https://stockpc.store/controller/ajax_confirmar_email.php?reenviar";
    }
     
  
    let promise = new Promise((resolve, reject) => {
      httpRequest.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          let resposta = this.responseText;
          console.log(`resposta: ${resposta}`);
          if (resposta == "erro") {
            document.querySelector("#p_mensagem").innerHTML="Código incorreto. Um envio restante.";
            alert("Código incorreto. Um envio restante.");
            resolve(false);
          }else if(resposta == "confirmado"||resposta == "reenviado"){
            resolve(true);
          }else if(resposta=="fim"){
            window.location.href = "https://stockpc.store/view/cadastro_inicio.php";
            resolve(false)
          }
        }
      };
    });
  
    httpRequest.open("GET", url, true);
    httpRequest.send();
  
    let corres = await promise;
    return corres;
  }
