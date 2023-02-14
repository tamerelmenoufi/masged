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


function dataPort(){
    $data = date('D');
    $mes = date('M');
    $dia = date('d');
    $ano = date('Y');

    $semana = array(
        'Sun' => 'Dom',
        'Mon' => 'Seg',
        'Tue' => 'Ter',
        'Wed' => 'Qua',
        'Thu' => 'Qui',
        'Fri' => 'Sex',
        'Sat' => 'Sáb'
    );

    $mes_extenso = array(
        'Jan' => 'Jan',
        'Feb' => 'Fev',
        'Mar' => 'Mar',
        'Apr' => 'Abr',
        'May' => 'Mai',
        'Jun' => 'Jun',
        'Jul' => 'Jul',
        'Aug' => 'Ago',
        'Sep' => 'Set',
        'Oct' => 'Out',
        'Nov' => 'Nov',
        'Dec' => 'Dez'
    );
 return $data= $semana["$data"] . ", {$dia} de " . $mes_extenso["$mes"] . " de {$ano}";
}


function dataArabe(){
    $data = date('D');
    $mes = date('M');
    $dia = date('d');
    $ano = date('Y');

    $semana = array(
        'Sun' => 'الأحد',
        'Mon' => 'الأثنين',
        'Tue' => 'الثلاثاء',
        'Wed' => 'الأربعاء',
        'Thu' => 'الخميس',
        'Fri' => 'الجمعة',
        'Sat' => 'السبت'
    );

    $mes_extenso = array(
        'Jan' => 'يناير',
        'Feb' => 'فبراير',
        'Mar' => 'مارس',
        'Apr' => 'ابريل',
        'May' => 'مايو',
        'Jun' => 'يونيو',
        'Jul' => 'يوليو',
        'Aug' => 'أغسطس',
        'Sep' => 'سبتمبر',
        'Oct' => 'أكتوبر',
        'Nov' => 'نوفمبر',
        'Dec' => 'ديسمبر'
    );
 return $semana["$data"] . " {$dia} " . $mes_extenso["$mes"] . " {$ano}";
}

function c($c){
    return str_pad($c , 2 , '0' , STR_PAD_LEFT);
}

function arabe($c){

    $salah = array(
        'fagir' => 'الفجر',
        'duhr' => 'الظهر',
        'asir' => 'العصر',
        'makrib' => 'المغرب',
        'isha' => 'العشاء'
    );

    return $salah[$c];
}

function portugues($c){
    $salah = array(
        'fagir' => 'Fajar',
        'duhr' => 'Zohar',
        'asir' => 'Asar',
        'makrib' => 'Maghrib',
        'isha' => 'Isha'
    );

    return $salah[$c];
}



