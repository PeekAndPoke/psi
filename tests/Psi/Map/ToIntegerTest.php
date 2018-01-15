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
class ToIntegerTest extends TestCase
{
    /**
     * @param mixed $input
     * @param int   $expected
     *
     * @dataProvider provideTestSubject
     */
    public function testSubject($input, $expected)
    {
        $subject = new ToInteger(-1);

        $this->assertSame($expected, $subject->__invoke($input));
    }

    public function provideTestSubject()
    {
        return [
            // convertible

            [0, 0],
            [1, 1],
            [1.1, 1],
            [-1.1, -1],
            ['0', 0],
            ['1', 1],
            ['1.1', 1],
            ['1.99', 1],
            ['-0', 0],
            ['-1', -1],
            ['-1.1', -1],
            ['-1.99', -1],
            [new UnitTestToString('222'), 222],
            [new UnitTestToString('-222.22'), -222],

            // not convertible, thus using the default

            [null, -1],
            [[], -1],
            [new \stdClass(), -1],
            [new \DateTime(), -1],
            ['0a', -1],
            ['1b', -1],
            [' 1b', -1],
            [' 1 b', -1],
            [' 1 1', -1],
            ['', -1],
            [' ', -1],
            ['a', -1],
            ['a1', -1],
            ['B', -1],
            [new UnitTestToString('str'), -1],
        ];
    }
}
