<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\Comparison;

use PeekAndPoke\Component\Psi\Functions\Unary\Comparison\GreaterThan;

/**
 * Test GreaterThan
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class GreaterThanTest extends \PHPUnit_Framework_TestCase
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
        $subject = new GreaterThan($subjectArgument);

        $result = $subject->apply($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            // positives
            [0,             1,              true],
            ['a',           'b',            true],
            [11,            '100',          true],

            // negatives
            [1,             0,              false],
            ['b',           'a',            false],
            ['100',         11,             false],

            [0,             0,              false],
            ['a',           'a',            false],
        ];
    }
}
