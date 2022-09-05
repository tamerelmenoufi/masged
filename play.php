<?php

    function play(){

        $v = file_get_contents("/var/www/html/logs/log.txt");
        $p = file_get_contents("/var/www/html/logs/play.txt");

        if(trim($v) == 'FIM' and trim($p) == 'PLAY'){
            file_put_contents('/var/www/html/logs/play.txt', false);
            system("echo 'INICIO' > /var/www/html/logs/log.txt && mpg123 /var/www/html/mp3/azan.mp3 && echo 'FIM' > /var/www/html/logs/log.txt");
        }else if(trim($v) == 'INICIO' and trim($p) == 'PLAY'){
            file_put_contents('/var/www/html/logs/play.txt', false);
            system("killall mpg123");
            system("echo 'INICIO' > /var/www/html/logs/log.txt && mpg123 /var/www/html/mp3/azan.mp3 && echo 'FIM' > /var/www/html/logs/log.txt");
        }else if(trim($p) == 'STOP'){
            file_put_contents('/var/www/html/logs/play.txt', false);
            system("killall mpg123");
        }

        // $dados = system("ls -la");
        //$dados = system("killall mpg123");
        // $dados = system("mpg123 /var/www/html/mp3/azan.mp3");
        // file_put_contents('/var/www/html/logs/log.txt', $dados);
    }

    play();