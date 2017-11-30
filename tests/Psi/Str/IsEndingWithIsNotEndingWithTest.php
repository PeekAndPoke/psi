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
class IsEndingWithIsNotEndingWithTest extends TestCase
{
    /**
     * @param $search
     * @param $caseSensitive
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testEnding($search, $caseSensitive, $input, $expected)
    {
        $subject = new IsEndingWith($search, $caseSensitive);

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
    public function testEndingWithValueHolder($search, $caseSensitive, $input, $expected)
    {
        $subject = new IsEndingWith(new GenericHolder($search), new GenericHolder($caseSensitive));

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
    public function testNotEnding($search, $caseSensitive, $input, $expected)
    {
        $subject = new IsNotEndingWith($search, $caseSensitive);

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
    public function testNotEndingWithValueHolder($search, $caseSensitive, $input, $expected)
    {
        $subject = new IsNotEndingWith(new GenericHolder($search), new GenericHolder($caseSensitive));

        $this->assertSame(! $expected, $subject($input));
    }

    public function provide()
    {
        return [
            // positive cases
            ['abc', true, 'abc', true],
            ['abc', true, ' abc', true],
            ['abc', true, 'a abc', true],

            // positive cases - not case sensitive
            ['ABC', false, 'a abc', true],
            ['abc', false, 'a ABC', true],

            // positive cases - empty needle is allowed
            ['', true, '', true],

            // negative cases
            ['abc', true, 'abc ', false],
            ['ABC', true, 'abc', false],
            ['ABC', true, 'abc ', false],
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
