function selecionarPeca(checkbox){
    let maxQuant=document.querySelector("#max_quant_anunc").value
    let quantAnunc = document.querySelector("#quant_anunc").value
    if(checkbox.checked){
        if(maxQuant==1||quantAnunc==0){
            document.querySelector("[name='id_anuncio_0']").value=checkbox.id.replace("check_", "")
            document.querySelector("[name='id_anuncio_0']").id="input_id_anuncio_"+checkbox.id.replace("check_", "")
            document.querySelectorAll("input[type='checkbox']").forEach(checkboxInput =>{
                checkboxInput.checked=false;
            })
            checkbox.checked=true;
            document.querySelector("#submit_avancar").value="Avançar"

            let indicePrecoAnuncio = '#'+checkbox.id.replace("check", "preco")
            document.querySelector("[name='preco_anunc_0']").value=stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML)
            document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal_inicial").value)+stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML))
            document.querySelector("#submit_avancar").disabled=!checkbox.checked
            document.querySelector("#submit_avancar").classList.remove("disabled_submit")
            document.querySelector("#quant_anunc").value=1
            document.querySelector("[name='preco_anunc_0']").id="preco_anunc_"+checkbox.id.replace("check_", "")
            document.querySelector("[name='quantidade_0']").id="quantidade_"+checkbox.id.replace("check_", "")

        }else{
            if(quantAnunc==maxQuant){
                checkbox.checked=false
                alert("Essa seleção excede o número máximo possível de peças dessa categoria na configuração atual. Para selecionar mais componentes desse tipo, deselecione um ou mais itens já selecionados.")
            }else{
                document.querySelector("#quant_anunc").value=parseInt(quantAnunc)+1
                quantAnunc=parseInt(quantAnunc)+1
                criarInputs(quantAnunc-1, checkbox.id.replace("check_", ""), "#prox_et")

                let indicePrecoAnuncio = '#'+checkbox.id.replace("check", "preco")
                document.querySelector("#preco_anunc_"+checkbox.id.replace("check_", "")).value=stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML)
                document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal").innerHTML)+stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML))
            }
        }

        
    }else{
        if(maxQuant==1||quantAnunc==1){
            document.querySelector("#input_id_anuncio_"+checkbox.id.replace("check_", "")).value=""
            document.querySelector("#input_id_anuncio_"+checkbox.id.replace("check_", "")).id="input_id_anuncio_0"
            document.querySelector("#submit_avancar").value="Selecione um produto"
            
            let indicePrecoAnuncio = '#'+checkbox.id.replace("check", "preco")
            document.querySelector("#preco_anunc_"+checkbox.id.replace("check_", "")).value-=stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML)

            document.querySelector("#subtotal").innerHTML=document.querySelector("#subtotal_inicial").value


            document.querySelector("#submit_avancar").disabled=!checkbox.checked
            document.querySelector("#submit_avancar").classList.add("disabled_submit")
            document.querySelector("#quant_anunc").value=0

            document.querySelector("#preco_anunc_"+checkbox.id.replace("check_", "")).id="preco_anunc_0"
            document.querySelector("#quantidade_"+checkbox.id.replace("check_", "")).id="quantidade_0"
        }else{
            removerInputs(checkbox.id.replace("check_", ""))

            let indicePrecoAnuncio = '#'+checkbox.id.replace("check", "preco")
            
            document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal").innerHTML)-stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML))
            
            document.querySelector("#quant_anunc").value=quantAnunc-1
        }
    }
    let indice = 0
    document.querySelectorAll(".id_anunc").forEach(input=>{
        let id=input.id.replace("input_id_anuncio_", "")
        console.log(id)
        input.name="id_anuncio_"+indice
        document.querySelector("#quantidade_"+id).name="quantidade_"+indice
        document.querySelector("#preco_anunc_"+id).name="preco_anunc_"+indice
        indice++
    })
}

