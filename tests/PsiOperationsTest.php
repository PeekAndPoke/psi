<?php
/**
 * File was created 07.05.2015 07:51
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi;

use PeekAndPoke\Component\Psi\Stubs\UnitTestPsiObject;
use PHPUnit\Framework\TestCase;

/**
 * PsiOperationsTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiOperationsTest extends TestCase
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////  INTERMEDIATE OPERATIONS
    ////////

    ////  filter()  ////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     */
    public function testFilterWithEmptyInput()
    {
        $input    = [];
        $expected = [];

        $result = Psi::it($input)
            ->filter(function ($i) { return $i > 2; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testFilterWithArray()
    {
        $input    = [1, 2, 3, 4];
        $expected = [3, 4];

        $result = Psi::it($input)
            ->filter(function ($i) { return $i > 2; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testFilterWithKeyValues()
    {
        $input    = ['a' => 1, 'b' => 2, 'c' => 3];
        $expected = [3];

        $result = Psi::it($input)
            ->filter(function ($i) { return $i > 2; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    ////  filterKey()  /////////////////////////////////////////////////////////////////////////////////////////////////

    public function testFilterKeyWithEmptyInput()
    {
        $input    = [];
        $expected = [];

        $result = Psi::it($input)
            ->filterKey(function ($k) { return $k > 2; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testFilterKeyWithArray()
    {
        $input    = [1, 2, 3, 4];
        $expected = [3, 4];

        $result = Psi::it($input)
            ->filterKey(function ($k) { return $k >= 2; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testFilterKeyWithKeyValues()
    {
        $input    = ['a' => 1, 'b' => 2, 'c' => 3];
        $expected = [3];

        $result = Psi::it($input)
            ->filterKey(function ($i) { return $i === 'c'; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    ////  filterValueKey()  /////////////////////////////////////////////////////////////////////////////////////////////////

    public function testFilterKeyValueWithEmptyInput()
    {
        $input    = [];
        $expected = [];

        $result = Psi::it($input)
            ->filterValueKey(function ($v, $k) { return $v > 2 && $k > 2; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testFilterValueKeyWithArray()
    {
        $input    = [1, 2, 3, 4];
        $expected = [3, 4];

        $result = Psi::it($input)
            ->filterValueKey(function ($v, $k) { return $v === 4 || $k === 2; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testFilterKeyValueWithKeyValues()
    {
        $input    = ['a' => 1, 'b' => 2, 'c' => 3];
        $expected = [2, 3];

        $result = Psi::it($input)
            ->filterValueKey(function ($v, $k) { return $k === 'c' || $v === 2; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    ////  anyMatch()  //////////////////////////////////////////////////////////////////////////////////////////////////

    public function testAnyMatchWithEmptyInput()
    {
        $input    = [];
        $expected = [];

        $result = Psi::it($input)
            ->anyMatch(function ($v) { return $v > 2; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testAnyMatchFitFirst()
    {
        $input    = [1, 2, 3];
        $expected = [1];

        $result = Psi::it($input)
            ->anyMatch(function () { return true; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testAnyMatchFitLast()
    {
        $input    = [1, 2, 3];
        $expected = [1, 2, 3];

        $result = Psi::it($input)
            ->anyMatch(function ($v) { return $v === 3; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testAnyMatchFitNone()
    {
        $input    = [1, 2, 3];
        $expected = [1, 2, 3];

        $result = Psi::it($input)
            ->anyMatch(function () { return false; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    ////  each()  //////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testEachWithEmptyInput()
    {
        $input    = [];
        $expected = [];

        $result = Psi::it($input)
            ->each(function (UnitTestPsiObject $v) { /* noop */ })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    /**
     *
     */
    public function testEachWithInput()
    {
        $input = [
            $karl = new UnitTestPsiObject('Karl', 50),
            $edgar = new UnitTestPsiObject('Edgar', 10),
            $heidi = new UnitTestPsiObject('Heidi', 52),
        ];

        $str = '';

        Psi::it($input)->each(function (UnitTestPsiObject $v) use (&$str) {
            $v->incAge(1);
            $str .= $v->getName();
        })->collect();

        $this->assertSame('KarlEdgarHeidi', $str);
        $this->assertSame(50 + 1, $karl->getAge());
        $this->assertSame(10 + 1, $edgar->getAge());
        $this->assertSame(52 + 1, $heidi->getAge());
    }

    ////  map()  ///////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testMapWithEmptyInput()
    {
        $input    = [];
        $expected = [];

        $result = Psi::it($input)
            ->map(function ($v) { return $v * 2; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testMapWithInput()
    {
        $input    = [1, 2, 3, 4];
        $expected = [2, 4, 6, 8];

        $result = Psi::it($input)
            ->map(function ($v) { return $v * 2; })
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testMapWithKeyedInput()
    {
        $input    = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
        $expected = ['a' => 2, 'b' => 4, 'c' => 6, 'd' => 8];

        $result = Psi::it($input)
            ->map(function ($v) { return $v * 2; })
            ->toKeyValueArray();

        $this->assertSame($expected, $result);
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////  FULL SET OPERATIONS
    ////////

    //// flatten()  ////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testFlattenWithEmptyInput()
    {
        $input    = [];
        $expected = [];

        $result = Psi::it($input)
            ->flatten()
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testFlattenWithInput()
    {
        $input    = [1, [2, [3, 4], 5], 6];
        $expected = [1, 2, 3, 4, 5, 6];

        $result = Psi::it($input)
            ->flatten()
            ->toArray();

        $this->assertSame($expected, $result);
    }

    public function testFlattenWithKeyValueInput()
    {
        $input    = ['a' => 1, ['b' => 2, ['c' => 3, 'd' => 4], 'e' => 5], 'f' => 6];
        $expected = [1, 2, 3, 4, 5, 6];

        $result = Psi::it($input)
            ->flatten()
            ->toArray();

        $this->assertSame($expected, $result);
    }

    ////  sort()  //////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param array $input
     * @param int   $flags
     * @param array $expected
     *
     * @dataProvider provideTestSort
     */
    public function testSort($input, $flags, $expected)
    {
        $result = Psi::it($input)
            ->sort($flags)
            ->toArray();

        $this->assertSame($expected, $result);
    }

    /**
     * @return array
     */
    public static function provideTestSort()
    {
        return [
            [
                ['1', '2', '10'],
                null,
                ['1', '2', '10'],
            ],
            [
                ['1a', '2a', '10a'],
                null,
                ['10a', '1a', '2a'],
            ],
            [
                ['1a', '2a', '10a'],
                SORT_NATURAL,
                ['1a', '2a', '10a'],
            ],
        ];
    }

    ////  sort()  //////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testSortBy()
    {
        $input = [
            $klara = new UnitTestPsiObject('Klara', 4),
            $edgar = new UnitTestPsiObject('Edgar', 3),
            $anna = new UnitTestPsiObject('Anna', 3),
            $me = new UnitTestPsiObject('Me', 38),
        ];

        $result = Psi::it($input)
            ->sortBy(function (UnitTestPsiObject $o) { return $o->getAge(); })
            ->toArray();

        $this->assertSame([$anna, $edgar, $klara, $me], $result);
    }

    public function testSortByReversed()
    {
        $input = [
            $klara = new UnitTestPsiObject('Klara', 4),
            $edgar = new UnitTestPsiObject('Edgar', 3),
            $anna = new UnitTestPsiObject('Anna', 3),
            $me = new UnitTestPsiObject('Me', 38),
        ];

        $result = Psi::it($input)
            ->sortBy(function (UnitTestPsiObject $o) { return $o->getAge(); })
            ->reverse()
            ->toArray();

        $this->assertSame([$me, $klara, $edgar, $anna], $result);
    }

    ////  groupBy()  //////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testGroupBy()
    {
        $input = ['adam', 'caesar', 'bruno', 'alexa', 'berta'];
        // in the result the we expect the keys to be ordered a, c, b
        $expected = ['a' => ['adam', 'alexa'], 'c' => ['caesar'], 'b' => ['bruno', 'berta']];

        $result = Psi::it($input)
            ->groupBy(function ($v) { return $v[0]; })
            ->toKeyValueArray();

        $this->assertSame($expected, $result);
    }

    public function testGroupByAndKSort()
    {
        $input = ['adam', 'caesar', 'bruno', 'alexa', 'berta'];
        // in the result the we expect the keys to be ordered a, c, b
        $expected = ['a' => ['adam', 'alexa'], 'b' => ['bruno', 'berta'], 'c' => ['caesar']];

        $result = Psi::it($input)
            ->groupBy(function ($v) { return $v[0]; })
            ->ksort()
            ->toKeyValueArray();

        $this->assertSame($expected, $result);
    }

    public function testGroupByReturningInts()
    {
        $input = ['adam', 'caesar', 'bruno', 'alexa', 'berta'];
        // in the result the we expect the keys to be ordered a, c, b
        $expected = [0 => ['adam', 'alexa'], 2 => ['caesar'], 1 => ['bruno', 'berta']];

        $result = Psi::it($input)
            ->groupBy(function ($v) { return ord($v[0]) - 97; })
            ->toKeyValueArray();

        $this->assertSame($expected, $result);
    }

    public function testGroupByReturningIntsAndKSort()
    {
        $input = ['adam', 'caesar', 'bruno', 'alexa', 'berta'];
        // in the result the we expect the keys to be ordered a, c, b
        $expected = [0 => ['adam', 'alexa'], 1 => ['bruno', 'berta'], 2 => ['caesar']];

        $result = Psi::it($input)
            ->groupBy(function ($v) { return ord($v[0]) - 97; })
            ->ksort()
            ->toKeyValueArray();

        $this->assertSame($expected, $result);
    }

    public function testGroupByAndThenMap()
    {
        $input = ['adam', 'caesar', 'bruno', 'alexa', 'berta'];
        // in the result the we expect the keys to be ordered a, c, b
        $expected = ['a' => 2, 'c' => 1, 'b' => 2];

        $result = Psi::it($input)
            ->groupBy(function ($v) { return $v[0]; })
            ->map(function ($v) { return count($v); })
            ->toKeyValueArray();

        $this->assertSame($expected, $result);
    }

    public function testGroupByAndThenMapAndKSort()
    {
        $input = ['adam', 'caesar', 'bruno', 'alexa', 'berta'];
        // in the result the we expect the keys to be ordered a, c, b
        $expected = ['a' => 2, 'b' => 2, 'c' => 1];

        $result = Psi::it($input)
            ->groupBy(function ($v) { return $v[0]; })
            ->map(function ($v) { return count($v); })
            ->ksort()
            ->toKeyValueArray();

        $this->assertSame($expected, $result);
    }
}
