<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Mocks\MockA;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNumericStringIsNotNumericStringTest extends TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNumericString($psiValue, $expectedResult)
    {
        $subject = new IsNumericString();

        $result = $subject($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotNumericString($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotNumericString();

        $result = $subject($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            // positives
            ['0',                   true],
            ['1',                   true],
            ['01',                  true],
            ['10',                  true],
            ['123',                 true],
            ['-0',                  true],
            ['-1',                  true],
            ['-01',                 true],
            ['-10',                 true],
            ['-123',                true],

            ['0.1',                 true],
            ['1.01',                true],
            ['-0.1',                true],
            ['-1.01',               true],
            ['1.',                  true],
            ['-1.',                 true],

            // negatives
            [0,                     false],
            [0.0,                   false],
            ['1a',                  false],
            ['a1',                  false],
            ['1.0a',                false],
            ['a1.1',                false],
            [new \ArrayIterator(),  false],
            [[],                    false],
            [true,                  false],
            [false,                 false],
            ['Z',                   false],
            [new MockA(),           false],
        ];
    }
}
