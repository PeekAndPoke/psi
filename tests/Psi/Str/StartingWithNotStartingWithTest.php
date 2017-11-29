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
class StartingWithNotStartingWithTest extends TestCase
{
    /**
     * @param $search
     * @param $caseSensitive
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testStarting($search, $caseSensitive, $input, $expected)
    {
        $subject = new StartingWith($search, $caseSensitive);

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
    public function testStartingWithValueHolder($search, $caseSensitive, $input, $expected)
    {
        $subject = new StartingWith(new GenericHolder($search), new GenericHolder($caseSensitive));

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
    public function testNotStarting($search, $caseSensitive, $input, $expected)
    {
        $subject = new NotStartingWith($search, $caseSensitive);

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
    public function testNotStartingWithValueHolder($search, $caseSensitive, $input, $expected)
    {
        $subject = new NotStartingWith(new GenericHolder($search), new GenericHolder($caseSensitive));

        $this->assertSame(! $expected, $subject($input));
    }

    public function provide()
    {
        return [
            // positive cases
            ['abc', true, 'abc', true],
            ['abc', true, 'abc ', true],
            ['abc', true, 'abc a', true],

            // positive cases - not case insensitive
            ['ABC', false, 'abc ', true],
            ['abc', false, 'ABC ', true],

            // positive cases - empty needle is allowed
            ['', true, '', true],

            // negative cases
            ['ABC', true, ' abc', false],
            ['a', true, '', false],
            ['a', true, null, false],
            ['a', true, new \stdClass(), false],

            // negitive cases - input values must be string
            [null, true, '', false],
            [new \stdClass(), true, '', false],
            [new UnitTestToString('abc'), true, 'abc', false],
            ['abc', true, new UnitTestToString('abc'), false],
            ['0', true, 0, false],
        ];
    }
}
