<?php
/**
 * Created by gerk on 29.11.17 06:50
 */

namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\Psi;
use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class GroupByOperationTest extends TestCase
{
    /**
     * @param $mapper
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testOperation($mapper, $input, $expected)
    {
        $subject = new GroupByOperation($mapper);

        $result = $subject->apply(new \ArrayIterator($input));

        $this->assertSame($expected, $result->getArrayCopy());
    }

    /**
     * @param $mapper
     * @param $input
     * @param $expected
     *
     * @dataProvider provide
     */
    public function testWithPsi($mapper, $input, $expected)
    {
        $result = Psi::it($input)
            ->groupBy($mapper)
            ->toKeyValueArray();

        $this->assertSame($expected, $result);
    }

    public function provide()
    {
        return [
            [
                function ($v) { return $v[0]; }, // take first letter
                ['adam', 'caesar', 'bruno', 'alexa', 'berta'],
                ['a' => ['adam', 'alexa'], 'c' => ['caesar'], 'b' => ['bruno', 'berta']],
            ],
        ];
    }
}
