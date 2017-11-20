<?php
/**
 * File was created 06.05.2015 16:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class FilterValueKeyPredicate extends AbstractPredicateOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, &$useItem, &$canContinue)
    {
        $useItem     = $this->test($input, $index);
        $canContinue = true;

        return $input;
    }
}
