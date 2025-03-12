// Função para inserir o código HTML no elemento com id 'metodo_cartao'
document.querySelectorAll("[name='metodo']").forEach((input) =>{
    input.addEventListener("change", () => {
        document.querySelector("#btn_avancar").disabled=false;
        document.querySelector("#btn_avancar").classList.remove('btn_disabled');
        if(document.querySelector("#cartao").checked){
            const codigoHTML = `
            
            <div id='info_cartao'>
                <label for="num_cartao">Número do cartão:*</label>
                <input required onKeyPress="if(this.value.length==16) return false;" type='number' id='num_cartao' name='num_cartao' placeholder='1234123412341234'>
                <label for="cvv">CVV:*</label>
                <input required  type='number' id='cvv' name='cvv' placeholder='123'>
                <label for="titular">Titular do cartão:*</label>
                <input required  type='text' name='titular' id='titular' placeholder='João Silva'>
                <span>Vencimento do cartão</span>
                <label for="mes_validade">Mês:*</label>
                <select required id='mes_validade' name='mes_validade'>
                    <option value='1'>01</option>
                    <option value='2'>02</option>
                    <option value='3'>03</option>
                    <option value='4'>04</option>
                    <option value='5'>05</option>
                    <option value='6'>06</option>
                    <option value='7'>07</option>
                    <option value='8'>08</option>
                    <option value='9'>09</option>
                    <option value='10'>10</option>
                    <option value='11'>11</option>
                    <option value='12'>12</option>
                </select>
                <label for="ano_validade">Ano:*</label>
                <select required id='ano_validade' name='ano_validade'>
                    <option value='2024'>2024</option>
                    <option value='2025'>2025</option>
                    <option value='2026'>2026</option>
                    <option value='2027'>2027</option>
                    <option value='2028'>2028</option>
                    <option value='2029'>2029</option>
                    <option value='2030'>2030</option>
                    <option value='2031'>2031</option>
                    <option value='2032'>2032</option>
                    <option value='2033'>2033</option>
                    <option value='2034'>2034</option>
                </select>
            </div>
            `;
    
            const metodoCartaoElement = document.getElementById('metodo_cartao');
            metodoCartaoElement.insertAdjacentHTML('beforeend', codigoHTML);
        }else{
            const metodoCartaoElement = document.getElementById('metodo_cartao');
            const infoCartaoElement = document.getElementById('info_cartao');
    
            if (infoCartaoElement) {
                metodoCartaoElement.removeChild(infoCartaoElement);
            }
        }
        
    })
})

document.querySelector("#frm_pagamento").addEventListener("submit", ()=>{
    document.querySelector("#btn_avancar").disabled=true;
    document.querySelector("#btn_avancar").classList.add('btn_disabled')
})