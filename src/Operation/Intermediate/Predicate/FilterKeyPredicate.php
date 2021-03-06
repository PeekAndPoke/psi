<?php
/**
 * File was created 06.05.2015 16:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate;

use PeekAndPoke\Component\Psi\Solver\IntermediateContext;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class FilterKeyPredicate extends AbstractPredicateOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, IntermediateContext $context)
    {
        $context->outUseItem     = $this->test($index, $input);
        $context->outCanContinue = true;

        return $input;
    }
}
