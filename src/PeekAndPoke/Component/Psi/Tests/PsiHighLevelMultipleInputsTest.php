<?php
/**
 * File was created 07.05.2015 07:51
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests;

use PeekAndPoke\Component\Psi\Psi;

/**
 * PsiHighLevelMultipleInputsTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiHighLevelMultipleInputsTest extends AbstractPsiTest
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

        $result = $psi->collect();

        $this->assertPsiCollectOutputMatches($expected, $result);
    }

    /**
     * @return array
     */
    public function provideTestWithNoOperation()
    {
        return [
            [
                [null],                                 [],
            ],
            [
                [[]],                                   [],
            ],
            [
                [[1,2]],                                [1,2],
            ],
            [
                [[1,2], null],                          [1,2],
            ],
            [
                [[1,2], [3,4]],                         [1,2,3,4],
            ],
            [
                [null, [1,2], null, [3,4], null],       [1,2,3,4],
            ],
        ];
    }
}
