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
class IsDateStringTest extends TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsDateString($psiValue, $expectedResult)
    {
        $subject = new IsDateString();

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
            ['2015-01-01',                    true],
            ['12345-01-01',                   true],
            ['2015-01-01 12:00',              true],
            ['2015-01-01 24:59:59',           true],
            ['2015-01-01 12:00:00',           true],
            ['2015-01-01T12:00:00',           true],
            ['2015-01-01T12:00:00+00:00',     true],
            ['2015-01-01T12:00:00-00:00',     true],
            ['2015-01-01T12:00:00+10:00',     true],
            ['2015-01-01T12:00:00-10:00',     true],
            ['2015-01-01T12:00:00.000+00:00', true],
            ['2015-01-01T12:00:00.000-00:00', true],
            ['2015-01-01T12:00:00.000+10:00', true],
            ['2015-01-01T12:00:00.000-10:00', true],
            ['2015-01-01T12:00:00.000Z',      true],

            // negatives
            [null,                              false],
            [[],                                false],
            [new \stdClass(),                   false],
            ['ABC',                             false],
            ['2015-13-01',                      false],
            ['2015-12-32',                      false],
            ['2015-01-01 25:00:00',             false],

//            [1,             0,              false],
//            ['b',           'a',            false],
//            ['100',         11,             false],
//
//            [0,             0,              false],
//            ['a',           'a',            false],
        ];
    }
}
