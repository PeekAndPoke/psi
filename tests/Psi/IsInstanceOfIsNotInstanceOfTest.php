<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Mocks\MockA;
use PeekAndPoke\Component\Psi\Mocks\MockB;
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

        $clsMockA = MockA::class;
        $clsMockB = MockB::class;

        return [
            // positives - with a real object in the instance of clause
            [new MockA(), new MockA(), true],
            [new MockA(), new MockB(), true],
            [new MockB(), new MockB(), true],
            // positives - with a fqcn in the instance of clause
            [$clsMockA, new MockA(), true],
            [$clsMockA, new MockB(), true],
            [$clsMockB, new MockB(), true],

            // negatives
            [1, 1, false],
            [0, new MockA(), false],
            [new MockA(), 0, false],
            [new MockA(), $clsMockA, false],
            [$clsMockB, new MockA(), false],
            [new MockB(), new MockA(), false],
        ];
    }
}
