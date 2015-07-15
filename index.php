<?php
error_reporting(E_ALL | E_STRICT);

$mode = $argv[1];

if(empty($mode)) {
    die('You have to choose a mode : -b (bruteforce) -i (input)');
}
else if($mode === '-b') {
    $caracters = 'abcdefghijklmnopqrstuvwxyz';
    $sub = '';
    $i = 0;
    $chut = 0;

    do {
        do {
            for($j = 0; $j < 26; $j++) {
                $text = $sub . $caracters{$j};
                $bmiDatas = bmiExtract($text);
                if(bmiDetect($bmiDatas)) {
                    echo "YOLO : " . $text . PHP_EOL;
                }
            }

            $sub.= $caracters{$i};
            $i++;
        } while(strlen($sub) < 26);

        $caracters.=$caracters{0};
        $caracters = substr($caracters,1);

        $sub = '';
        $i = 0;
        $chut++;

    } while($chut < 26);

}
else {
    if(empty($argv[2])) {
        die('You have to input a sentence');
    }

    $bmiDatas = bmiExtract($argv[2]);
    if(bmiDetect($bmiDatas)) {
        echo "YOLO";
    }
    else {
        echo "PAS YOLO";
    }
}

function bmiExtract($text) {
    $data = array(
        '1' => 0,
        '2' => 0,
        '3' => 0,
        '4' => 0,
        '5' => 0,
        '6' => 0,
        '7' => 0,
        '8' => 0,
        '9' => 0,
        '10' => 0,
        '11' => 0,
        '12' => 0,
        '13' => 0,
        '14' => 0,
        '15' => 0,
        '16' => 0
    );

    if(empty($text)) {
        return array();
    }

    $nl = strlen($text);

    for ($i = 0; $i < $nl; $i++) {

        $d = ord($text{$i}) * 1;

        if ($d < 65 || $d > 122 || ($d > 90 && $d < 97)) {
            continue;
        }

        if ($d > 96 && $d < 123) {
            $d-=32;
        }

        $data['1'] += $d;
        $data['2'] += (90 - $d) + 65;
        $data['3'] += $d - 64;
        $data['4'] += (91 - $d);
        $data['5'] += $d + 35;
        $data['6'] += (90 - $d) + 100;
        $data['7'] += ($d - 64) * 3;
        $data['8'] += (91 - $d) * 3;
        $data['9'] += ($d - 64) * 6;
        $data['10']+= (91 - $d) * 6;
        $data['11']+= ($d - 64) * 9;
        $data['12']+= (91 - $d) * 9;
        $data['13']+= ($d - 64) + 35;
        $data['14']+= (91 - $d) + 35;
        $data['15']+= $d + 32;
        $data['16']+= 187 - $d;

    }

    return $data;
}

function bmiDetect($data) {
    $marqueur = array(333,999,222,1998);

    foreach ($data as $key => $value) {
        if(in_array($value, $marqueur)) {
            return true;
        }
    }

    return false;
}