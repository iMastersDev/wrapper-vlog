<?php
/**
 * Wrapper Videolog - Wrapper para facilitar o uso da API Videolog
 *
 * @author Alê Borba <ale.alvesborba@gmail.com>
 * @license <a href="http://www.gnu.org/licenses/gpl-3.0.html">GPLv3 - GNU General Public License - Version 3.0</a>
 * @version 0.0.1
 */
/**
 * Classe Connection()
 * <pre>
 * Classe que manipula o cURL, faz a autenticação
 * e obtem as respostas da API.
 * </pre>
 */
class Connection{
    /**
     * Variável que guarda o retorno da API
     *
     * @var object
     * @access private
     */
    private $resposta;

    /**
     * Method __construct()
     * <pre>
     * Método construtor, faz a autenticação, manda a requisição
     * e obtem a resposta
     * </pre>
     *
     * @param string $url URL de requisição que será enviada
     * @param string $token Token de autenticação da API
     * @access public
     */
    public function  __construct($url,$token) {

        $curl = curl_init();

        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_HTTPHEADER,array("Token:{$token}"));
        curl_setopt($curl,CURLOPT_TIMEOUT,30);
        curl_setopt($curl,CURLOPT_MAXREDIRS,4);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
        $result = curl_exec($curl);
        $erro = curl_errno($curl);
        curl_close($curl);

        $this->resposta = json_decode($result);

    }

    /**
     * Method getResposta()
     * <pre>
     * Método que retorna a resposta enviada pela API
     * </pre>
     * @return object
     * @access public
     */
    public function getResposta(){
        return $this->resposta;
    }
}
?>