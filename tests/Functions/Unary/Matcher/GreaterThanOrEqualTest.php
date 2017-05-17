<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\Matcher;

use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class GreaterThanOrEqualTest extends TestCase
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
        $subject = new GreaterThanOrEqual($subjectArgument);

        $result = $subject->__invoke($psiValue);

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
            [0,             0,              true],
            ['a',           'a',            true],

            // negatives
            [1,             0,              false],
            ['b',           'a',            false],
            ['100',         11,             false],
        ];
    }
}
