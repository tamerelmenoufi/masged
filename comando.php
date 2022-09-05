<?php

    $dados = false;

    if($_POST['acao'] == 'consulta'){
        $dados = file_get_contents('./logs/play.txt');
    }

    if($_POST['acao'] == 'cadastro'){
        file_put_contents('./logs/play.txt', $_POST['val']);
    }

    echo $dados;