<?php
/**
 * File was created 08.02.2016 22:31
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi\Num;

use PeekAndPoke\Component\Psi\Psi;
use PeekAndPoke\Types\GenericHolder;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsMultipleOfIsNotMultipleOfTest extends TestCase
{
    public function testMultiOfWithPsi()
    {
        $result = Psi::it([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
            ->filter(new IsMultipleOf(3))
            ->toArray();

        $this->assertSame([0, 3, 6, 9], $result);
    }

    /**
     * @param $factor
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testMultipleOf($factor, $input, $expected)
    {
        $subject = new IsMultipleOf($factor);

        $this->assertSame($expected, $subject($input));
    }

    /**
     * @param $factor
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testMultipleOfValueHolder($factor, $input, $expected)
    {
        $subject = new IsMultipleOf(new GenericHolder($factor));

        $this->assertSame($expected, $subject($input));
    }

    /**
     * @param $factor
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testNotMultipleOf($factor, $input, $expected)
    {
        $subject = new IsNotMultipleOf($factor);

        $this->assertSame(! $expected, $subject($input));
    }

    /**
     * @param $factor
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testNotMultipleOfValueHolder($factor, $input, $expected)
    {
        $subject = new IsNotMultipleOf(new GenericHolder($factor));

        $this->assertSame(! $expected, $subject($input));
    }

    public function provide()
    {
        return [
            // positive cases
            [1, -2, true],
            [1, -1, true],
            [1,  0, true],
            [1,  1, true],
            [1,  2, true],

            [2, -4, true],
            [2, -2, true],
            [2,  0, true],
            [2,  2, true],
            [2,  4, true],

            [1.11, -2.22, true],
            [1.11, -1.11, true],
            [1.11,  0,    true],
            [1.11,  1.11, true],
            [1.11,  2.22, true],

            [2,   '0', true],
            ['2', '0', true],

            // negative cases
            [2, -3, false],
            [2, -1, false],
            [2,  1, false],
            [2,  3, false],

            // wrong input
            [0, 0,  false],
            [new \stdClass(), 0, false],
            [1, new \stdClass(), false],
        ];
    }
}