function numeroString(n){
    let formattedNumber = n.toLocaleString('en-US', {
        style: 'decimal',
        useGrouping: true,
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
    
    return "R$ "+formattedNumber.replace(/\./g, ';').replace(/,/g, '.').replace(/;/g, ',');
}

function stringNumero(s){
    s = s.replace(/R\$/g, "").trim()
    if(s.includes(","))
        s = s.replace(/\./g, "")
    return parseFloat(s.replace(/,/g, "."))   
}

function criarInputs(name, id, parentId){
    // Create the input elements
    let inputIdAnuncio = document.createElement("input");
    inputIdAnuncio.type = "hidden";
    inputIdAnuncio.name = "id_anuncio_"+name;
    inputIdAnuncio.id = "input_id_anuncio_"+id;
    inputIdAnuncio.value = id;

    let inputQuantidade = document.createElement("input");
    inputQuantidade.type = "hidden";
    inputQuantidade.name = "quantidade_"+name;
    inputQuantidade.id = "quantidade_"+id;
    inputQuantidade.value = "1";

    let inputPrecoAnunc = document.createElement("input");
    inputPrecoAnunc.type = "hidden";
    inputPrecoAnunc.name = "preco_anunc_"+name;
    inputPrecoAnunc.id = "preco_anunc_"+id;
    inputPrecoAnunc.value = "0";

    // Find the element with the ID "preco_anunc_0"
    let parent = document.querySelector(parentId);

    // Append the created input elements after the target element
    parent.appendChild(inputIdAnuncio);
    parent.appendChild(inputQuantidade);
    parent.appendChild(inputPrecoAnunc);
}

function removerInputs(n){
    let inputIdAnuncio = document.getElementById("input_id_anuncio_"+n);
    let inputQuantidade = document.getElementById("quantidade_"+n);
    let inputPrecoAnunc = document.getElementById("preco_anunc_"+n);

    inputIdAnuncio.parentNode.removeChild(inputIdAnuncio);
    inputQuantidade.parentNode.removeChild(inputQuantidade);
    inputPrecoAnunc.parentNode.removeChild(inputPrecoAnunc);
}

function adicionar_ram(e){
    let idBtn = e.id
    let idAnunc = idBtn.replace(/adicionar_/g, "")

    let ramUsada = parseInt(document.querySelector("#ram_usada").innerHTML.replace("GB", "")) 
    let ramLimite = parseInt(document.querySelector("#capacidade_ram").innerHTML.replace("GB", "").replace("/", "")) 
    let slotsUsados = parseInt(document.querySelector("#slots_usados").innerHTML) 
    let limiteSlots = parseInt(document.querySelector("#slots_totais").innerHTML.replace("/", "")) 
    let thisRam = parseInt(document.querySelector("#ram_total_"+idAnunc).value)
    let thisPentes = parseInt(document.querySelector("#quantidade_pentes_"+idAnunc).value)

    if(((ramUsada+thisRam)>ramLimite)||((slotsUsados+thisPentes)>limiteSlots)){
        alert("Não é possível adicionar este item por exceder os limites presentes na configuração atual. Retire um ou mais itens da etapa atual ou altere as seleções das etapas anteriores caso persistir a necessidade de adição deste item.")
        return
    }
    
    document.querySelector("#ram_usada").innerHTML=(ramUsada+thisRam)+"GB"
    document.querySelector("#slots_usados").innerHTML=slotsUsados+thisPentes

    if((document.querySelector("#ram_usada").innerHTML==ramLimite) || (document.querySelector("#slots_usados").innerHTML==limiteSlots)){
        document.querySelectorAll(".btn_adicionar").forEach(btn => {
            btn.disabled=true
            btn.classList.add('disabled')
        });
    }

    if(document.querySelector("#input_id_anuncio_0")){
        document.querySelector("#input_id_anuncio_0").value=idAnunc
        document.querySelector("#input_id_anuncio_0").id="input_id_anuncio_"+idAnunc

        let indicePrecoAnuncio = '#'+idBtn.replace("adicionar", "preco")
        document.querySelector("#preco_anunc_0").value=stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML)
        document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal_inicial").value)+stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML))
        document.querySelector("#submit_avancar").value="Avançar"
        document.querySelector("#submit_avancar").disabled=false
        document.querySelector("#submit_avancar").classList.remove("disabled_submit")
        document.querySelector("#quant_anunc").value=1
        document.querySelector("#preco_anunc_0").id="preco_anunc_"+idAnunc
        document.querySelector("#quantidade_0").id="quantidade_"+idAnunc
    }else if(document.querySelector("#input_id_anuncio_"+idAnunc)){
        document.querySelector("#quantidade_"+idAnunc).value=parseInt(document.querySelector("#quantidade_"+idAnunc).value)+1
        document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal").innerHTML)+stringNumero(document.querySelector("#preco_anunc_"+idAnunc).value))
    }else{
        document.querySelector("#quant_anunc").value=parseInt(document.querySelector("#quant_anunc").value)+1
        quantAnunc=document.querySelector("#quant_anunc").value
        criarInputs(quantAnunc-1, idAnunc, "#prox_et")

        let indicePrecoAnuncio = '#'+e.id.replace("adicionar", "preco")
        document.querySelector("#preco_anunc_"+idAnunc).value=stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML)
        document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal").innerHTML)+stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML))
    }
    document.querySelector("#retirar_"+idAnunc).disabled=false
    document.querySelector("#retirar_"+idAnunc).style.opacity=1
    document.querySelector("#retirar_"+idAnunc).classList.remove('disabled')

    if(document.querySelector("#estoque_"+idAnunc).value<=document.querySelector("#quantidade_"+idAnunc).value){
        e.disabled=true
        e.classList.add('disabled')
    }
        
    
}

