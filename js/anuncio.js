if(document.querySelector('#btn_alterar')){
    document.querySelector('#btn_alterar').addEventListener('click', (event)=>{
        event.preventDefault()
        document.querySelector("#sua_avaliacao").style.display='none'
        document.querySelector("#editar_avaliacao").style.display='block'
    })
}

if(document.querySelector('#btn_cancelar')){
    document.querySelector('#btn_cancelar').addEventListener('click', (event)=>{
        event.preventDefault()
        document.querySelector("#editar_avaliacao").style.display='none'
        document.querySelector("#sua_avaliacao").style.display='block'
    })
}