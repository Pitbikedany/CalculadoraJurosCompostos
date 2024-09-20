<?php
if($_GET){
    $capital = $_GET['capital'];
    $taxa = $_GET['taxa'];
    $tempo = $_GET['tempo'];
    $reforco = $_GET['reforco'];
    $regularidade = $_GET['regularidade'];
    
    $taxa_perc = $taxa/100;
    $juros = pow((1+$taxa_perc  ),$tempo);
    $invest = ($capital*$juros);
    $invest_format = number_format($invest, 2, ',', ' ');
    $reg = 0;

    if ($reforco){
        if($regularidade == 'mes'){
            $reg = 12;
        }
        elseif($regularidade == 'semana'){
            $reg = 52;
        }
        elseif($regularidade == 'ano'){
            $reg = 1;
        }
        $reg_pow = pow(1+($taxa_perc/$reg),($reg*$tempo));
        $calc_reforco = ($reforco * ($reg_pow - 1) / ($taxa_perc/$reg));
        $invest_reforco = ($invest + $calc_reforco);
        $invest_format_reforco = number_format($invest_reforco, 2, ',', ' ');
        
        $capital_reforco = $capital + (($reforco*$reg)*$tempo);
        $lucro = $invest_reforco-$capital_reforco;
        $lucro_format = number_format($lucro, 2, ',', ' ');

        echo 'Valor Total: ',$invest_format_reforco, '€';
        echo '<br>';
        echo'Lucro: ',$lucro_format,'€';
    }

    else{
        $lucro = $invest-$capital;
        $lucro_format = number_format($lucro, 2, ',', ' ');

        echo 'Valor Total: ',$invest_format, '€';
        echo '<br>';
        echo'Lucro: ',$lucro_format,'€'; 
    } 
}
?>