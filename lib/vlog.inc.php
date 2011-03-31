<?php

class vlog {

    private $videos;
    private $token;
    
    function __construct($token) {
        $this->token = $token;
    }

    public function getCanal($nome){
        $canal_id = $this->getCanalID($nome);
        
        $url = "http://api.videolog.tv/canal/{$canal_id}/videos.json";

        $con = new Connection($url, $this->token);

        $videos = $con->getResposta();

        return $videos;
    }

    private function getCanalID($nome) {
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

    public function search($termo, $canal = null, $user_id = null, $quantidade = null) {

        $url = "http://api.videolog.tv/video/busca.json?";

        if ($termo) {
            $url .= "q={$termo}";
        }
        else {
            throw new Exception("O parametro termo é obrigatório na busca");
        }

        if ($canal) {
            $canal = $this->getCanalID($canal);
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

    public function getVideo($id_video) {
        $url = "http://api.videolog.tv/video/{$id_video}.json";

        $con = new Connection($url, $this->token);

        $videos = $con->getResposta();

        return $videos;
    }

}

?>
