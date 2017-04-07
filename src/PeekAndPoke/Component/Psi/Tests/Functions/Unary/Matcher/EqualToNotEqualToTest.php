<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\Matcher;

use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\EqualTo;
use PeekAndPoke\Component\Psi\Functions\Unary\Matcher\NotEqualTo;
use PeekAndPoke\Component\Psi\Tests\Mocks\MockA;
use PeekAndPoke\Component\Psi\Tests\Mocks\MockB;
use PeekAndPoke\Component\Psi\Tests\Mocks\ToStringMock;

/**
 * Test EqualTo and NotEqualTo
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class EqualToNotEqualToTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $subjectArgument
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testEqualTo($subjectArgument, $psiValue, $expectedResult)
    {
        $subject = new EqualTo($subjectArgument);

        $result = $subject($psiValue);

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
        $expectedResult = !$expectedResult;

        $subject = new NotEqualTo($subjectArgument);

        $result = $subject($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            // positives - ensure substitution

            [1,             '1',            true],
            ['1',           1,              true],

            // positives

            [null,          null,           true],
            [true,          true,           true],
            [false,         false,          true],
            [new MockA(),   new MockA(),    true],

            [0,             null,           true],
            [0,             false,          true],
            [0,             '',             true],
            [0,             '0',            true],
            [0.0,           0,              true],
            [0.0,           '0',            true],
            [0.0,           '0.0',          true],
            [0,             '00',           true],
            [0,             '0x',           true],
            [1,             true,           true],
            [1,             1.0,            true],
            [1,             '1',            true],
            [1,             '1x',           true],

            // test magic __toString is invoked when comparing with "=="
            ['A',           new ToStringMock('A'), true],

            // positives curiosities

            [0,             'x1',           true],

            // negatives
            [0,             1,              false],
            ['0',           'x1',           false],
            [new MockA(),   new MockB(),    false],
        ];
    }
}
