<?php

/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 27/09/2016
 * Time: 22:40
 */
class PrevTempo
{
    //Função responsável por retornar um array com os parâmetros necessários para a solicitação da previsão do tempo.
    function Parametros($cidade,$estado,$pais,$idioma){
        $parametros['cidade'] = $cidade;
        $parametros['estado'] = $estado;
        $parametros['pais'] = $pais;
        $parametros['idioma'] = $idioma;
        $parametros['urlapi'] = 'http://www.google.com.br/ig/api';
        return $parametros;
    }

    //Aqui é passado por parametro retornados na funcao paramtros, para que seja feita a requisição ao google
    function GeneratePrevTempo($parametros){
        //Acessando diretamente na internet
        var_dump($parametros);
        $url = $parametros['urlapi']."?weather='" . urlencode($parametros['cidade']) ."','" . urlencode($parametros['estado']) . "','" . urlencode($parametros['pais']) . "'&hl=" . $parametros['idioma'];

        //A $url alternativa é usada para que você possa acompanhar esse tutorial de forma offline
        $url_alternativa = "previsao.xml";

        //Atribui a variavel resultado o conteudo do xml
        $resultado = file_get_contents($url);

        //Aqui faz a conversão do xml para a variável xml
        $xml = simplexml_load_string(utf8_encode($resultado));

        //Valores recuperados da string xml, separados em um array multidimensional
        $dados['info'] = $xml->xpath('/xml_api_reply/weather/forecast_information');
        $dados['atual'] = $xml->xpath('/xml_api_reply/weather/current_conditions');
        $dados['info'] = $xml->xpath('/xml_api_reply/weather/forecast_conditions');

        return $dados;
    }
}