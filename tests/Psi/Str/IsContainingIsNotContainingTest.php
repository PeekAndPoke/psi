<?php
/**
 * File was created 08.02.2016 22:31
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

use PeekAndPoke\Component\Psi\Stubs\UnitTestToString;
use PeekAndPoke\Types\GenericHolder;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsContainingIsNotContainingTest extends TestCase
{
    /**
     * @param $search
     * @param $caseSensitive
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testContaining($search, $caseSensitive, $input, $expected)
    {
        $subject = new IsContaining($search, $caseSensitive);

        $this->assertSame($expected, $subject($input));
    }

    /**
     * @param $search
     * @param $caseSensitive
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testContainingWithValueHolder($search, $caseSensitive, $input, $expected)
    {
        $subject = new IsContaining(new GenericHolder($search), new GenericHolder($caseSensitive));

        $this->assertSame($expected, $subject($input));
    }

    /**
     * @param $search
     * @param $caseSensitive
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testNotContaining($search, $caseSensitive, $input, $expected)
    {
        $subject = new IsNotContaining($search, $caseSensitive);

        $this->assertSame(! $expected, $subject($input));
    }

    /**
     * @param $search
     * @param $caseSensitive
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testNotContainingValueHolder($search, $caseSensitive, $input, $expected)
    {
        $subject = new IsNotContaining(new GenericHolder($search), new GenericHolder($caseSensitive));

        $this->assertSame(! $expected, $subject($input));
    }

    public function provide()
    {
        return [
            // positive cases
            ['abc', true, 'abc', true],
            ['abc', true, 'abc ', true],
            ['abc', true, 'abc a', true],
            ['abc', true, ' abc a', true],

            // positive cases - not case insensitive
            ['ABC', false, 'abc ', true],
            ['ABC', false, ' abc ', true],
            ['abc', false, 'ABC ', true],
            ['abc', false, ' ABC ', true],

            // negative edge cases
            ['', true, '', false], // empty needle will have negative result
            ['', false, '', false], // empty needle will have negative result

            // negative cases
            ['ABC', true, 'cba', false],
            ['a', true, '', false],
            ['a', true, null, false],
            ['a', true, new \stdClass(), false],

            // negative cases - input values must be string
            [null, true, '', false],
            [new \stdClass(), true, '', false],
            [new UnitTestToString('abc'), true, 'abc', false],
            ['abc', true, new UnitTestToString('abc'), false],
            ['0', true, 0, false],
        ];
    }
}
