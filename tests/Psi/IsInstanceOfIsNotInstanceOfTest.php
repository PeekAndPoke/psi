<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Stubs\UnitTestMockA;
use PeekAndPoke\Component\Psi\Stubs\UnitTestMockB;
use PeekAndPoke\Types\GenericHolder;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsInstanceOfIsNotInstanceOfTest extends TestCase
{
    /**
     * @param $subjectArgument
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsInstanceOf($subjectArgument, $psiValue, $expectedResult)
    {
        $subject = new IsInstanceOf($subjectArgument);
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\Matcher\IsInstanceOf($subjectArgument);
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
    public function testIsInstanceOfWithValueHolder($subjectArgument, $psiValue, $expectedResult)
    {
        $subject = new IsInstanceOf(
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
    public function testIsNotInstanceOf($subjectArgument, $psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotInstanceOf($subjectArgument);
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\Matcher\IsNotInstanceOf($subjectArgument);
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
    public function testIsNotInstanceOfWithValueHolder($subjectArgument, $psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotInstanceOf(
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
        // for PHP 5.4 compatibility we cannot use ::class

        $clsMockA = UnitTestMockA::class;
        $clsMockB = UnitTestMockB::class;

        return [
            // positives - with a real object in the instance of clause
            [new UnitTestMockA(), new UnitTestMockA(), true],
            [new UnitTestMockA(), new UnitTestMockB(), true],
            [new UnitTestMockB(), new UnitTestMockB(), true],
            // positives - with a fqcn in the instance of clause
            [$clsMockA, new UnitTestMockA(), true],
            [$clsMockA, new UnitTestMockB(), true],
            [$clsMockB, new UnitTestMockB(), true],

            // negatives
            [1, 1, false],
            [0, new UnitTestMockA(), false],
            [new UnitTestMockA(), 0, false],
            [new UnitTestMockA(), $clsMockA, false],
            [$clsMockB, new UnitTestMockA(), false],
            [new UnitTestMockB(), new UnitTestMockA(), false],
        ];
    }
}
