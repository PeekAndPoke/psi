<?php
/**
 * File was created 07.05.2015 07:51
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests;

use PeekAndPoke\Component\Psi\Psi;

/**
 * PsiOperationsTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiOperationsTest extends AbstractPsiTest
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////  INTERMEDIATE OPERATIONS
    ////////

    ////  filter()  ////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     */
    public function testFilterWithEmptyInput()
    {
        $input = [];
        $expected = [];

        $result = Psi::it($input)
            ->filter(function ($i) { return $i > 2; })->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testFilterWithArray()
    {
        $input = [1, 2, 3, 4];
        $expected = [3, 4];

        $result = Psi::it($input)
            ->filter(function ($i) { return $i > 2; })->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testFilterWithKeyValues()
    {
        $input = ['a' => 1, 'b' => 2, 'c' => 3];
        $expected = [3];

        $result = Psi::it($input)
            ->filter(function ($i) { return $i > 2; })->toArray();

        $this->assertEquals($expected, $result);
    }

    ////  filterKey()  /////////////////////////////////////////////////////////////////////////////////////////////////

    public function testFilterKeyWithEmptyInput()
    {
        $input = [];
        $expected = [];

        $result = Psi::it($input)
            ->filterKey(function ($k) { return $k > 2; })->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testFilterKeyWithArray()
    {
        $input = [1, 2, 3, 4];
        $expected = [3, 4];

        $result = Psi::it($input)
            ->filterKey(function ($k) { return $k >= 2; })->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testFilterKeyWithKeyValues()
    {
        $input = ['a' => 1, 'b' => 2, 'c' => 3];
        $expected = [3];

        $result = Psi::it($input)
            ->filterKey(function ($i) { return $i == 'c'; })->toArray();

        $this->assertEquals($expected, $result);
    }

    ////  filterKey()  /////////////////////////////////////////////////////////////////////////////////////////////////

    public function testFilterKeyValueWithEmptyInput()
    {
        $input = [];
        $expected = [];

        $result = Psi::it($input)
            ->filterValueKey(function ($v, $k) { return $v > 2 && $k > 2; })->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testFilterValueKeyWithArray()
    {
        $input = [1, 2, 3, 4];
        $expected = [3, 4];

        $result = Psi::it($input)
            ->filterValueKey(function ($v, $k) { return $v == 4 || $k == 2; })->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testFilterKeyValueWithKeyValues()
    {
        $input = ['a' => 1, 'b' => 2, 'c' => 3];
        $expected = [2, 3];

        $result = Psi::it($input)
                     ->filterValueKey(function ($v, $k) { return $k == 'c' || $v == 2; })->toArray();

        $this->assertEquals($expected, $result);
    }

    ////  anyMatch()  //////////////////////////////////////////////////////////////////////////////////////////////////

    public function testAnyMatchWithEmptyInput()
    {
        $input = [];
        $expected = [];

        $result = Psi::it($input)
            ->anyMatch(function ($v) { return $v > 2; })->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testAnyMatchFitFirst()
    {
        $input = [1, 2, 3];
        $expected = [1];

        $result = Psi::it($input)
            ->anyMatch(function () { return true; })->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testAnyMatchFitLast()
    {
        $input = [1, 2, 3];
        $expected = [1, 2, 3];

        $result = Psi::it($input)
            ->anyMatch(function ($v) { return $v == 3; })->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testAnyMatchFitNone()
    {
        $input = [1, 2, 3];
        $expected = [1, 2, 3];

        $result = Psi::it($input)
            ->anyMatch(function () { return false; })->toArray();

        $this->assertEquals($expected, $result);
    }

    ////  each()  //////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testEachWithEmptyInput()
    {
        $input = [];
        $expected = [];

        $result = Psi::it($input)
            ->each(function (PsiTestObject $v) { return $v->getAge() > 10; })->toArray();

        $this->assertEquals($expected, $result);
    }

    /**
     *
     */
    public function testEachWithInput()
    {
        $input = [
            $karl  = new PsiTestObject('Karl', 50),
            $edgar = new PsiTestObject('Edgar', 10),
            $heidi = new PsiTestObject('Heidi', 52),
        ];

        Psi::it($input)->each(function (PsiTestObject $v) { return $v->incAge(1); })->collect();

        $this->assertEquals(50 + 1, $karl->getAge());
        $this->assertEquals(10 + 1, $edgar->getAge());
        $this->assertEquals(52 + 1, $heidi->getAge());
    }

    ////  map()  ///////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testMapWithEmptyInput()
    {
        $input = [];
        $expected = [];

        $result = Psi::it($input)
            ->map(function ($v) { return $v * 2; })->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testMapWithInput()
    {
        $input = [1, 2, 3, 4];
        $expected = [2, 4, 6, 8];

        $result = Psi::it($input)
            ->map(function ($v) { return $v * 2; })->toArray();

        $this->assertEquals($expected, $result);
    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////  FULL SET OPERATIONS
    ////////

    //// flatten()  ////////////////////////////////////////////////////////////////////////////////////////////////////

    public function testFlattenWithEmptyInput()
    {
        $input = [];
        $expected = [];

        $result = Psi::it($input)->flatten()->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testFlattenWithInput()
    {
        $input = [1, [2, [3, 4], 5], 6];
        $expected = [1, 2, 3, 4, 5, 6];

        $result = Psi::it($input)->flatten()->toArray();

        $this->assertEquals($expected, $result);
    }

    public function testFlattenWithKeyValueInput()
    {
        $input = ['a' => 1, ['b' => 2, ['c' => 3, 'd' => 4], 'e' => 5], 'f' => 6];
        $expected = [1, 2, 3, 4, 5, 6];

        $result = Psi::it($input)->flatten()->toArray();

        $this->assertEquals($expected, $result);
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
        $result = Psi::it($input)->sort($flags)->toArray();

        $this->assertEquals($expected, $result);
    }

    public static function provideTestSort()
    {
        return [
            [
                ['1', '2', '10'], null, ['1', '2', '10'],
            ],
            [
                ['1a', '2a', '10a'], null, ['10a', '1a', '2a'],
            ],
            [
                ['1a', '2a', '10a'], SORT_NATURAL, ['1a', '2a', '10a'],
            ],
        ];
    }
}
