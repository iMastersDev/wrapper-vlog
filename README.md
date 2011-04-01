Wrapper API Videolog
========================
Wrapper em PHP que facilita a utilização da API Videolog.

Exemplo
----------------
    <?php
    #Inclui todas as classes
    require_once 'autoload.inc.php';

    #Cria um novo objeto videolog passando o seu token
    $videos = new vlog("seu_token");

    #Pega todos os resultados do canal "Jornalismo"
    $reposta = $videos->getCanal("jornalismo");

    #Imprime o resultado na tela
    echo "<pre>";
    print_r($reposta);

    ?>

Como obter seu token de acesso
-------------------------------
Para obter seu token de acesso vá até a página http://api.videolog.tv/usuario/chave
Digite seu usuario e senha do Videolog e clique no botão "GERAR" e seu token ira aparecer na tela

Métodos disponíveis
-----------------------------

getCanal($nome)
----------------------
Retorna todos os vídeos do canal informado no parâmetro $nome.

* Canais Disponíveis:
    * Animação
    * Autos e veículos
    * Educação e Instrução
    * Entretenimento
    * Festas
    * Família
    * Humor
    * Músicas
    * Jornalismo
    * Política
    * Sexy
    * Animais
    * Ciência e tecnologia
    * Curtas metragens
    * Seriados
    * Esportes
    * Viagens e lugares
    * Vídeo Games
    * Videologger
    * Moda e Beleza
    * Bebidas e Gastronomia
    * Artes
    * Inovação e empreendedorismo
    * Eventos

getUserVídeos($user_id, $favoritos = false)
------------------------------------------------
Retorna todos os vídeos de um usuário determinado pelo $user_id. Se o parâmetro $favoritos for true,
ele retorna os vídeos favoritos deste usuário.

search($termo, $canal = null, $user_id = null, $quantidade = null)
---------------------------------------------------------------------
Faz uma pesquisa em todo o Videlog com base nos termos definidos.
$termo = O termo a ser procurado(obrigatório).
$canal = Limita a busca apenas ao canal indicado.
$user_id = Limita a busca aos vídeos do usuário indicado.
$quantidade = Indica a quantidade de vídeos que serão retornados.

getVideo($id_video)
-----------------------
Retorna as informações do vídeo determinado pelo parâmetro $id_video