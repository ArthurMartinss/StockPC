function verificarEnd(){

    const cep = document.querySelector("#cep");

    let ret = true;

    if(cep.value.length!=9){
        alert("CEP inválido!");
        ret = false;
    }
    if(!ret){
        return false;
    }

    return true;
}

const handleCEP = (event) => {
    let input = event.target;
    input.value = cepMask(input.value);
  };
  
  const cepMask = (value) => {
    if (!value) return "";
  
    // Remove all non-digit characters
    value = value.replace(/\D/g, "");
  
    // Insert a hyphen at the appropriate position
    value = value.replace(/^(\d{5})(\d)/, "$1-$2");
  
    return value;
  };

document.querySelector('#cep').addEventListener('input', ()=>{
    console.log("chamou a função")
    if(document.querySelector('#cep').value.length==9){
        document.querySelector('#cep').disbled = true
        document.querySelector('#logradouro').disabled = true
        document.querySelector('#cidade').disabled = true
        document.querySelector('#estados').disabled = true
        document.querySelector('#bairro').disabled = true
        document.querySelector('#complemento').disabled = true
        document.querySelector('#referencia').disabled = true
        document.querySelector('#numero').disabled = true

        completarEndereco()
    }

});

async function completarEndereco(){
    
        try {
            const response = await fetch('https://viacep.com.br/ws/'+document.querySelector('#cep').value.replace('-', '')+'/json/');
            
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
        
            const data = await response.json();
            
            document.querySelector('#logradouro').value = data.logradouro

            document.querySelector('#cidade').value = data.localidade

            for (var i = 0; i < document.querySelector('#estados').options.length; i++) {
                if (document.querySelector('#estados').options[i].value === data.uf) {
                    document.querySelector('#estados').options[i].selected = true;
                    break;
                }
            }

            document.querySelector('#bairro').value = data.bairro

            if(typeof data.referencia !== 'undefined')
            document.querySelector('#referencia').value = data.referencia
            
            document.querySelector('#numero').disabled = false
            document.querySelector('#numero').focus()
            

        } catch (error) {
            console.error('There was a problem with the fetch operation:', error);
            alert("CEP inválido!")
        }

        document.querySelector('#cep').disbled = false
        document.querySelector('#logradouro').disabled = false
        document.querySelector('#cidade').disabled = false
        document.querySelector('#estados').disabled = false
        document.querySelector('#bairro').disabled = false
        document.querySelector('#complemento').disabled = false
        document.querySelector('#referencia').disabled = false
        document.querySelector('#numero').disabled = false
    }
  
