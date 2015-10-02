<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\Matcher;

use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\NotSameAs;
use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\SameAs;
use PeekAndPoke\Component\Psi\Tests\Mocks\MockA;
use PeekAndPoke\Component\Psi\Tests\Mocks\MockB;
use PeekAndPoke\Component\Psi\Tests\Mocks\ToStringMock;

/**
 * Test SameAs and NotSameAs
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class SameAsNotSameAsTest extends \PHPUnit_Framework_TestCase
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
        $subject = new SameAs($subjectArgument);

        $result = $subject->__invoke($psiValue);

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
        $expectedResult = !$expectedResult;

        $subject = new NotSameAs($subjectArgument);

        $result = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        $mock = new MockA();

        return [
            // positives
            [0,             0,              true],
            ['0',           '0',            true],
            ['1',           '1',            true],
            [true,          true,           true],
            [$mock,         $mock,          true],

            // negatives - ensure substitution
            ['1',           '0',            false],
            ['0',           '1',            false],

            // negatives
            [0,             false,          false],
            [1,             true,           false],
            [1,             '1',            false],
            [0,             '0',            false],
            [0,             0.0,            false],
            [(int) 1.0,     (float) 1.0,    false],
            [new MockA(),   new MockB(),    false],

            // test magic __toString is NOT invoked when comparing with "==="
            ['A',           new ToStringMock('A'), false],
        ];
    }
}
