<?php
require_once("../model/AvaliacaoDAO.php");
require_once("../model/VendaDAO.php");
require_once("../model/UsuarioDAO.php");

class Avaliacoes{	
	
    /* <li>
        <input type="checkbox" name="dropdown" id="coment" checked="">
        <label for="coment" class="dropdown-label"><h3 class="titulo_secao"><i class="ri-question-answer-fill"></i>Avaliações</h3></label>
        <div class="content content-1">
                <div>
                    <div class="content-comentario">
                        <div class="comentario-input">
                            <label for="comentario">Faça sua avaliação!</label>
                            <div class="comentario-inputs">
                                <select name="nota" required>
                                    <option value="">Selecione uma nota</option>
                                    <option value="1">⭐</option>
                                    <option value="2">⭐⭐</option>
                                    <option value="3">⭐⭐⭐</option>
                                    <option value="4">⭐⭐⭐⭐</option>
                                    <option value="5">⭐⭐⭐⭐⭐</option>
                                </select>
                                <input type="text" id="comentario" name="comentario" placeholder="Comentário" required>
                                <input type="button" value="Enviar">
                            </div>
                        </div>
                        <div class="comentario">
                            <span class="nome-usuario-coment">Leonardo Filippetto: ⭐⭐⭐⭐⭐</span>  
                            <p class="conteudo-coment">massa demais esse produto meu incrivel </p>
                            <div class="divisao-comentario"></div>
                        </div>
                    </div>
                </div>
        </div>
    </li> */

