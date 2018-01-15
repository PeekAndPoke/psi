<?php
/**
 * Created by gerk on 20.11.17 17:34
 */

namespace PeekAndPoke\Component\Psi\Psi\Map;

use PeekAndPoke\Component\Psi\Stubs\UnitTestToString;
use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ToStringTest extends TestCase
{
    /**
     * @param mixed       $input
     * @param string|null $expected
     *
     * @dataProvider provideTestSubject
     */
    public function testSubject($input, $expected)
    {
        $subject = new ToString('n/a');

        $this->assertSame($expected, $subject->__invoke($input));
    }

    public function provideTestSubject()
    {
        return [
            [null, 'n/a'],
            [[], 'n/a'],
            [new \stdClass(), 'n/a'],
            [new \DateTime(), 'n/a'],
            [0, '0'],
            [1, '1'],
            ['', ''],
            [' ', ' '],
            ['a', 'a'],
            ['B', 'B'],
            ['wOrLd-Wide', 'wOrLd-Wide'],
            [new UnitTestToString('wOrLd-Wide'), 'wOrLd-Wide'],
        ];
    }
}
