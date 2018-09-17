<?php /** @noinspection ForgottenDebugOutputInspection */

use PeekAndPoke\Component\Psi\Psi;

include __DIR__ . '/bootstrap.php';


var_dump(
    'any',
    Psi::it([4])
    ->any(new Psi\IsEqualTo(4))
);


var_dump(
    'all',
    Psi::it([2, 2, 2])
       ->all(new Psi\IsEqualTo(2))
);
