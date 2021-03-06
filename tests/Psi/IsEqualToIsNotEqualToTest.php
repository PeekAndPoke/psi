<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\EqualTo;
use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\NotEqualTo;
use PeekAndPoke\Component\Psi\Stubs\UnitTestMockA;
use PeekAndPoke\Component\Psi\Stubs\UnitTestMockB;
use PeekAndPoke\Component\Psi\Stubs\UnitTestToString;
use PeekAndPoke\Types\GenericHolder;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsEqualToIsNotEqualToTest extends TestCase
{
    /**
     * @param $subjectArgument
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsEqualTo($subjectArgument, $psiValue, $expectedResult)
    {
        $subject = new IsEqualTo($subjectArgument);
        $result  = $subject($psiValue);

        $this->assertSame($expectedResult, $result);

        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new EqualTo($subjectArgument);
        $result  = $subject($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $subjectArgument
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsEqualToWithValueHolder($subjectArgument, $psiValue, $expectedResult)
    {
        $subject = new IsEqualTo(
            new GenericHolder($subjectArgument)
        );
        $result  = $subject($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $subjectArgument
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testNotEqualTo($subjectArgument, $psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotEqualTo($subjectArgument);
        $result  = $subject($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new NotEqualTo($subjectArgument);
        $result  = $subject($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $subjectArgument
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testNotEqualToWithValueHolder($subjectArgument, $psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotEqualTo(
            new GenericHolder($subjectArgument)
        );
        $result  = $subject($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            // positives - ensure substitution

            [1, '1', true],
            ['1', 1, true],

            // positives

            [null, null, true],
            [true, true, true],
            [false, false, true],
            [new UnitTestMockA(), new UnitTestMockA(), true],

            [0, null, true],
            [0, false, true],
            [0, '', true],
            [0, '0', true],
            [0.0, 0, true],
            [0.0, '0', true],
            [0.0, '0.0', true],
            [0, '00', true],
            [0, '0x', true],
            [1, true, true],
            [1, 1.0, true],
            [1, '1', true],
            [1, '1x', true],

            // test magic __toString is invoked when comparing with "=="
            ['A', new UnitTestToString('A'), true],

            // positives curiosities

            [0, 'x1', true],

            // negatives
            [0, 1, false],
            ['0', 'x1', false],
            [new UnitTestMockA(), new UnitTestMockB(), false],
        ];
    }
}
