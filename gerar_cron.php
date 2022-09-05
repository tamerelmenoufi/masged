<?php

// Minuto (0 a 59) | Hora (0 a 23) | Dia (1 a 31) | Mês (1 a 12)| Dia da semana (0 a 7)

    $cron = false;
    ////////////CRON 60/////////////////

        $cron .= "#######################################################################\n\n\n";

    for($i=1;$i<=60;$i++){

        $cron .= "* * * * * sleep {$i} && php /var/www/html/play.php\n";

    }

        $cron .= "#######################################################################\n\n\n";

    $dados = file_get_contents("dados/horas-salah.json");

    $Json = json_decode($dados);

    // $cron = false;

    foreach($Json as $mes => $dias){

        foreach($dias as $dia => $s){

            foreach($s as $c => $h){

                if($c != 'fagir'){
                    if($opc){ $audio = false; $opc = false; }else{ $audio = false; $opc = true; }
                    $cron .= "{$h->m} {$h->h} {$dia} {$mes} * echo 'INICIO' > /var/www/html/logs/log.txt && mpg123 /var/www/html/mp3/azan{$audio}.mp3 && echo 'FIM' > /var/www/html/logs/log.txt\n";
                }
            }

        }

    }

    file_put_contents("dados/cron.txt", $cron);