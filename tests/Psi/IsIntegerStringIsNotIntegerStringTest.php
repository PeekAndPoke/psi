<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Stubs\UnitTestMockA;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsIntegerStringIsNotIntegerStringTest extends TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsIntegerString($psiValue, $expectedResult)
    {
        $subject = new IsIntegerString();
        $result  = $subject($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsIntegerString();
        $result  = $subject($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotIntegerString($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotIntegerString();
        $result  = $subject($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotIntegerString();
        $result  = $subject($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            // positives
            ['0', true],
            ['1', true],
            ['01', true],
            ['10', true],
            ['123', true],
            ['-0', true],
            ['-1', true],
            ['-01', true],
            ['-10', true],
            ['-123', true],

            // TODO: do we really accept the .0 ones ?
            ['0.0', true],
            ['1.0', true],
            ['-0.0', true],
            ['-1.0', true],

            // negatives
            [0, false],
            [0.0, false],
            ['1a', false],
            ['a1', false],
            ['0.1', false],
            ['1.01', false],
            [new \ArrayIterator(), false],
            [[], false],
            [true, false],
            [false, false],
            ['Z', false],
            [new UnitTestMockA(), false],
        ];
    }
}
