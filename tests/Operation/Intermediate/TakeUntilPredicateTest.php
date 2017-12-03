<?php
/**
 * Created by gerk on 03.12.17 12:28
 */

namespace PeekAndPoke\Component\Psi\Operation\Intermediate;

use PeekAndPoke\Component\Psi\Psi;
use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class TakeUntilPredicateTest extends TestCase
{
    public function testSubjectWithPsi()
    {
        $result = Psi::it(range(0, 20))
            ->takeUntil(new Psi\IsLessThan(5))
            ->toArray();

        $this->assertSame(
            [],
            $result
        );
    }

    public function testSubjectWithPsi2()
    {
        $result = Psi::it(range(0, 20))
            ->takeUntil(new Psi\IsGreaterThan(5))
            ->toArray();

        $this->assertSame(
            [0, 1, 2, 3, 4, 5],
            $result
        );
    }
}
