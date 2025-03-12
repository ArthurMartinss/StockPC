<?php 
require_once('../bd/gerenciador_de_conexoes.php');
require_once('MelhorEnvioDTO.php');

class MelhorEnvioDAO{
    private $con;

    function __construct(){
        $this->con = GerenciadorDeConexoes::obter_conexao();
    }

    function alterar($ME){
        $result = $this->con->query("UPDATE melhorenvio SET token = '" . $ME->get_token() . "', refresh = '" . $ME->get_refresh() . "' WHERE id = 1 ");

        if ($result->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    function obter(){
        $result = $this->con->query("SELECT * FROM melhorenvio WHERE (id = 1);");
        if ($result->rowCount() > 0){
            
            $row = $result->fetch(PDO::FETCH_ASSOC);

            $ME = new MelhorEnvio();
            $ME->set_id($row['id']);
            $ME->set_token($row['token']);
            $ME->set_refresh($row['refresh']);
            $ME->set_data($row['data']);

            return $ME;
        }
        else{
            return false;
        }
    }

}

?>