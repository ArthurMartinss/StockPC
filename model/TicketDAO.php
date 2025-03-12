<?php 
require_once('../bd/gerenciador_de_conexoes.php');
require_once('TicketDAO.php');

class TicketDAO{
    private $con;

    function __construct(){
        $this->con = GerenciadorDeConexoes::obter_conexao();
    }

    function inserir($ticket){
        $result = $this->con->query("INSERT INTO tickets (id_emissor, id_vendedor_anuncio, id_anuncio_report, id_compra_report, mensagem_emissor, mensagem_vendedor, anexo) VALUES ('" . $id_emissor() ."', '" . $id_vendedor_anuncio() . "', '" . $id_anuncio_report() . "', '" . $id_compra_report() . "', '" . $mensagem_emissor() . "', '" . $mensagem_vendedor() . "', '" . $anexo() . "')");

        if ($result->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function excluir($id){
        $result = $this->con->query("DELETE FROM tickets WHERE (id_ticket = '" . $id ."')");

        if ($result->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function obter($id){
        $result = $this->con->query("SELECT * FROM tickets WHERE (id_ticket = " . $id . ");");
        if ($result->rowCount() > 0){
            
            $row = $result->fetch(PDO::FETCH_ASSOC);

            $t = new Ticket();
            $t->set_id_ticket($row['id_ticket']);
            $t->set_id_emissor($row['id_emissor']);
            $t->set_id_vendedor_anuncio($row['id_vendedor_anuncio']);
            $t->set_id_anuncio_report($row('id_anuncio_report'));
            $t->set_id_compra_report($row['id_compra_report']);
            $t->set_mensagem_emissor($row['mensagem_emissor']);
            $t->set_mensagem_vendedor($row['mensagem_vendedor']);
            $t->set_anexo($row['set_anexo']);

            return $t;
        }
        else{
            return false;
        }
    }

    function obter_por_emissor($id){
        $result = $this->con->query("SELECT * FROM tickets WHERE (id_emissor = " . $id . ")");

        if ($result->rowCount() > 0){
            $row = $result->fetch(PDO::FETCH_ASSOC);

            $t = new Ticket();
            $t->set_id_ticket($row['id_ticket']);
            $t->set_id_emissor($row['id_emissor']);
            $t->set_id_vendedor_anuncio($row['id_vendedor_anuncio']);
            $t->set_id_anuncio_report($row('id_anuncio_report'));
            $t->set_id_compra_report($row['id_compra_report']);
            $t->set_mensagem_emissor($row['mensagem_emissor']);
            $t->set_mensagem_vendedor($row['mensagem_vendedor']);
            $t->set_anexo($row['set_anexo']);

            return $t;
        }
        else{
            return false;
        }
    }

    function obter_por_vendedor($id){
        $result = $this->con->query("SELECT * FROM tickets WHERE (id_vendedor_anuncio = " . $id . ")");

        if ($result->rowCount() > 0){
            $row = $result->fetch(PDO::FETCH_ASSOC);

            $t = new Ticket();
            $t->set_id_ticket($row['id_ticket']);
            $t->set_id_emissor($row['id_emissor']);
            $t->set_id_vendedor_anuncio($row['id_vendedor_anuncio']);
            $t->set_id_anuncio_report($row('id_anuncio_report'));
            $t->set_id_compra_report($row['id_compra_report']);
            $t->set_mensagem_emissor($row['mensagem_emissor']);
            $t->set_mensagem_vendedor($row['mensagem_vendedor']);
            $t->set_anexo($row['set_anexo']);

            return $t;
        }
        else{
            return false;
        }
    }
}
