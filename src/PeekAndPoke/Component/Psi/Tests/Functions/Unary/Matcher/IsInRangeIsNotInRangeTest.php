<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\Matcher;

use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\IsInRange;
use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\IsNotInRange;

/**
 * Test IsInRangeIsNotInRangeTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsInRangeIsNotInRangeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $gte
     * @param $lte
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsInRange($gte, $lte, $psiValue, $expectedResult)
    {
        $subject = new IsInRange($gte, $lte);

        $result = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $gte
     * @param $lte
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotInRange($gte, $lte, $psiValue, $expectedResult)
    {
        $expectedResult = !$expectedResult;

        $subject = new IsNotInRange($gte, $lte);

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
            [0,     0,      0,      true],
            [1,     1,      1,      true],
            [-1,    1,     -1,      true],
            [-1,    1,      1,      true],
            [-1,    1,      0,      true],

            // negatives
            [-1,    1,   -1.1,      false],
            [-1,    1,    1.1,      false],
            [2,     1,    1.5,      false],
        ];
    }
}
