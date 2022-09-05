<?php

function getPost($acao = 'consulta', $val = false){

    $postdata = http_build_query(
        array(
            'acao' => $acao,
            'val' => $val
        )
    );
    $opts = array('http' =>
        array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );
    $context = stream_context_create($opts);
    return $result = file_get_contents('http://masged.mohatron.com/comando.php', false, $context);

}