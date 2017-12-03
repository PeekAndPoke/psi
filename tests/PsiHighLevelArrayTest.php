<?php
/**
 * File was created 07.05.2015 07:51
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi;

use PeekAndPoke\Component\Psi\Psi\Num\IsMultipleOf;
use PHPUnit\Framework\TestCase;

/**
 * PsiHighLevelArrayTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiHighLevelArrayTest extends TestCase
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
        $result = Psi::it($input)->toArray();

        if ($expectMatch) {
            $this->assertSame($expectedOutput, $result);
        } else {
            $this->assertNotSame($expectedOutput, $result);
        }
    }

    /**
     * @return array
     */
    public function provideTestWithNoOperation()
    {
        return [
            [
                [],
                [],
                true,
            ],
            [
                [1],
                [1],
                true,
            ],
            [
                [0],
                [1],
                false,
            ],
            [
                [1, 2],
                [1, 2],
                true,
            ],
            [
                [1, 2],
                [2, 1],
                false,
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
            ->toArray();

        $this->assertSame($expected, $result);
    }

    ////  TEST FULL SET OPERATIONS  ////////////////////////////////////////////////////////////////////////////////////

    public function testChunkOperation()
    {
        $result = Psi::it(range(0, 10))
            ->chunk(3)
            ->toArray();

        $this->assertSame(
            [[0, 1, 2], [3, 4, 5], [6, 7, 8], [9, 10]],
            $result
        );
    }

    public function testFlattenOperation()
    {
        $input    = [
            [
                [
                    1,
                    2,
                    3,
                ],
                [
                    'y' => 4,
                    5,
                    1   => [
                        6,
                        7,
                    ],
                ],
                8,
            ],
        ];
        $expected = [1, 2, 3, 4, 5, 6, 7, 8];

        $result = Psi::it($input)
            ->flatten()
            ->toArray();

        $this->assertSame($expected, $result);
    }

    // TODO: test value-sort operations

    public function testKsortOperation()
    {
        $input    = ['z' => 1, 'a' => 2];
        $expected = ['a' => 2, 'z' => 1];

        $result = Psi::it($input)->ksort()->toKeyValueArray();

        $this->assertSame($expected, $result);
    }

    public function testKRsortOperation()
    {
        $input    = ['a' => 1, 'z' => 2];
        $expected = ['z' => 2, 'a' => 1];

        $result = Psi::it($input)->krsort()->toKeyValueArray();

        $this->assertSame($expected, $result);
    }

    public function testUKsortOperation()
    {
        $input    = ['z' => 1, 'a' => 2];
        $expected = ['a' => 2, 'z' => 1];

        $result = Psi::it($input)->uksort(function ($a, $b) { return $a > $b; })->toKeyValueArray();

        $this->assertSame($expected, $result);
    }

    public function testReverseOperation()
    {
        $input    = [1, 2];
        $expected = [2, 1];

        $result = Psi::it($input)->reverse()->toArray();

        $this->assertSame($expected, $result);
    }

    public function testLimitOperation()
    {
        $result = Psi::it(range(0, 20))
            ->filter(new IsMultipleOf(2))
            ->limit(0)
            ->toArray();

        $this->assertSame(
            [],
            $result
        );

        $result = Psi::it(range(0, 20))
            ->filter(new IsMultipleOf(2))
            ->limit(5)
            ->toArray();

        $this->assertSame(
            [0, 2, 4, 6, 8],
            $result
        );

        $result = Psi::it(range(0, 20))
            ->filter(new IsMultipleOf(2))
            ->limit(5)
            ->limit(2)
            ->toArray();

        $this->assertSame(
            [0, 2],
            $result
        );
    }

    public function testSkipOperation()
    {
        $result = Psi::it(range(0, 20))
            ->filter(new IsMultipleOf(2))
            ->skip(0)
            ->toArray();

        $this->assertSame(
            [0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20],
            $result
        );

        $result = Psi::it(range(0, 20))
            ->filter(new IsMultipleOf(2))
            ->skip(5)
            ->toArray();

        $this->assertSame(
            [10, 12, 14, 16, 18, 20],
            $result
        );

        $result = Psi::it(range(0, 30))
            ->filter(new IsMultipleOf(2))
            ->skip(5) // skips 0, 2, 4, 6, 8
            ->filter(new IsMultipleOf(4))
            ->skip(2) // skips 12, 16
            ->toArray();

        $this->assertSame(
            [20, 24, 28],
            $result
        );
    }

    public function testSkipLimitCombination()
    {
        $result = Psi::it(range(0, 20))
            ->filter(new IsMultipleOf(2))
            ->skip(5)
            ->limit(3)
            ->toArray();

        $this->assertSame(
            [10, 12, 14],
            $result
        );

        $result = Psi::it(range(0, 30))
            ->filter(new IsMultipleOf(2))
            ->skip(5) // skips 0, 2, 4, 6, 8
            ->filter(new IsMultipleOf(4))
            ->limit(3) // limits to 12, 16, 20
            ->toArray();

        $this->assertSame(
            [12, 16, 20],
            $result
        );
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
            ->toArray();

        $this->assertSame($expected, $result);
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
            ->toArray();

        $this->assertSame($expected, $result);
    }


    /**
     * Test that filtering by key works as well
     */
    public function testScenario003()
    {
        $input    = [10, 20, 30, 40, 50, 60, 70];
        $expected = [10, 40, 70];

        $result = Psi::it($input)
            ->filterKey(function ($k) { return $k % 3 === 0; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    /**
     * Test that filtering by key and value works as well
     */
    public function testScenario004()
    {
        $input    = [10, 20, 30, 40, 50, 60, 70];
        $expected = [40, 70];

        $result = Psi::it($input)
            ->filter(function ($v, $k) { return $k % 3 === 0 && $v > 30; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    /**
     * Test that combining multiple inputs works
     */
    public function testScenario005()
    {
        $input    = [10, 20];
        $input2   = [30, 40];
        $expected = [10, 20, 30, 40];

        $result = Psi::it($input, $input2)
            ->toArray();

        $this->assertSame($expected, $result);
    }

    /**
     * Test the combination of multiple intermediate operators and their execution order
     */
    public function testScenario100()
    {
        $input    = [1, 10, 2, 9, 3, 8, 4, 7, 5, 6];
        $expected = [11, 91, 31, 71, 51];

        $result = Psi::it($input)
            ->map(function ($i) { return $i * 10; })
            ->filter(function ($i) { return $i % 20; })
            ->map(function ($i) { return $i + 1; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    /**
     * Test the combination of multiple intermediate operators and their execution order once more
     */
    public function testScenario101()
    {
        $input    = [1, 10, 2, 9, 3, 8, 4, 7, 5, 6];
        $expected = [11, 19, 13, 17, 15];

        $result = Psi::it($input)
            ->map(function ($i) { return $i * 1; })
            ->filter(function ($i) { return $i % 2; })
            ->map(function ($i) { return $i + 10; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    /**
     * Test continuation after intermediate operation
     */
    public function testScenario102()
    {
        $input    = [1, 2, 10, 2, 9, 3, 8, 4, 7, 5, 6];
        $expected = [2, 4];

        $result = Psi::it($input)
            ->map(function ($i) { return $i * 2; })
            ->takeUntil(function ($i) { return $i >= 20; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    /**
     * Test continuation after intermediate operation with different execution order
     */
    public function testScenario103()
    {
        $input    = [1, 2, 10, 2, 9, 3, 8, 4, 7, 5, 6];
        $expected = [2, 4];

        $result = Psi::it($input)
            ->takeUntil(function ($i) { return $i >= 10; })
            ->map(function ($i) { return $i * 2; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    /**
     * Test the combination of intermediate and full set operators and their execution order
     */
    public function testScenario104()
    {
        $input    = [1, 1, 5, 10, 10, 2, 2, 9, 9, 15, 3, 3];
        $expected = [5, 1];

        $result = Psi::it($input)
            ->takeUntil(function ($i) { return $i >= 15; })// removes the last three [15, 3, 3]
            ->map(function ($i) { return $i * 2; })// multiple all by 2
            ->unique()
            ->takeUntil(function ($i) { return $i >= 15; })// removes all after and including [10 * 2]
            ->map(function ($i) { return $i / 2; })// divide by 2
            ->rsort()
            ->toArray();

        $this->assertSame($expected, $result);
    }
}
