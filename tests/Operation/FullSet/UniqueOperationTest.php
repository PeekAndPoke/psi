<?php
/**
 * Created by gerk on 07.04.17 09:48
 */
use PeekAndPoke\Component\Psi\Operation\FullSet\UniqueOperation;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class UniqueOperationTest extends TestCase
{
    /**
     * @param $input
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testOperation($input, $expectedResult)
    {
        $subject = new UniqueOperation(true);

        $result = iterator_to_array(
            $subject->apply(new \ArrayIterator($input))
        );

        $this->assertSame($expectedResult, $result);
    }

    public static function provide()
    {
        $obj1 = new stdClass();
        $obj2 = new stdClass();

        return [
            [
                /* in */
                [],
                /* out */
                []
            ],
            [
                /* in */
                [1],
                /* out */
                [1]
            ],
            [
                /* in */
                [1, 1],
                /* out */
                [1]
            ],
            [
                /* in */
                [1, '1'],
                /* out */
                [1, '1']
            ],
            [
                /* in */
                [1, 2, 1],
                /* out */
                [1, 2]
            ],
            [
                /* in */
                [1, 2, 1 ,'a', 2, 'a'],
                /* out */
                [1, 2, 'a']
            ],
            [
                /* in */
                [$obj1],
                /* out */
                [$obj1]
            ],
            [
                /* in */
                [$obj1, $obj1, 1, $obj2, '2'],
                /* out */
                [$obj1, 1, $obj2, '2']
            ],
        ];
    }
}