function retirar_ram(e){
    let idBtn = e.id
    let idAnunc = idBtn.replace(/retirar_/g, "")

    let ramUsada = parseInt(document.querySelector("#ram_usada").innerHTML.replace("GB", "")) 
    let ramLimite = parseInt(document.querySelector("#capacidade_ram").innerHTML.replace("GB", "").replace("/", "")) 
    let slotsUsados = parseInt(document.querySelector("#slots_usados").innerHTML) 
    let limiteSlots = parseInt(document.querySelector("#slots_totais").innerHTML.replace("/", "")) 
    let thisRam = parseInt(document.querySelector("#ram_total_"+idAnunc).value)
    let thisPentes = parseInt(document.querySelector("#quantidade_pentes_"+idAnunc).value)

    document.querySelector("#ram_usada").innerHTML=(ramUsada-thisRam)+"GB"
    document.querySelector("#slots_usados").innerHTML=slotsUsados-thisPentes

    document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal").innerHTML)-document.querySelector("#preco_anunc_"+idAnunc).value)

    if(document.querySelector("#quant_anunc").value==1){
        if(document.querySelector("#quantidade_"+idAnunc).value==1){
            document.querySelector("#input_id_anuncio_"+idAnunc).value=""
            document.querySelector("#input_id_anuncio_"+idAnunc).id="input_id_anuncio_0"
            document.querySelector("#submit_avancar").value="Selecione um produto"
            document.querySelector("#submit_avancar").disabled=true
            document.querySelector("#submit_avancar").classList.add("disabled_submit")

            document.querySelector("#preco_anunc_"+idAnunc).value=0
            document.querySelector("#preco_anunc_"+idAnunc).id="preco_anunc_0"

            document.querySelector("#quant_anunc").value=0

            document.querySelector("#quantidade_"+idAnunc).value=1
            document.querySelector("#quantidade_"+idAnunc).id="quantidade_0"

            e.classList.add("disabled")
            e.style.opacity=0
            e.disabled=true

        }else{
            document.querySelector("#quantidade_"+idAnunc).value=parseInt(document.querySelector("#quantidade_"+idAnunc).value)-1
        }
    }else{
        if(document.querySelector("#quantidade_"+idAnunc).value==1){
            removerInputs(idAnunc)

            document.querySelector("#quant_anunc").value=parseInt(document.querySelector("#quant_anunc").value)-1

            e.classList.add("disabled")
            e.style.opacity=0
            e.disabled=true

        }else{
            document.querySelector("#quantidade_"+idAnunc).value=parseInt(document.querySelector("#quantidade_"+idAnunc).value)-1
        }
    }
    /*if(ramUsada==ramLimite||slotsUsados==limiteSlots){*/
    document.querySelectorAll(".btn_adicionar").forEach(btn => {
        if(document.querySelector("#quantidade_"+btn.id.replace(/adicionar_/g, ""))){
            if(document.querySelector("#estoque_"+btn.id.replace(/adicionar_/g, "")).value>document.querySelector("#quantidade_"+btn.id.replace(/adicionar_/g, "")).value){
                btn.disabled=false
                btn.classList.remove('disabled')
            }
        }else{
            btn.disabled=false
            btn.classList.remove('disabled')
        }
    });
    /*}*/
    const hiddenInputs = document.querySelector("#prox_et").querySelectorAll('input[type="hidden"]');
    let num_id = 0
    let num_quantidade = 0
    let num_preco = 0
    hiddenInputs.forEach(function(input) {
        // Check if the name attribute contains the specified string
        if (input.getAttribute('name').includes("id_anuncio")) {
            input.name="id_anuncio_"+num_id
            num_id++
        }else if(input.getAttribute('name').includes("quantidade_")){
            input.name="quantidade_"+num_quantidade
            num_quantidade++
        }else if(input.getAttribute('name').includes("preco_anunc")){
            input.name="preco_anunc_"+num_preco
            num_preco++
        }
    });
    
}

