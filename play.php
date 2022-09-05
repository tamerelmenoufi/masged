<?php

    include("lib/fn.php");

    function play(){

        $v = file_get_contents("/var/www/html/logs/log.txt");
        echo $p = getPost();

        if(trim($v) == 'FIM' and trim($p) == 'PLAY'){
            getPost('cadastro');
            system("echo 'INICIO' > /var/www/html/logs/log.txt && mpg123 /var/www/html/mp3/azan.mp3 && echo 'FIM' > /var/www/html/logs/log.txt");
        }else if(trim($v) == 'INICIO' and trim($p) == 'PLAY'){
            getPost('cadastro');
            system("killall mpg123");
            system("echo 'INICIO' > /var/www/html/logs/log.txt && mpg123 /var/www/html/mp3/azan.mp3 && echo 'FIM' > /var/www/html/logs/log.txt");
        }else if(trim($p) == 'STOP'){
            getPost('cadastro');
            system("killall mpg123");
        }

        // $dados = system("ls -la");
        //$dados = system("killall mpg123");
        // $dados = system("mpg123 /var/www/html/mp3/azan.mp3");
        // file_put_contents('/var/www/html/logs/log.txt', $dados);
    }

    play();