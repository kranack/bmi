<?php

/* Random Word Generator
  @param $length : length of the output word
*/
function generateRandomWords($length) {
  $word = array_merge(range('a', 'z'), range('A', 'Z'));
  shuffle($word);
  return substr(implode($word), 0, $length);
}

/* BMI Class
  Return a YOLO if bmi value is in BMI_VALUES
  Return PAS YOLO otherwise
*/
class BMI {

  private static $_BMI_VALUES = array(333,999,222,1998);

  /* Main fonction
    @param $mode : -b (bruteforce) or -i (input)
    @param $t : text value for input mode
    Return an error if shit happens
  */
  public static function get($mode, $t = "") {
    if ($mode === "-b") {
      $caracters = 'abcdefghijklmnopqrstuvwxyz';
      $sub = '';
      $i = 0;
      $chut = 0;

      do {
        do {
          for($j = 0; $j < 26; $j++) {
            $text = $sub . $caracters{$j};
            $bmiDatas = self::extract($text);
            if(self::check($bmiDatas)) {
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
    } else {
      if ($t == "") {
        return "You have to input a sentence";
      }
      $bmiDatas = self::extract($t);
      if(self::check($bmiDatas)) {
        echo "YOLO";
      }
      else {
        echo "PAS YOLO";
      }
    }
    return 0;
  }

  /* Extract BMI value from text
    @param $text : text to check
    Return $data : BMI value from $text or empty array
  */
  private static function extract($text) {
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


  /* Check if BMI value is good or not
    @param $data : BMI value
    Return bool (true | false) : true if BMI is in BMI_VALUES, false otherwise
  */
  private static function check($data) {
    foreach ($data as $key => $value) {
      if(in_array($value, self::$_BMI_VALUES)) {
        return true;
      }
    }

    return false;
  }
}
