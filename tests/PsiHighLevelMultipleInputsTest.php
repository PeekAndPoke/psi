<?php
/**
 * File was created 07.05.2015 07:51
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi;

use PHPUnit\Framework\TestCase;

/**
 * PsiHighLevelMultipleInputsTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiHighLevelMultipleInputsTest extends TestCase
{
    /**
     * @param array $input
     * @param array $expected
     *
     * @throws \PeekAndPoke\Component\Psi\Exception\PsiException
     *
     * @dataProvider provideTestWithNoOperation
     */
    public function testMultipleInputs($input, $expected)
    {
        $callable = [Psi::class, 'it'];

        /** @var Psi $psi */
        $psi = call_user_func_array($callable, $input);

        $result = $psi->toArray();

        $this->assertSame($expected, $result);
    }

    /**
     * @return array
     */
    public function provideTestWithNoOperation()
    {
        return [
            [
                [null],
                [],
            ],
            [
                [[]],
                [],
            ],
            [
                [[1, 2]],
                [1, 2],
            ],
            [
                [[1, 2], null],
                [1, 2],
            ],
            [
                [[1, 2], [3, 4]],
                [1, 2, 3, 4],
            ],
            [
                [null, [1, 2], null, [3, 4], null],
                [1, 2, 3, 4],
            ],
        ];
    }

    /**
     * Test that combining multiple keyed inputs works
     */
    public function testMultiInputsPreserveKeys()
    {
        $input    = ['a' => 10, 'b' => 20];
        $input2   = ['c' => 30, 'd' => 40];
        $expected = ['a' => 10, 'b' => 20, 'c' => 30, 'd' => 40];

        $result = Psi::it($input, $input2)
            ->preserveKeysOfMultipleInputs()
            ->toKeyValueArray();

        $this->assertSame($expected, $result);
    }

    /**
     * Test that combining multiple keyed inputs with overlapping keys works
     */
    public function testMultiInputsPreserveOverlappingKeys()
    {
        $input    = ['a' => 10, 'b' => 20];
        $input2   = ['a' => 30, 'b' => 40];
        $expected = ['a' => 30, 'b' => 40];

        $result = Psi::it($input, $input2)
            ->preserveKeysOfMultipleInputs()
            ->toKeyValueArray();

        $this->assertSame($expected, $result);
    }
}
