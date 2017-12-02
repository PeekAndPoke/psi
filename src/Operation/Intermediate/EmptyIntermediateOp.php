<?php
/**
 * File was created 06.05.2015 22:18
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\Intermediate;

use PeekAndPoke\Component\Psi\IntermediateOperation;
use PeekAndPoke\Component\Psi\Solver\IntermediateContext;

/**
 * EmptyIntermediateOp
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class EmptyIntermediateOp implements IntermediateOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, IntermediateContext $context)
    {
        $context->outUseItem     = true;
        $context->outCanContinue = true;

        // return the input unmodified
        return $input;
    }
}
