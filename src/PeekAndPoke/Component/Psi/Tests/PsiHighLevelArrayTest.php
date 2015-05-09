<?php
/**
 * File was created 07.05.2015 07:51
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests;

use PeekAndPoke\Component\Psi\Psi;

/**
 * PsiHighLevelArrayTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiHighLevelArrayTest extends AbstractPsiTest
{
    /**
     * @param array $input
     * @param array $expectedOutput
     * @param bool  $expectMatch
     *
     * @throws \PeekAndPoke\Component\Psi\Exception\PsiException
     *
     * @dataProvider provideTestWithNoOperation
     */
    public function testWithNoOperation($input, $expectedOutput, $expectMatch)
    {
        $result = Psi::it($input)->collect();

        if ($expectMatch) {
            $this->assertPsiCollectOutputMatches($expectedOutput, $result);
        } else {
            $this->assertPsiCollectOutputDoesNotMatches($expectedOutput, $result);
        }
    }

    /**
     * @return array
     */
    public function provideTestWithNoOperation()
    {
        return [
            [
                [],                 [],             true
            ],
            [
                [1],                [1],            true
            ],
            [
                [0],                [1],            false
            ],
            [
                [1, 2],             [1, 2],         true
            ],
            [
                [1, 2],             [2, 1],         false
            ],
        ];
    }

    ////  INTERMEDIATE OPERATIONS  /////////////////////////////////////////////////////////////////////////////////////

    public function testMapWithKeyAndValue()
    {
        $input    = [2, 2, 2, 2, 2];
        $expected = [0, 2, 4, 6, 8];

        $result = Psi::it($input)
            ->map(function ($v, $k) { return $v * $k; })
            ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }

    ////  TEST FULL SET OPERATIONS  ////////////////////////////////////////////////////////////////////////////////////

    public function testFlatMapOperation()
    {
        $input = [
            [
                [
                    1, 2, 3
                ],
                [
                    'y' => 4,
                    5,
                    1 => [
                        6, 7
                    ]
                ],
                8
            ]
        ];
        $expected = [1, 2, 3, 4, 5, 6, 7, 8];

        $result = Psi::it($input)->flatMap()->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }

    ////  TERMINAL OPERATIONS  /////////////////////////////////////////////////////////////////////////////////////////

    public function testMinTerminalOperation()
    {
        $input = [2, 1, 2, 3, 2, 1, 2];
        $expected = 1;

        $result = Psi::it($input)->min();

        $this->assertEquals($expected, $result);
    }

    public function testMaxTerminalOperation()
    {
        $input = [2, 1, 2, 3, 2, 1, 2];
        $expected = 3;

        $result = Psi::it($input)->max();

        $this->assertEquals($expected, $result);
    }

    public function testSumTerminalOperation()
    {
        $input = [1, 2, 3];
        $expected = 6;

        $result = Psi::it($input)->sum();

        $this->assertEquals($expected, $result);
    }

    public function testAvgTerminalOperation()
    {
        $input = [1, 2, 3];
        $expected = 2;

        $result = Psi::it($input)->avg();

        $this->assertEquals($expected, $result);
    }

    ////  TEST SCENARIOS  //////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Test that filtering works
     */
    public function testScenario001()
    {
        $input    = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $expected = [1, 3, 5, 7, 9];

        $result = Psi::it($input)
            ->filter(function ($i) { return $i % 2; })
            ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }

    /**
     * Test that filtering works and keeps the order of items
     */
    public function testScenario002()
    {
        $input    = [1, 10, 2, 9, 3, 8, 4, 7, 5, 6];
        $expected = [1, 9, 3, 7, 5];

        $result = Psi::it($input)
                     ->filter(function ($i) { return $i % 2; })
                     ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }


    /**
     * Test that filtering by key works as well
     */
    public function testScenario003()
    {
        $input    = [10, 20, 30, 40, 50, 60, 70];
        $expected = [10, 40, 70];

        $result = Psi::it($input)
                     ->filterKey(function ($k) { return $k % 3 == 0; })
                     ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }

    /**
     * Test that filtering by key and value works as well
     */
    public function testScenario004()
    {
        $input    = [10, 20, 30, 40, 50, 60, 70];
        $expected = [40, 70];

        $result = Psi::it($input)
                     ->filterValueKey(function ($v, $k) { return $k % 3 == 0 && $v > 30; })
                     ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }

    /**
     * Test the combination of multiple intermediate operators and their execution order
     */
    public function testScenario100()
    {
        $input    = [1, 10, 2, 9, 3, 8, 4, 7, 5, 6];
        $expected = [11, 91, 31, 71, 51];

        $result = Psi::it($input)
            ->map(function ($i)    { return $i * 10; })
            ->filter(function ($i) { return $i % 20; })
            ->map(function ($i)    { return $i + 1;  })
            ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }

    /**
     * Test the combination of multiple intermediate operators and their execution order once more
     */
    public function testScenario101()
    {
        $input    = [1, 10, 2, 9, 3, 8, 4, 7, 5, 6];
        $expected = [11, 19, 13, 17, 15];

        $result = Psi::it($input)
                     ->map(function ($i)    { return $i * 1; })
                     ->filter(function ($i) { return $i % 2; })
                     ->map(function ($i)    { return $i + 10;  })
                     ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }

    /**
     * Test continuation after intermediate operation
     */
    public function testScenario102()
    {
        $input    = [1, 10, 2, 9, 3, 8, 4, 7, 5, 6];
        $expected = [2, 20];

        $result = Psi::it($input)
            ->map(function ($i)      { return $i * 2;  })
            ->anyMatch(function ($i) { return $i >= 20; })
            ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }

    /**
     * Test continuation after intermediate operation with different execution order
     */
    public function testScenario103()
    {
        $input    = [1, 10, 2, 9, 3, 8, 4, 7, 5, 6];
        $expected = [2, 20];

        $result = Psi::it($input)
            ->anyMatch(function ($i) { return $i >= 10; })
            ->map(function ($i)      { return $i * 2;   })
            ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);

    }
    /**
     * Test the combination of intermediate and full set operators and their execution order
     */
    public function testScenario104()
    {
        $input    = [1, 1, 10, 10, 2, 2, 9, 9, 15, 3, 3];
        $expected = [10, 1];

        $result = Psi::it($input)
            ->anyMatch(function ($i) { return $i >= 15; })  // removes the last two [3, 3]
            ->map(function ($i)      { return $i * 2;   })  // multiple all by 2
            ->unique()
            ->anyMatch(function ($i) { return $i >= 15; })  // removes all after [10 * 2, 10 * 2]
            ->map(function ($i)      { return $i / 2;   })  // divide by 2
            ->rsort()
            ->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }
}
