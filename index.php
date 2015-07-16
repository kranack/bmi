<?php
error_reporting(E_ALL | E_STRICT);

require_once ("./lib/bmi.class.php");

$mode = $argv[1];

if(empty($mode)) {
    die('You have to choose a mode : -b (bruteforce) -i (input)');
}

if (!empty($argv[2])) {
  if ($err = BMI::get($mode, $argv[2])) {
    print_r ($err);
  }
} else {
  if ($err = BMI::get($mode)) {
    print_r ($err);
  }
}