function adicionar_armazenamento(e){
    let idBtn = e.id
    let idAnunc = idBtn.replace(/adicionar_/g, "")

    let thisSlot = document.querySelector("#barramento_encaixe_armazenamento_"+idAnunc).value
    let limite = parseInt(document.querySelector("#limite_barramentos_"+thisSlot).innerHTML.replace("/", "")) 
    let usados = parseInt(document.querySelector("#barramentos_"+thisSlot+"_usados").innerHTML) 

    document.querySelector("#barramentos_"+thisSlot+"_usados").innerHTML=usados+1
    usados++

    if(limite == usados){
        document.querySelectorAll(".btn_adicionar").forEach(btn => {
            if(document.querySelector("#barramento_encaixe_armazenamento_"+btn.id.replace(/adicionar_/g, "")).value==thisSlot){
                btn.disabled=true
                btn.classList.add('disabled')
            }
        });
    }

    if(document.querySelector("#input_id_anuncio_0")){
        document.querySelector("#input_id_anuncio_0").value=idAnunc
        document.querySelector("#input_id_anuncio_0").id="input_id_anuncio_"+idAnunc

        let indicePrecoAnuncio = '#'+idBtn.replace("adicionar", "preco")
        document.querySelector("#preco_anunc_0").value=stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML)
        document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal_inicial").value)+stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML))
        document.querySelector("#submit_avancar").value="Avançar"
        document.querySelector("#submit_avancar").disabled=false
        document.querySelector("#submit_avancar").classList.remove("disabled_submit")
        document.querySelector("#quant_anunc").value=1
        document.querySelector("#preco_anunc_0").id="preco_anunc_"+idAnunc
        document.querySelector("#quantidade_0").id="quantidade_"+idAnunc
    }else if(document.querySelector("#input_id_anuncio_"+idAnunc)){
        document.querySelector("#quantidade_"+idAnunc).value=parseInt(document.querySelector("#quantidade_"+idAnunc).value)+1
        document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal").innerHTML)+stringNumero(document.querySelector("#preco_anunc_"+idAnunc).value))
    }else{
        document.querySelector("#quant_anunc").value=parseInt(document.querySelector("#quant_anunc").value)+1
        quantAnunc=document.querySelector("#quant_anunc").value
        criarInputs(quantAnunc-1, idAnunc, "#prox_et")

        let indicePrecoAnuncio = '#'+e.id.replace("adicionar", "preco")
        document.querySelector("#preco_anunc_"+idAnunc).value=stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML)
        document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal").innerHTML)+stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML))
    }
    document.querySelector("#retirar_"+idAnunc).disabled=false
    document.querySelector("#retirar_"+idAnunc).style.opacity=1
    document.querySelector("#retirar_"+idAnunc).classList.remove('disabled')

    console.log(`ID: ${idAnunc}; Estoque: ${document.querySelector("#estoque_"+idAnunc).value}; Quantidade: ${document.querySelector("#quantidade_"+idAnunc).value}`)
    if(parseInt(document.querySelector("#estoque_"+idAnunc).value)<=parseInt(document.querySelector("#quantidade_"+idAnunc).value)){
        console.log("Disabled.")
        e.disabled=true
        e.classList.add('disabled')
    }
}