	public static function montar_avaliacoes($id_anuncio){
        $dao_a = new AvaliacaoDAO();
        $dao_v = new VendaDAO();
        $dao_u = new UsuarioDAO();
        $avaliacoes = $dao_a->obter_todos_por_anuncio($id_anuncio);
        $string_avaliacoes = '
        <li>
        <input type="checkbox" name="dropdown" id="coment" checked>
        <label for="coment" class="dropdown-label"><h3 class="titulo_secao"><i class="ri-question-answer-fill"></i>Avaliações</h3></label>
        <div class="content content-1">
                <div>
                    <div class="content-comentario">';
        if(isset($_SESSION['id_usuario'])){
            $v = $dao_v->obter_por_usuario_anuncio($id_anuncio, $_SESSION['id_usuario']);
            if($v!==false){
                $a = $dao_a->obter_por_usuario_anuncio($id_anuncio, $_SESSION['id_usuario']);
                if($a!==false){
                    $u = $dao_u->obter($_SESSION['id_usuario']);
                    $nome = $u->get_nome();
                    if($u->get_cnpj()!=""&&$u->get_cnpj()!=null)
                        $nome= $u->get_nome_fantasia();
                    $string_confirm = "confirm('Tem certeza de que deseja excluir sua avaliação referente a este produto?')";
                    $dateTime = new DateTime($a->get_data());
                    $data = $dateTime->format('d/m/Y');
                    $string_avaliacoes .= '
                    <div class="comentario" id="sua_avaliacao">
                        <h3>Sua avaliação:</h3>
                        <span class="nome-usuario-coment">'.$nome.'</span>
                        <div class="contenteudo-comentario">
                            <span><b>Nota: </b> '.self::montar_estrelas($a->get_nota()).'</span>
                            <span><b>Data: </b> '.$data.'</span>
                            <p class="conteudo-coment"><b>Comentário: </b> '.$a->get_comentario().'</p>
                        </div>
                        <div class="container_botoes">
                            <input type="button" value="Editar" id="btn_alterar">
                            <form action="../controller/excluir_avaliacao.php" method="post">
                                <input type="hidden" name="id_avaliacao" value="'.$a->get_id_avaliacao().'">
                                <input type="hidden" name="id_anunc" value="'.$_GET['id_anunc'].'">
                                <input type="submit" value="Excluir" id="btn_excluir" onClick="return '.$string_confirm.'">
                            </form>                           
                        </div>
                    </div>
                    
                    <div class="comentario-input" id="editar_avaliacao">
                        <form action="../controller/editar_avaliacao.php" method="post">
                            <input type="hidden" name="id_anunc" value="'.$_GET['id_anunc'].'">
                            <input type="hidden" name="id_avaliacao" value="'.$a->get_id_avaliacao().'">
                            <label for="comentario">Editar avaliação.</label>
                            <div class="comentario-inputs">
                                <select name="nota" required>
                                    <option value="1" '.(($a->get_nota()==1)?("selected"):("")).'>⭐</option>
                                    <option value="2" '.(($a->get_nota()==2)?("selected"):("")).'>⭐⭐</option>
                                    <option value="3" '.(($a->get_nota()==3)?("selected"):("")).'>⭐⭐⭐</option>
                                    <option value="4" '.(($a->get_nota()==4)?("selected"):("")).'>⭐⭐⭐⭐</option>
                                    <option value="5" '.(($a->get_nota()==5)?("selected"):("")).'>⭐⭐⭐⭐⭐</option>
                                </select>
                                <input type="text" id="comentario" name="comentario" value="'.$a->get_comentario().'" required>
                                <input type="button" value="Cancelar" id="btn_cancelar">
                                <input type="submit" value="Enviar">
                            </div>
                        </form>
                    </div>
                    <div class="divisao-comentario"></div>';
                }else{
                    $string_avaliacoes .= '                        
                    <div class="comentario-input">
                        <form action="../controller/registrar_avaliacao.php" method="post">
                            <input type="hidden" name="id_anunc" value="'.$_GET['id_anunc'].'">
                            <label for="comentario">Faça sua avaliação!</label>
                            <div class="comentario-inputs">
                                <select name="nota" required>
                                    <option value="">Selecione uma nota</option>
                                    <option value="1">⭐</option>
                                    <option value="2">⭐⭐</option>
                                    <option value="3">⭐⭐⭐</option>
                                    <option value="4">⭐⭐⭐⭐</option>
                                    <option value="5">⭐⭐⭐⭐⭐</option>
                                </select>
                                <input type="text" id="comentario" name="comentario" placeholder="Comentário" required>
                                <input type="submit" value="Enviar">
                            </div>
                        </form>
                    </div>
                    <div class="divisao-comentario"></div>';
                }
            }else{
                $string_avaliacoes .= '
                <div class="comentario">
                    <h3>Adquira este produto para fazer uma avaliação.</h3>
                </div>
                <div class="divisao-comentario"></div>';
            }
        }else{
            $string_avaliacoes .= '
            <div class="comentario">
                <form action="login.php" method="post">
                    <input type="hidden" name="redirect" value="../view/anuncio.php?id_anunc='.$_GET['id_anunc'].'">
                    <h3>Faça <button id="login_redirect">login</button> e adquira o produto para fazer uma avaliação.</h3>
                </form>
            </div>
            <div class="divisao-comentario"></div>';
        }

        if($avaliacoes!=[]){
            foreach($avaliacoes as $avaliacao){
                if(!(isset($_SESSION['id_usuario'])&&($avaliacao->get_id_usuario()==$_SESSION['id_usuario']))){
                    $u = $dao_u->obter($avaliacao->get_id_usuario());
                    $nome = $u->get_nome();
                    if($u->get_cnpj()!=""&&$u->get_cnpj()!=null)
                        $nome= $u->get_nome_fantasia();
                    $dateTime = new DateTime($avaliacao->get_data());
                    $data = $dateTime->format('d/m/Y');
                    $string_avaliacoes .= '
                    <div class="comentario">
                        <span class="nome-usuario-coment">'.$nome.'</span>
                        <div class="contenteudo-comentario">
                            <span><b>Nota: </b> '.self::montar_estrelas($avaliacao->get_nota()).'</span>
                            <span><b>Data: </b> '.$data.'</span>
                            <p class="conteudo-coment"><b>Comentário: </b> '.$avaliacao->get_comentario().'</p>
                        </div>
                        <div class="divisao-comentario"></div>
                    </div>';
                }
            }
        }else{
            $string_avaliacoes .= '
            <div class="comentario">
                <h3>Este anúncio ainda não possui avaliações.</h3>
            </div>';
        }
        $string_avaliacoes .= '</div>
                </div>
        </div>
        </li> ';
        return $string_avaliacoes;
    }

    public static function montar_estrelas($nota){
        $string_estrelas = '';
        for($i = 1; $i <= $nota; $i++){
            $string_estrelas.='⭐';
        }
        return $string_estrelas;
    }

    

}
//

?>