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
class IsBoolIsNotBoolTest extends TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsBool($psiValue, $expectedResult)
    {
        $subject = new IsBool();

        $result = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotBool($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotBool();

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
            [true,                  true],
            [false,                 true],

            // negatives
            [new \ArrayIterator(),  false],
            [null,                  false],
            [0,                     false],
            ['Z',                   false],
            [new MockA(),           false],
        ];
    }
}
