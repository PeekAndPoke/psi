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
class IsMatchingRegexIsNotMatchingRegexTest extends TestCase
{
    /**
     * @param $regex
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testIsMatchingRegex($regex, $input, $expected)
    {
        $subject = new IsMatchingRegex($regex);

        $this->assertSame($expected, $subject($input));
    }

    /**
     * @param $regex
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testIsMatchingRegexWithValueHolder($regex, $input, $expected)
    {
        $subject = new IsMatchingRegex(new GenericHolder($regex));

        $this->assertSame($expected, $subject($input));
    }

    /**
     * @param $regex
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testIsNotMatchingRegex($regex, $input, $expected)
    {
        $subject = new IsNotMatchingRegex($regex);

        $this->assertSame(! $expected, $subject($input));
    }

    /**
     * @param $regex
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testIsNotMatchingRegexWithValueHolder($regex, $input, $expected)
    {
        $subject = new IsNotMatchingRegex(new GenericHolder($regex));

        $this->assertSame(! $expected, $subject($input));
    }

    public function provide()
    {
        return [
            // positive cases
            ['/abc/', 'abc', true],
            ['/abc/i', 'ABC', true],
            ['/abc/i', ' ABC ', true],
            ['/^[0-9a-zA-Z]+$/', 'ABCabc123', true],
            ['/^[0-9A-Z]+$/i', 'ABCabc123', true],

            // positive cases
            ['/abc/', 'ABC', false],
            ['/^abc/i', ' ABC', false],
            ['/^abc/i', ' ABC ', false],
            ['/^[0-9A-Z]+$/i', ' ABCabc123', false],
            ['/^[0-9A-Z]+$/i', 'ABC-abc123', false],

            ['/^[0-9A-Z]+$/i', new UnitTestToString('ABC-abc123'), false],
        ];
    }
}
