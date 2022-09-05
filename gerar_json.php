<?php

    $dados = file_get_contents("dados/horario_anual.txt");
    $linhas = str_replace("\r",false,$dados);
    $linhas = explode("\n",$linhas);

    function compila($opc){
        // 04:40 AM
        $d = explode(" ",$opc);
        $t = explode(":", $d[0]);
        if($d[1] == 'PM' and $t[0]*1 < 12){
            return [ 'h' => (($t[0]*1)+12), 'm' => (($t[1]*1)) ];
        }else{
            return [ 'h' => ($t[0]*1), 'm' => (($t[1]*1)) ];
        }
    }


    $mes = false;
    for($i=0;$i<count($linhas);$i++){

        if(substr($linhas[$i],0,1) == 'M'){
            $mes = substr($linhas[$i],1,strlen($linhas[$i]));
        }else{
            // 1|04:40 AM|05:54 AM|12:04 PM|03:30 PM|06:13 PM|07:24 PM

            $l = explode("|",$linhas[$i]);
            $fagir = compila($l[1]);
            $duhr = compila($l[3]);
            $asir = compila($l[4]);
            $makrib = compila($l[5]);
            $isha = compila($l[6]);


            $Json[$mes][$l[0]] = [
                'fagir' => [ 'h' => $fagir['h'], 'm' => $fagir['m'] ],
                'duhr' => [ 'h' => $duhr['h'], 'm' => $duhr['m'] ],
                'asir' => [ 'h' => $asir['h'], 'm' => $asir['m'] ],
                'makrib' => [ 'h' => $makrib['h'], 'm' => $makrib['m'] ],
                'isha' => [ 'h' => $isha['h'], 'm' => $isha['m'] ],
            ];
        }



    }

    $retorno = json_encode($Json);

    file_put_contents('dados/horas-salah.json', $retorno);