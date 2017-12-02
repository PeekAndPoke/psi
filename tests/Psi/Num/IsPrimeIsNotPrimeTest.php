<?php
/**
 * File was created 08.02.2016 22:31
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi\Num;

use PeekAndPoke\Component\Psi\Psi;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsPrimeIsNotPrimeTest extends TestCase
{
    public function testIsPrimeWithPsi()
    {
        $result = Psi::it(range(0, 30))
            ->filter(new Psi\Num\IsPrime())
            ->toArray();

        $this->assertSame(
            [2, 3, 5, 7, 11, 13, 17, 19, 23, 29],
            $result
        );
    }

    public function testIsNotPrimeWithPsi()
    {
        $result = Psi::it(range(0, 30))
            ->filter(new Psi\Num\IsNotPrime())
            ->toArray();

        $this->assertSame(
            [0, 1, 4, 6, 8, 9, 10, 12, 14, 15, 16, 18, 20, 21, 22, 24, 25, 26, 27, 28, 30],
            $result
        );
    }

    public function testInvalidInput()
    {
        $subject = new Psi\Num\IsPrime();

        $this->assertFalse($subject(1.0));
        $this->assertFalse($subject('a'));
        $this->assertFalse($subject(new \stdClass()));
        $this->assertFalse($subject([]));
    }
}