function retirar_armazenamento(e){
    let idBtn = e.id
    let idAnunc = idBtn.replace(/retirar_/g, "")

    let thisSlot = document.querySelector("#barramento_encaixe_armazenamento_"+idAnunc).value
    let limite = parseInt(document.querySelector("#limite_barramentos_"+thisSlot).innerHTML.replace("/", "")) 
    let usados = parseInt(document.querySelector("#barramentos_"+thisSlot+"_usados").innerHTML) 

    document.querySelector("#barramentos_"+thisSlot+"_usados").innerHTML=usados-1

    document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal").innerHTML)-document.querySelector("#preco_anunc_"+idAnunc).value)

    if(document.querySelector("#quant_anunc").value==1){
        if(document.querySelector("#quantidade_"+idAnunc).value==1){
            document.querySelector("#input_id_anuncio_"+idAnunc).value=""
            document.querySelector("#input_id_anuncio_"+idAnunc).id="input_id_anuncio_0"
            document.querySelector("#submit_avancar").value="Selecione um produto"
            document.querySelector("#submit_avancar").disabled=true
            document.querySelector("#submit_avancar").classList.add("disabled_submit")

            document.querySelector("#preco_anunc_"+idAnunc).value=0
            document.querySelector("#preco_anunc_"+idAnunc).id="preco_anunc_0"

            document.querySelector("#quant_anunc").value=0

            document.querySelector("#quantidade_"+idAnunc).value=1
            document.querySelector("#quantidade_"+idAnunc).id="quantidade_0"

            e.classList.add("disabled")
            e.style.opacity=0
            e.disabled=true

        }else{
            document.querySelector("#quantidade_"+idAnunc).value=parseInt(document.querySelector("#quantidade_"+idAnunc).value)-1
        }
    }else{
        if(document.querySelector("#quantidade_"+idAnunc).value==1){
            removerInputs(idAnunc)

            document.querySelector("#quant_anunc").value=parseInt(document.querySelector("#quant_anunc").value)-1

            e.classList.add("disabled")
            e.style.opacity=0
            e.disabled=true

        }else{
            document.querySelector("#quantidade_"+idAnunc).value=parseInt(document.querySelector("#quantidade_"+idAnunc).value)-1
        }
    }

    /*if(limite == usados){*/
    document.querySelectorAll(".btn_adicionar").forEach(btn => {
        if((document.querySelector("#barramento_encaixe_armazenamento_"+btn.id.replace(/adicionar_/g, "")).value==thisSlot)){
            if(document.querySelector("#quantidade_"+btn.id.replace(/adicionar_/g, ""))){
                if(parseInt(document.querySelector("#estoque_"+btn.id.replace(/adicionar_/g, "")).value)>parseInt(document.querySelector("#quantidade_"+btn.id.replace(/adicionar_/g, "")).value)){
                    btn.disabled=false
                    btn.classList.remove('disabled')
                }
            }else{
                btn.disabled=false
                btn.classList.remove('disabled')
            }
        }
    });
    /*}*/
    const hiddenInputs = document.querySelector("#prox_et").querySelectorAll('input[type="hidden"]');
    let num_id = 0
    let num_quantidade = 0
    let num_preco = 0
    hiddenInputs.forEach(function(input) {
        // Check if the name attribute contains the specified string
        if (input.getAttribute('name').includes("id_anuncio")) {
            input.name="id_anuncio_"+num_id
            num_id++
        }else if(input.getAttribute('name').includes("quantidade_")){
            input.name="quantidade_"+num_quantidade
            num_quantidade++
        }else if(input.getAttribute('name').includes("preco_anunc")){
            input.name="preco_anunc_"+num_preco
            num_preco++
        }
    });

    
}

