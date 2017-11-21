<?php
/**
 * Created by gerk on 20.11.17 17:34
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

use PeekAndPoke\Component\Psi\Mocks\ToStringMock;
use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ToStringTest extends TestCase
{
    /**
     * @param mixed       $input
     * @param string|null $expected
     *
     * @dataProvider provideTestSubject
     */
    public function testSubject($input, $expected)
    {
        $subject = new ToString();

        $this->assertSame($expected, $subject->__invoke($input));
    }

    public function provideTestSubject()
    {
        return [
            [null, ''],
            [new \stdClass(), ''],
            [new \DateTime(), ''],
            [0, '0'],
            [1, '1'],
            ['', ''],
            [' ', ' '],
            ['a', 'a'],
            ['B', 'B'],
            ['wOrLd-Wide', 'wOrLd-Wide'],
            [new ToStringMock('wOrLd-Wide'), 'wOrLd-Wide'],
        ];
    }
}
