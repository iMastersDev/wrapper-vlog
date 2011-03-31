<?php
class Connection{

    private $resposta;

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

    public function getResposta(){
        return $this->resposta;
    }

}
?>
