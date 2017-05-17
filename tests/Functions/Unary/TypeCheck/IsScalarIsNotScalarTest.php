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
class IsScalarIsNotScalarTest extends TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsScalar($psiValue, $expectedResult)
    {
        $subject = new IsScalar();

        $result = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotScalar($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotScalar();

        $result = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            // positives
            [0,                     true],
            [0.0,                   true],
            [(float) 0,             true],
            ['',                    true],
            [true,                  true],
            [false,                 true],

            // negatives
            [null,                  false],
            [new MockA(),           false],
        ];
    }
}
