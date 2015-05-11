<?php
/**
 * File was created 08.05.2015 22:40
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
use PeekAndPoke\Component\Psi\Psi;

require_once(__DIR__ . '/bootstrap.php');

$input1  = [1,2,3,4];
$result = Psi::it($input1)->map(function ($i) { return $i * 2; })->join(', ');

var_dump($result);


$input2 = [5,6,7,8];
$result = Psi::it($input1, $input2)->map(function ($i) { return $i * 2; })->join(', ');

var_dump($result);

$result = Psi::it($input1, $input2)->join(', ');
var_dump($result);


$inputKv1 = [
    'a' => 'b',
    'c' => 'd',
];
$inputKv2 = [
    'a' => 'bb',
    'c' => 'dd',
];

$result = Psi::it($inputKv1, $inputKv2)->map(function($v, $k) { return $k . '#' . $v; })->join(', ');

var_dump($result);