function adicionar_generico(btn){
    let idBtn = btn.id
    let idAnunc = idBtn.replace(/adicionar_/g, "")


    if(document.querySelector("#input_id_anuncio_0")){
        document.querySelector("#input_id_anuncio_0").value=idAnunc
        document.querySelector("#input_id_anuncio_0").id="input_id_anuncio_"+idAnunc

        let indicePrecoAnuncio = '#'+idBtn.replace("adicionar", "preco")
        document.querySelector("#preco_anunc_0").value=stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML)
        document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal_inicial").value)+stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML))
        document.querySelector("#submit_avancar").value="Avançar"
        document.querySelector("#submit_avancar").disabled=false
        document.querySelector("#submit_avancar").classList.remove("disabled_submit")
        document.querySelector("#quant_anunc").value=1
        document.querySelector("#preco_anunc_0").id="preco_anunc_"+idAnunc
        document.querySelector("#quantidade_0").id="quantidade_"+idAnunc
    }else if(document.querySelector("#input_id_anuncio_"+idAnunc)){
        document.querySelector("#quantidade_"+idAnunc).value=parseInt(document.querySelector("#quantidade_"+idAnunc).value)+1
        document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal").innerHTML)+stringNumero(document.querySelector("#preco_anunc_"+idAnunc).value))
    }else{
        document.querySelector("#quant_anunc").value=parseInt(document.querySelector("#quant_anunc").value)+1
        quantAnunc=document.querySelector("#quant_anunc").value
        criarInputs(quantAnunc-1, idAnunc, "#prox_et")

        let indicePrecoAnuncio = '#'+btn.id.replace("adicionar", "preco")
        document.querySelector("#preco_anunc_"+idAnunc).value=stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML)
        document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal").innerHTML)+stringNumero(document.querySelector(indicePrecoAnuncio).innerHTML))
    }
    document.querySelector("#retirar_"+idAnunc).disabled=false
    document.querySelector("#retirar_"+idAnunc).style.opacity=1
    document.querySelector("#retirar_"+idAnunc).classList.remove('disabled')

    console.log(`ID: ${idAnunc}; Estoque: ${document.querySelector("#estoque_"+idAnunc).value}; Quantidade: ${document.querySelector("#quantidade_"+idAnunc).value}`)
    if(parseInt(document.querySelector("#estoque_"+idAnunc).value)<=parseInt(document.querySelector("#quantidade_"+idAnunc).value)){
        console.log("Disabled.")
        btn.disabled=true
        btn.classList.add('disabled')
    }
}

function retirar_generico(btn){
    let idBtn = btn.id
    let idAnunc = idBtn.replace(/retirar_/g, "")

    document.querySelector("#subtotal").innerHTML=numeroString(stringNumero(document.querySelector("#subtotal").innerHTML)-document.querySelector("#preco_anunc_"+idAnunc).value)
    
    if(document.querySelector("#quant_anunc").value==1){
        if(document.querySelector("#quantidade_"+idAnunc).value==1){
            document.querySelector("#input_id_anuncio_"+idAnunc).value=""
            document.querySelector("#input_id_anuncio_"+idAnunc).id="input_id_anuncio_0"
            document.querySelector("#submit_avancar").value="Selecione um produto"
            document.querySelector("#submit_avancar").disabled=true
            document.querySelector("#submit_avancar").classList.add("disabled_submit")

            document.querySelector("#preco_anunc_"+idAnunc).value=0
            document.querySelector("#preco_anunc_"+idAnunc).id="preco_anunc_0"

            document.querySelector("#quant_anunc").value=0

            document.querySelector("#quantidade_"+idAnunc).value=1
            document.querySelector("#quantidade_"+idAnunc).id="quantidade_0"

            btn.classList.add("disabled")
            btn.style.opacity=0
            btn.disabled=true

        }else{
            document.querySelector("#quantidade_"+idAnunc).value=parseInt(document.querySelector("#quantidade_"+idAnunc).value)-1
        }
    }else{
        if(document.querySelector("#quantidade_"+idAnunc).value==1){
            removerInputs(idAnunc)

            document.querySelector("#quant_anunc").value=parseInt(document.querySelector("#quant_anunc").value)-1

            btn.classList.add("disabled")
            btn.style.opacity=0
            btn.disabled=true

        }else{
            document.querySelector("#quantidade_"+idAnunc).value=parseInt(document.querySelector("#quantidade_"+idAnunc).value)-1
        }
    }

    document.querySelector("#adicionar_"+idAnunc).disabled=false
    document.querySelector("#adicionar_"+idAnunc).classList.remove('disabled')
        
    if(document.querySelector("#quant_anunc").value==1){
        const hiddenInputs = document.querySelector("#prox_et").querySelectorAll('input[type="hidden"]');
    
        hiddenInputs.forEach(function(input) {
            // Check if the name attribute contains the specified string
            if (input.getAttribute('name').includes("id_anuncio")) {
                input.name="id_anuncio_0";
            }else if(input.getAttribute('name').includes("quantidade_")){
                input.name="quantidade_0";
            }else if(input.getAttribute('name').includes("preco_anunc")){
                input.name="preco_anunc_0";
            }
        });

    }
}