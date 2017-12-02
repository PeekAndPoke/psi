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
class FilterPredicate extends AbstractPredicateOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, IntermediateContext $context)
    {
        $context->outUseItem     = $this->test($input, $index);
        $context->outCanContinue = true;

        return $input;
    }
}
