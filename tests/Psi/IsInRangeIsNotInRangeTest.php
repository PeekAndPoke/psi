<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Types\GenericHolder;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsInRangeIsNotInRangeTest extends TestCase
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
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\Matcher\IsInRange($gte, $lte);
        $result  = $subject->__invoke($psiValue);

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
    public function testIsInRangeWithValueHolders($gte, $lte, $psiValue, $expectedResult)
    {
        $subject = new IsInRange(
            new GenericHolder($gte),
            new GenericHolder($lte)
        );
        $result  = $subject->__invoke($psiValue);

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
        $expectedResult = ! $expectedResult;

        $subject = new IsNotInRange($gte, $lte);
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\Matcher\IsNotInRange($gte, $lte);
        $result  = $subject->__invoke($psiValue);

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
    public function testIsNotInRangeWithValueHolders($gte, $lte, $psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotInRange(
            new GenericHolder($gte),
            new GenericHolder($lte)
        );
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            // positives
            [0, 0, 0, true],
            [1, 1, 1, true],
            [-1, 1, -1, true],
            [-1, 1, 1, true],
            [-1, 1, 0, true],

            // negatives
            [-1, 1, -1.1, false],
            [-1, 1, 1.1, false],
            [2, 1, 1.5, false],
        ];
    }
}
