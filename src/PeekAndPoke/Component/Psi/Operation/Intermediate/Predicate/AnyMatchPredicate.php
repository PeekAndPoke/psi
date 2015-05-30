<?php
/**
 * File was created 06.05.2015 16:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate;

/**
 * AnyMatchPredicate
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class AnyMatchPredicate extends AbstractUnaryPredicateOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, &$useItem, &$canContinue)
    {
        $useItem     = true;
        $canContinue = ! $this->predicate->test($input);

        return $input;
    }
}
