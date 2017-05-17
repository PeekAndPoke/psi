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
class LessThanTest extends TestCase
{
    /**
     * @param $subjectArgument
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testLessThan($subjectArgument, $psiValue, $expectedResult)
    {
        $subject = new LessThan($subjectArgument);

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
            [1,             0,              true],
            ['b',           'a',            true],
            ['100',         11,             true],

            // negatives
            [0,             1,              false],
            ['a',           'b',            false],
            [11,            '100',          false],

            [0,             0,              false],
            ['a',           'a',            false],
        ];
    }
}
