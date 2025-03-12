<?php 
Class TicketDAO{
    private $id_ticket;
    private $id_emissor;
    private $id_vendedor_anuncio;
    private $id_anuncio_report;
    private $id_compra_report;
    private $mensagem_emissor;
    private $mensagem_vendedor;
    private $anexo;

    function set_id_ticket($id_ticket){
        $this->id_ticket = $id_ticket;
    }

    function get_id_ticket(){
        return $this->id_ticket;
    }

    function set_id_emissor($id_emissor){
        $this->id_emissor = $id_emissor;
    }

    function get_id_emissor(){
        return $this->id_emissor;
    }

    function set_id_vendedor_anuncio($id_vendedor_anuncio){
        $this->id_vendedor_anuncio = $id_vendedor_anuncio;
    }

    function get_id_vendedor_anuncio(){
        return $this->id_vendedor_anuncio;
    }

    function set_id_anuncio_report($id_anuncio_report){
        $this->id_anuncio_report = $id_anuncio_report;
    }

    function get_id_anuncio_report(){
        return $this->id_anuncio_report;
    }

    function set_id_compra_report($id_compra_report){
        $this->set_id_compra_report = $id_anuncio_report;
    }

    function get_id_compra_report(){
        return $this->id_compra_report;
    }

    function set_mensagem_emissor($mensagem_emissor){
        $this->set_mensagem_emissor = $mensagem_emissor;
    }

    function get_mensagem_emissor(){
        return $this->mensagem_emissor;
    }

    function set_mensagem_vendedor($mensagem_vendedor){
        $this->set_mensagem_vendedor = $mensagem_vendedor;
    }

    function get_mensagem_vendedor(){
        return $this->mensagem_vendedor;
    }

    function set_anexo($anexo){
        $this->anexo = $anexo;
    }

    function get_anexo(){
        return $this->anexo;
    }
}
?>
