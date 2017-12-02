<?php
/**
 * File was created 06.05.2015 22:18
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Functional;

use PeekAndPoke\Component\Psi\IntermediateOperation;
use PeekAndPoke\Component\Psi\Operation\AbstractBinaryFunctionOperation;
use PeekAndPoke\Component\Psi\Solver\IntermediateContext;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class EachOperation extends AbstractBinaryFunctionOperation implements IntermediateOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, IntermediateContext $context)
    {
        $context->outUseItem     = true;
        $context->outCanContinue = true;

        $func = $this->function;
        $func($input, $index);

        // return the input unmodified
        return $input;
    }
}
