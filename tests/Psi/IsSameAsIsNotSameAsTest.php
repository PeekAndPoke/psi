<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\NotSameAs;
use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\SameAs;
use PeekAndPoke\Component\Psi\Stubs\UnitTestMockA;
use PeekAndPoke\Component\Psi\Stubs\UnitTestMockB;
use PeekAndPoke\Component\Psi\Stubs\UnitTestToString;
use PeekAndPoke\Types\GenericHolder;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsSameAsIsNotSameAsTest extends TestCase
{
    /**
     * @param $subjectArgument
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testSameAs($subjectArgument, $psiValue, $expectedResult)
    {
        $subject = new IsSameAs($subjectArgument);
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new SameAs($subjectArgument);
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
    public function testSameAsWithValueHolder($subjectArgument, $psiValue, $expectedResult)
    {
        $subject = new IsSameAs(
            new GenericHolder($subjectArgument)
        );
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
    public function testNotSameAs($subjectArgument, $psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotSameAs($subjectArgument);
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new NotSameAs($subjectArgument);
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
    public function testNotSameAsWithValueHolder($subjectArgument, $psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotSameAs(
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
        $mock = new UnitTestMockA();

        return [
            // positives
            [0, 0, true],
            ['0', '0', true],
            ['1', '1', true],
            [true, true, true],
            [$mock, $mock, true],

            // negatives - ensure substitution
            ['1', '0', false],
            ['0', '1', false],

            // negatives
            [0, false, false],
            [1, true, false],
            [1, '1', false],
            [0, '0', false],
            [0, 0.0, false],
            [(int) 1.0, 1.0, false],
            [new UnitTestMockA(), new UnitTestMockB(), false],

            // test magic __toString is NOT invoked when comparing with "==="
            ['A', new UnitTestToString('A'), false],
        ];
    }
}
