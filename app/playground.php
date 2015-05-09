<?php
/**
 * File was created 08.05.2015 22:40
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
use PeekAndPoke\Component\Psi\Psi;

require_once(__DIR__ . '/bootstrap.php');

$input = [1,2,3,4];

$result = Psi::it($input)->map(function ($i) { return $i * 2; })->collect();

var_dump($result);
