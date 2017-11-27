<?php
/**
 * File was created 08.02.2016 22:31
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

use PeekAndPoke\Component\Psi\Stubs\UnitTestToString;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ToUpperTest extends TestCase
{
    /**
     * @param mixed       $input
     * @param string|null $expected
     *
     * @dataProvider provideTestSubject
     */
    public function testSubject($input, $expected)
    {
        $subject = new ToUpper();

        $this->assertSame($expected, $subject->__invoke($input));
    }

    public function provideTestSubject()
    {
        return [
            [null, ''],
            [new \stdClass(), ''],
            [new \DateTime(), ''],
            [0, '0'],
            [1, '1'],
            ['', ''],
            [' ', ' '],
            ['a', 'A'],
            ['B', 'B'],
            ['wOrLd-Wide', 'WORLD-WIDE'],
            [new UnitTestToString('wOrLd-Wide'), 'WORLD-WIDE'],
        ];
    }
}
