<?php
/**
 * Created by gerk on 22.11.17 05:53
 */

namespace PeekAndPoke\Component\Psi\Functions;

use PeekAndPoke\Types\GenericHolder;
use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ParameterizedUnaryFunctionTest extends TestCase
{
    /**
     * @param mixed $input
     * @param mixed $expected
     *
     * @dataProvider provideTestGetValue
     */
    public function testGetValue1($input, $expected)
    {
        $subject = new ParameterizedUnaryFunction($input);

        $this->assertSame($expected, $subject->getValue());
    }

    /**
     * @param mixed $input
     * @param mixed $expected
     *
     * @dataProvider provideTestGetValue
     */
    public function testGetValue2($input, $expected)
    {
        $subject = new ParameterizedUnaryFunction(null, $input);

        $this->assertSame($expected, $subject->getValue2());
    }

    public function provideTestGetValue()
    {
        return [
            [null, null],
            [1, 1],
            ['1', '1'],
            ['1A', '1A'],
            [$obj = new \stdClass(), $obj],
            [new GenericHolder(1), 1],
        ];
    }

    /**
     * @param mixed $input
     *
     * @dataProvider provideTestGetValue
     */
    public function testInvoke($input)
    {
        $subject = new ParameterizedUnaryFunction($input, $input);

        $this->assertNull($subject->__invoke($input));
    }
}
