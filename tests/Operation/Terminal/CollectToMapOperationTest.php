<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\Stubs\UnitTestPsiObject;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class CollectToMapOperationTest extends TestCase
{
    /**
     * @param $input
     * @param $expectedResult
     *
     * @dataProvider provideTestOperationWithoutValueMapper
     */
    public function testOperationWithoutValueMapper($input, $expectedResult)
    {
        $subject = new CollectToMapOperation(
            function (UnitTestPsiObject $o) { return $o->getName(); }
        );

        $result = $subject->apply(new \ArrayIterator($input));

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provideTestOperationWithoutValueMapper()
    {
        return [
            [[], []],
            [
                [
                    $o1 = new UnitTestPsiObject('a', 10),
                ],
                [
                    'a' => $o1,
                ],
            ],
            [
                [
                    $o1 = new UnitTestPsiObject('a', 10),
                    $o2 = new UnitTestPsiObject('a', 20),
                ],
                [
                    'a' => $o2,
                ],
            ],
            [
                [
                    $o1 = new UnitTestPsiObject('a', 10),
                    $o2 = new UnitTestPsiObject('b', 20),
                ],
                [
                    'a' => $o1,
                    'b' => $o2,
                ],
            ],
        ];
    }

    /**
     * @param $input
     * @param $expectedResult
     *
     * @dataProvider provideTestOperationWithValueMapper
     */
    public function testOperationWithValueMapper($input, $expectedResult)
    {
        $subject = new CollectToMapOperation(
            function (UnitTestPsiObject $o) { return $o->getName(); },
            function (UnitTestPsiObject $o) { return $o->getAge(); }
        );

        $result = $subject->apply(new \ArrayIterator($input));

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provideTestOperationWithValueMapper()
    {
        return [
            [[], []],
            [
                [
                    new UnitTestPsiObject('a', 10),
                ],
                [
                    'a' => 10,
                ],
            ],
            [
                [
                    new UnitTestPsiObject('a', 10),
                    new UnitTestPsiObject('a', 20),
                ],
                [
                    'a' => 20,
                ],
            ],
            [
                [
                    new UnitTestPsiObject('a', 10),
                    new UnitTestPsiObject('b', 20),
                ],
                [
                    'a' => 10,
                    'b' => 20,
                ],
            ],
        ];
    }
}
