<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class MedianOperationTest extends TestCase
{
    /**
     * @param $input
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testOperation($input, $expectedResult)
    {
        $subject = new MedianOperation();

        $result = $subject->apply(new \ArrayIterator($input));

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            [[], 0],
            [[1], 1],
            [[1, 1], 1],
            [[1, 1, 2], 1],
            [[1, 1, 2, 2], 1.5],
            [[2, 2, 1, 1], 1.5],
            [[1, 2, 1, 2], 1.5],
            [[2, 1, 1, 2], 1.5],
            [[1, 10, 20, 1000], 15],

            // invalid input
            [[['z']], 0],
            [[[1, 'z']], 0],
            [[[1, 'z'], 2, 2, [10]], 0],
        ];
    }
}
