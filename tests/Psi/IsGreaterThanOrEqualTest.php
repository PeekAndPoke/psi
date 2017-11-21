<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\GreaterThanOrEqual;
use PeekAndPoke\Types\GenericHolder;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsGreaterThanOrEqualTest extends TestCase
{
    /**
     * @param $subjectArgument
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testGreaterThanOrEqual($subjectArgument, $psiValue, $expectedResult)
    {
        $subject = new IsGreaterThanOrEqual($subjectArgument);
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new GreaterThanOrEqual($subjectArgument);
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $subjectArgument
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testGreaterThanOrEqualWithValueHolder($subjectArgument, $psiValue, $expectedResult)
    {
        $subject = new IsGreaterThanOrEqual(
            new GenericHolder($subjectArgument)
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
            [0, 1, true],
            ['a', 'b', true],
            [11, '100', true],
            [0, 0, true],
            ['a', 'a', true],

            // negatives
            [1, 0, false],
            ['b', 'a', false],
            ['100', 11, false],
        ];
    }
}
