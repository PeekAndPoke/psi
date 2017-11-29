<?php
/**
 * Created by gerk on 07.04.17 09:48
 */

namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\Psi;
use PeekAndPoke\Component\Psi\Psi\Map\Identity;
use PeekAndPoke\Component\Psi\Psi\ToInteger;
use PeekAndPoke\Component\Psi\Psi\ToString;
use PeekAndPoke\Component\Psi\Stubs\UnitTestPsiObject;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class UniqueByOperationTest extends TestCase
{
    /**
     * @param $mapper
     * @param $input
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testOperation($mapper, $input, $expectedResult)
    {
        $subject = new UniqueByOperation($mapper, true);

        $result = $subject->apply(new \ArrayIterator($input));

        $this->assertSame($expectedResult, $result->getArrayCopy());
    }

    /**
     * @param $mapper
     * @param $input
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testWithPsi($mapper, $input, $expectedResult)
    {
        $result = Psi::it($input)
            ->uniqueBy($mapper)
            ->toArray();

        $this->assertSame($expectedResult, $result);
    }

    public static function provide()
    {
        $obj1 = new UnitTestPsiObject('Karl', 10);
        $obj2 = new UnitTestPsiObject('Karlotta', 10);

        return [
            [
                /* in */
                new Identity(),
                [],
                /* out */
                [],
            ],
            [
                /* in */
                new Identity(),
                [1],
                /* out */
                [1],
            ],
            [
                /* in */
                new Identity(),
                [1, 1],
                /* out */
                [1],
            ],
            [
                /* in */
                new ToInteger(),
                [1, '1'],
                /* out */
                [1], // first occurrence wins
            ],
            [
                /* in */
                new ToString(),
                [1, 2, 1],
                /* out */
                [1, 2],
            ],
            [
                /* in */
                new Identity(),
                [1, 2, 1, 'a', 2, 'a'],
                /* out */
                [1, 2, 'a'],
            ],
            [
                /* in */
                new Identity(),
                [$obj1],
                /* out */
                [$obj1],
            ],
            [
                /* in */
                function (UnitTestPsiObject $o) { return $o->getName(); },
                [$obj1, $obj1, $obj2],
                /* out */
                [$obj1, $obj2],
            ],
            [
                /* in */
                function (UnitTestPsiObject $o) { return $o->getAge(); },
                [$obj1, $obj1, $obj2],
                /* out */
                [$obj1],
            ],
        ];
    }
}
