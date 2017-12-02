<?php
/**
 * Created by gerk on 01.12.17 23:22
 */

namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\Psi;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class GetRandomOperationTest extends TestCase
{
    public function testSubjectWhenEmptyInput()
    {
        $subject = new GetRandomOperation('default');

        $this->assertSame(
            'default',
            $subject->apply(new \ArrayIterator([]))
        );
    }

    public function testSubjectWithPsi()
    {
        $values = ['a', 'b', 'c'];
        $results = [];

        for ($i = 0; $i < 1000; $i++) {

            $val = Psi::it($values)->getRandom();

            $results[$val] = $val;
        }

        sort($results);

        $this->assertSame(array_values($results), $values);
    }
}
