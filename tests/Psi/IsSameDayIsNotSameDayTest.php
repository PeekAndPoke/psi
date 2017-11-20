<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Types\LocalDate;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsSameDayIsNotSameDayTest extends TestCase
{
    /**
     * TODO: test for normal \DateTime as well
     *
     * @param $param
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsSameDay($param, $psiValue, $expectedResult)
    {
        $subject = new IsSameDay($param ? new LocalDate($param, 'Etc/UTC') : null);
        $result  = $subject->__invoke($psiValue ? new LocalDate($psiValue, 'Etc/UTC') : null);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\Matcher\IsSameDay($param ? new LocalDate($param, 'Etc/UTC') : null);
        $result  = $subject->__invoke($psiValue ? new LocalDate($psiValue, 'Etc/UTC') : null);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * TODO: test for normal \DateTime as well
     *
     * @param $param
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotSameDay($param, $psiValue, $expectedResult)
    {
        $expectedResult = !$expectedResult;

        $subject = new IsNotSameDay($param ? new LocalDate($param, 'Etc/UTC') : null);
        $result  = $subject->__invoke($psiValue ? new LocalDate($psiValue, 'Etc/UTC') : null);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\Matcher\IsNotSameDay($param ? new LocalDate($param, 'Etc/UTC') : null);
        $result  = $subject->__invoke($psiValue ? new LocalDate($psiValue, 'Etc/UTC') : null);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            // positives
            ['2015-01-01',          '2015-01-01',               true],
            ['2015-01-01',          '2015-01-01 00:00:01',      true],
            ['2015-01-01 00:00:00', '2015-01-01 23:59:59',      true],

            // negatives
            ['2015-01-01 00:00:00', null,                       false],
            [null,                  '2015-01-01 24:00:00',      false],
            ['2015-01-01 00:00:00', '2015-01-01 24:00:00',      false],
            ['2015-01-01 00:00:00', '2015-01-02 00:00:00',      false],
        ];
    }
}
