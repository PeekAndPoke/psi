<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PHPUnit\Framework\TestCase;


/**
 * Test CollectToKeyValueArrayOperationTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class CollectToKeyValueArrayOperationTest extends TestCase
{
    /**
     * @param $input
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testOperation($input, $expectedResult)
    {
        $subject = new CollectToKeyValueArrayOperation();

        $result = $subject->apply(new \ArrayIterator($input));

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            [[],                []],
            [[1],               [0 => 1]],
            [[1,1],             [0 => 1, 1 => 1]],
            [[1,3],             [0 => 1, 1 => 3]],
            [[['z']],           [0 => ['z']]],
            [[1,'z'],           [0 => 1, 1 => 'z']],

            // The keys must stay as they are
            [[0 => 1, 5 => 2],   [0 => 1, 5 => 2]]
        ];
    }
}
