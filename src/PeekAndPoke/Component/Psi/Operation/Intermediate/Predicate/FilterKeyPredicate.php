<?php
/**
 * File was created 06.05.2015 16:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate;

/**
 * FilterPredicate
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class FilterKeyPredicate extends AbstractUnaryPredicateOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, &$useItem, &$canContinue)
    {
        $useItem     = $this->predicate->test($index);
        $canContinue = true;

        return $input;
    }
}
