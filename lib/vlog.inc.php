<?php
/**
 * Wrapper Videolog - Wrapper para facilitar o uso da API Videolog
 *
 * @author Alê Borba <ale.alvesborba@gmail.com>
 * @license <a href="http://www.gnu.org/licenses/gpl-3.0.html">GPLv3 - GNU General Public License - Version 3.0</a>
 * @version 0.0.1
 */
/**
 * Classe vlog()
 * <pre>
 * Classe que faz a interface da API com o usuário.
 * </pre>
 */
class vlog {
    /**
     * Variável que armazena o token de autenticação
     *
     * @var string
     * @access private
     */
    private $token;

    /**
     * Method __construct()
     * <pre>
     * Método construtor que armazena o token para as consultas
     * </pre>
     * @param string $token Token usado na autenticação das requisições
     * @access public
     */
    public function __construct($token) {
        $this->token = $token;
    }

    /**
     * Method getChannel()
     * <pre>
     * Metodo que retorna os vídeos de um determinado canal.
     * Leia o arquivo README para saber quais as opções disponíveis.
     * </pre>
     * @param string $nome Nome do canal que deseja consultar
     * @return object
     * @access public
     */
    public function getChannel($nome){
        $canal_id = $this->getChannelID($nome);
        
        $url = "http://api.videolog.tv/canal/{$canal_id}/videos.json";

        $con = new Connection($url, $this->token);

        $videos = $con->getResposta();

        return $videos;
    }

    /**
     * Method getChannelID()
     * <pre>
     * Método que identifica o ID do canal selecionado pelo usuário
     * </pre>
     * @param string $nome Nome do canal selecionado
     * @return integer
     * @access private
     */
    private function getChannelID($nome) {
        $id_canais = array(
            'animação' => 2,
            'autos e veículos' => 3,
            'educação e instrução' => 4,
            'entretenimento' => 5,
            'festas' => 6,
            'família' => 7,
            'humor' => 10,
            'músicas' => 11,
            'jornalismo' => 12,
            'política' => 13,
            'sexy' => 15,
            'animais' => 17,
            'ciência e tecnologia' => 18,
            'curtas metragens' => 19,
            'seriados' => 20,
            'esportes' => 22,
            'viagens e lugares' => 23,
            'vídeo games' => 24,
            'videologger' => 25,
            'moda e beleza' => 26,
            'bebidas e gastronomia' => 27,
            'artes' => 28,
            'inovação e empreendedorismo' => 29,
            'eventos' => 30
        );

        $nome = strtolower($nome);
        
        if (array_key_exists($nome, $id_canais)) {
            return $id_canais["{$nome}"];
        }
        else {
            throw new Exception("Esse não é um canal válido, verifique novamente a lista de canais disponíveis");
        }
    }

    /**
     * Method getUserVideos()
     * <pre>
     * Método que retorna os vídeos do usuário selecionado.
     * Se o parâmetro $favoritos for 'true', serão retornados os vídeos
     * favoritos do usuário selecionado.
     * </pre>
     * @param string $user_id ID do usuário que se deseja buscar
     * @param boolean $favoritos Flag de controle para a opção favoritos.
     * @return object
     * @access public
     */
    public function getUserVideos($user_id, $favoritos = false){

        if ($favoritos) {
            $url = "http://api.videolog.tv/usuario/{$user_id}/favoritos/1.json";
        }
        else {
            $url = "http://api.videolog.tv/usuario/{$user_id}/videos.json";
        }

        $con = new Connection($url, $this->token);

        $videos = $con->getResposta();

        return $videos;
    }

    /**
     * Method search()
     * <pre>
     * Metodo utilizado para fazer buscas dentro do Videolog
     * </pre>
     * @param string $termo O termo a ser procurado. E.g. 'copa do mundo'(Obrigatório)
     * @param string $canal Canal usado pra reduzir as buscas
     * @param string $user_id ID do usuário para reduzir as buscas
     * @param integer $quantidade Quantidade de vídeos que serão retornados
     * @return object
     * @access public
     */
    public function search($termo, $canal = null, $user_id = null, $quantidade = null) {

        $url = "http://api.videolog.tv/video/busca.json?";

        if ($termo) {
            $url .= "q={$termo}";
        }
        else {
            throw new Exception("O parametro termo é obrigatório na busca");
        }

        if ($canal) {
            $canal = $this->getChannelID($canal);
            $url .= "&canal={$canal}";
        }

        if ($user_id) {
            $url .= "&usuario={$user_id}";
        }

        if ($quantidade) {
            $url .= "&itens={$quantidade}";
        }
        
        $con = new Connection($url, $this->token);

        $videos = $con->getResposta();

        return $videos;
    }

    /**
     * Method getVideo()
     * <pre>
     * Método que retorna as informações de um determinado vídeo
     * </pre>
     * @param string $id_video ID do vídeo que será pesquisado
     * @return object
     * @access public
     */
    public function getVideo($id_video) {
        $url = "http://api.videolog.tv/video/{$id_video}.json";

        $con = new Connection($url, $this->token);

        $videos = $con->getResposta();

        return $videos;
    }

    /**
     * Method getRelated()
     * <pre>
     * Método que retorna a lista de vídeos relacionados ao informado.
     * </pre>
     * @param string $id_video ID do video base da consulta
     * @return object
     * @access public
     */
    public function getRelated($id_video) {
        $url = "http://api.videolog.tv/video/{$id_video}/videosRelacionados.json";

        $con = new Connection($url, $this->token);

        $videos = $con->getResposta();

        return $videos;
    }

    /**
     * Method getVideoComments()
     * <pre>
     * Método que retorna os comentários do vídeo informado.
     * </pre>
     * @param string $id_video ID do video base da consulta
     * @return object
     * @access public
     */
    public function getVideoComments($id_video) {
        $url = "http://api.videolog.tv/video/{$id_video}/comentarios.json";

        $con = new Connection($url, $this->token);

        $cometarios = $con->getResposta();

        return $cometarios;
    }

    /**
     * Method getComment()
     * <pre>
     * Método que retorna as informações do comentário informado.
     * </pre>
     * @param string $id_comment ID do comentário
     * @return object
     * @access public
     */
    public function getComment($id_comment) {
        $url = "http://api.videolog.tv/comentario/{$id_comment}.json";

        $con = new Connection($url, $this->token);

        $comentarios = $con->getResposta();

        return $comentarios;
    }
}
?>