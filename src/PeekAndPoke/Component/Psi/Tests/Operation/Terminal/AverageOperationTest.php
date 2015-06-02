<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Operation\Terminal;

use PeekAndPoke\Component\Psi\Operation\Terminal\AverageOperation;

/**
 * Test AverageOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class AverageOperationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $input
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testOperation($input, $expectedResult)
    {
        $subject = new AverageOperation();

        $result = $subject->apply($input);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            [new \ArrayIterator([]),                0],
            [new \ArrayIterator([1]),               1],
            [new \ArrayIterator([1,1]),             1],
            [new \ArrayIterator([1,3]),             2],
            [new \ArrayIterator([['z']]),           0],
            [new \ArrayIterator([[1,'z']]),         0],
        ];
    }
}
