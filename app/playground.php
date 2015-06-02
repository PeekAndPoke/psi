<?php
/**
 * File was created 08.05.2015 22:40
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
use PeekAndPoke\Component\Psi\Functions\Unary\Comparison\EqualTo;
use PeekAndPoke\Component\Psi\Functions\Unary\Comparison\GreaterThan;
use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsInstanceOf;
use PeekAndPoke\Component\Psi\Functions\Unary\Comparison\IsNotInstanceOf;
use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotObject;
use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsObject;
use PeekAndPoke\Component\Psi\Psi;

require_once(__DIR__ . '/bootstrap.php');

$input1  = [1,2,3,4,3,4];
$result = Psi::it($input1)
    ->filterValueKey(function ($v, $k) { return $k > 2 || $v == 1; })
    ->map(function ($v, $k) { return $v * $k; })
    ->rsort()
//    ->unique()
    ->reverse()
    ->join(', ');

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

$result = Psi::it($inputKv1, $inputKv2)
    ->map(function($v, $k) { return $k . '#' . $v; })
    ->collect();

var_dump($result);


$a = [
    1, 2,
    [
        'x' => [4, [5, 6]]
    ]
];

$result = Psi::it($a)
    ->flatten()
    ->anyMatch(function ($i) { return $i == 4; })
    ->join(', ');

var_dump($result);

/**  */
class PlayA {}
/**  */
class PlayB extends PlayA {}
/**  */
class PlayC extends PlayB {}

$input = [0, "z", new \stdClass(), new PlayA(), new PlayB(), new PlayC()];

$result = Psi::it($input)->filter(new IsObject())->toArray();
var_dump($result);


$result = Psi::it($input)->filter(new IsNotObject())->toArray();
var_dump($result);

$result = Psi::it($input)->filter(new IsInstanceOf("B"))->toArray();
var_dump($result);

$result = Psi::it($input)->filter(new IsNotInstanceOf("B"))->toArray();
var_dump($result);

$result = Psi::it($input)->filter(new EqualTo("B"))->toArray();
var_dump($result);


$input = [0, 1, 2, 3];

$result = Psi::it($input)->filter(new GreaterThan(1))->toArray();
var_dump($result);
