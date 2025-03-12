function verificarTipo(select){
    console.log("entrou")
    let selectBarramento = document.querySelector("#barramento_encaixe_armazenamento")
    let standardOption = document.querySelector("#standard_option")
    while (selectBarramento.firstChild) {
        if(selectBarramento.lastChild.id=="standard_option")
            break
            selectBarramento.removeChild(selectBarramento.lastChild);
    }
    selectBarramento.value=""
    selectBarramento.disabled=false
    if(select.value=="HD"){
        standardOption.innerHTML = "Selecione uma opção"

        let optionPata = document.createElement("option")
        optionPata.value = "pata"
        optionPata.innerHTML = "PATA"

        let optionSata = document.createElement("option")
        optionSata.value = "sata"
        optionSata.innerHTML = "SATA"

        selectBarramento.appendChild(optionPata)
        selectBarramento.appendChild(optionSata)

    }else if(select.value=="SSD"){
        standardOption.innerHTML = "Selecione uma opção"

        let optionSata = document.createElement("option")
        optionSata.value = "sata"
        optionSata.innerHTML = "SATA"

        let optionM2Sata = document.createElement("option")
        optionM2Sata.value = "m2_sata"
        optionM2Sata.innerHTML = "M.2 tipo SATA (B + M Key)"

        let optionNvme = document.createElement("option")
        optionNvme.value = "m2_nvme"
        optionNvme.innerHTML = "M.2 tipo NVMe (M Key)"

        selectBarramento.appendChild(optionSata)
        selectBarramento.appendChild(optionM2Sata)
        selectBarramento.appendChild(optionNvme)
    }else{
        selectBarramento.disabled=true
        standardOption.innerHTML = "Selecione o tipo de armazenamento primeiro"
    }
}

function verificarProcessador(select) {
    console.log("entrou")
    let selectProcessador = document.querySelector("#linha");
    let standardOptionProcessador = document.querySelector("#standard_option_processador");

    while (selectProcessador.firstChild) {
        if (selectProcessador.lastChild.id == "standard_option_processador")
            break;
        selectProcessador.removeChild(selectProcessador.lastChild);
    }

    selectProcessador.value = "";
    selectProcessador.disabled = false;

    if (select.value == "AMD") {
        standardOptionProcessador.innerHTML = "Selecione uma opção";

        addOption(selectProcessador, "ryzen 3", "Ryzen 3");
        addOption(selectProcessador, "ryzen 5", "Ryzen 5");
        addOption(selectProcessador, "ryzen 7", "Ryzen 7");
        addOption(selectProcessador, "ryzen 9", "Ryzen 9");

    } else if (select.value == "Intel") {
        standardOptionProcessador.innerHTML = "Selecione uma opção";

        addOption(selectProcessador, "athlon", "Athlon");
        addOption(selectProcessador, "atom", "Atom");
        addOption(selectProcessador, "Celeron", "Celeron");
        addOption(selectProcessador, "pentium", "Pentium");
        addOption(selectProcessador, "i3", "Core i3");
        addOption(selectProcessador, "i5", "Core i5");
        addOption(selectProcessador, "i7", "Core i7");
        addOption(selectProcessador, "i9", "Core i9");

    } else {
        selectProcessador.disabled = true;
        standardOptionProcessador.innerHTML = "Selecione a fabricante do processador primeiro";
    }
}

function addOption(select, value, text) {
    let option = document.createElement("option");
    option.value = value;
    option.innerHTML = text;
    select.appendChild(option);
}

document.querySelector("#tipo_armazenamento").addEventListener("onclick",(e)=>{
    console.log("onclick")
})

function alterarPentes(checkbox){
    if(checkbox.checked){
        document.querySelector("#div_quant_pentes").style.display='block';
        document.querySelector("#pentes").value='';
    }else{
        
        document.querySelector("#div_quant_pentes").style.display='none';
        document.querySelector("#pentes").value=1;
    }
}


function removerCaracteres(event) {
    // Define the disallowed character
    const disallowedChars = ['-', '_', ' '];

    // Get the input value
    const inputValue = event.target.value;

    // Check if the disallowed character is present
    for(let disallowedChar of disallowedChars){

        if (inputValue.includes(disallowedChar)) {
        // Remove the disallowed character from the input value
        const sanitizedValue = inputValue.replace(disallowedChar, '');
        
        // Update the input field with the sanitized value
        event.target.value = sanitizedValue;

        }
    }
  }