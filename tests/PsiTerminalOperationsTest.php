<?php
/**
 * Created by gerk on 27.11.17 06:04
 */

namespace PeekAndPoke\Component\Psi;

use PeekAndPoke\Component\Psi\Stubs\UnitTestPsiObject;
use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiTerminalOperationsTest extends TestCase
{
    ////  TERMINAL min()  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testMinTerminalOperation()
    {
        $input    = [2, 1, 2, 3, 2, 1, 2];
        $expected = 1;

        $result = Psi::it($input)->min();

        $this->assertEquals($expected, $result);
    }

    ////  TERMINAL max()  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testMaxTerminalOperation()
    {
        $input    = [2, 1, 2, 3, 2, 1, 2];
        $expected = 3;

        $result = Psi::it($input)->max();

        $this->assertEquals($expected, $result);
    }

    ////  TERMINAL sum()  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testSumTerminalOperation()
    {
        $input    = [1, 2, 3];
        $expected = 6;

        $result = Psi::it($input)->sum();

        $this->assertEquals($expected, $result);
    }

    ////  TERMINAL avg()  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testAvgTerminalOperation()
    {
        $input    = [1, 2, 3];
        $expected = 2;

        $result = Psi::it($input)->avg();

        $this->assertEquals($expected, $result);
    }

    ////  TERMINAL median()  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testMedianTerminalOperation()
    {
        $input    = [1, 2, 3];
        $expected = 2;

        $result = Psi::it($input)->median();

        $this->assertEquals($expected, $result);
    }

    public function testMedianTerminalOperation2()
    {
        $input    = [1, 2, 3, 4];
        $expected = 2.5;

        $result = Psi::it($input)->median();

        $this->assertEquals($expected, $result);
    }

    public function testMedianTerminalOperation3()
    {
        $input    = [1, 2, 2, 4];
        $expected = 2;

        $result = Psi::it($input)->median();

        $this->assertEquals($expected, $result);
    }

    ////  TERMINAL count()  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testCountTerminalOperation()
    {
        $input    = [1, 2, 3];
        $expected = 3;

        $result = Psi::it($input)->count();

        $this->assertEquals($expected, $result);
    }

    ////  TERMINAL join()  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testJoinOperation()
    {
        $input    = [1, 2, 3];
        $expected = '1,2,3';

        $result = Psi::it($input)->join(',');

        $this->assertEquals($expected, $result);
    }

    ////  COLLECT toArray()  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testToArrayOperation()
    {
        $input    = [1, 2, 3];
        $expected = [2, 4, 6];

        $result = Psi::it($input)->map(function ($i) { return $i * 2; })->toArray();

        $this->assertTrue(is_array($result));
        $this->assertEquals($expected, $result);
    }


    ////  COLLECT toMap()  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param $input
     * @param $expectedResult
     *
     * @dataProvider provideTestToMapWithoutValueMapper
     */
    public function testToMapWithoutValueMapper($input, $expectedResult)
    {
        $result = Psi::it($input)
            ->toMap(
                function (UnitTestPsiObject $o) { return $o->getName(); }
            );

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provideTestToMapWithoutValueMapper()
    {
        return [
            [[], []],
            [
                [
                    $o1 = new UnitTestPsiObject('a', 10),
                ],
                [
                    'a' => $o1,
                ],
            ],
            [
                [
                    $o1 = new UnitTestPsiObject('a', 10),
                    $o2 = new UnitTestPsiObject('a', 20),
                ],
                [
                    'a' => $o2,
                ],
            ],
            [
                [
                    $o1 = new UnitTestPsiObject('a', 10),
                    $o2 = new UnitTestPsiObject('b', 20),
                ],
                [
                    'a' => $o1,
                    'b' => $o2,
                ],
            ],
        ];
    }

    /**
     * @param $input
     * @param $expectedResult
     *
     * @dataProvider provideTestToMapWithValueMapper
     */
    public function testToMapWithValueMapper($input, $expectedResult)
    {
        $result = Psi::it($input)
            ->toMap(
                function (UnitTestPsiObject $o) { return $o->getName(); },
                function (UnitTestPsiObject $o) { return $o->getAge(); }
            );

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provideTestToMapWithValueMapper()
    {
        return [
            [[], []],
            [
                [
                    new UnitTestPsiObject('a', 10),
                ],
                [
                    'a' => 10,
                ],
            ],
            [
                [
                    new UnitTestPsiObject('a', 10),
                    new UnitTestPsiObject('a', 20),
                ],
                [
                    'a' => 20,
                ],
            ],
            [
                [
                    new UnitTestPsiObject('a', 10),
                    new UnitTestPsiObject('b', 20),
                ],
                [
                    'a' => 10,
                    'b' => 20,
                ],
            ],
        ];
    }


}
