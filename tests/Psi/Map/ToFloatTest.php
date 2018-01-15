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
class ToFloatTest extends TestCase
{
    /**
     * @param mixed $input
     * @param int   $expected
     *
     * @dataProvider provideTestSubject
     */
    public function testSubject($input, $expected)
    {
        $subject = new ToFloat(-1.2);

        $this->assertSame($expected, $subject->__invoke($input));
    }

    public function provideTestSubject()
    {
        return [
            // convertible

            [0, 0.0],
            [1, 1.0],
            ['0', 0.0],
            ['1', 1.0],
            ['1.1', 1.1],
            ['1.99', 1.99],
            ['-0', 0.0],
            ['-1', -1.0],
            ['-1.1', -1.1],
            ['-1.99', -1.99],
            [new UnitTestToString('222'), 222.0],
            [new UnitTestToString('-222.22'), -222.22],

            // not convertible, thus using the default

            [null, -1.2],
            [[], -1.2],
            [new \stdClass(), -1.2],
            [new \DateTime(), -1.2],
            ['0a', -1.2],
            ['1b', -1.2],
            [' 1b', -1.2],
            [' 1 b', -1.2],
            [' 1 1', -1.2],
            ['', -1.2],
            [' ', -1.2],
            ['a', -1.2],
            ['a1', -1.2],
            ['B', -1.2],
            [new UnitTestToString('str'), -1.2],
        ];
    }
}
