<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\GreaterThan;
use PeekAndPoke\Types\GenericHolder;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsGreaterThanTest extends TestCase
{
    /**
     * @param $subjectArgument
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testGreaterThan($subjectArgument, $psiValue, $expectedResult)
    {
        $subject = new IsGreaterThan($subjectArgument);
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new GreaterThan($subjectArgument);
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
    public function testGreaterThanWithValueHolder($subjectArgument, $psiValue, $expectedResult)
    {
        $subject = new IsGreaterThan(
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

            // value holder positives
            [0, 1, true],
            ['a', 'b', true],
            [11, '100', true],

            // negatives
            [1, 0, false],
            ['b', 'a', false],
            ['100', 11, false],

            [0, 0, false],
            ['a', 'a', false],
        ];
    }
}
