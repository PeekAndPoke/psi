<?php
/**
 * File was created 07.05.2015 12:05
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate;

use PeekAndPoke\Component\Psi\Interfaces\Operation\IntermediateOperationInterface;
use PeekAndPoke\Component\Psi\Interfaces\Predicate\UnaryPredicateInterface;
use PeekAndPoke\Component\Psi\Predicate\UnaryPredicate;

/**
 * AbstractUnaryPredicateOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractUnaryPredicateOperation implements IntermediateOperationInterface
{
    /** @var UnaryPredicateInterface */
    protected $predicate;

    /**
     * @param \Closure|UnaryPredicateInterface $predicate
     */
    public function __construct($predicate)
    {
        if ($predicate instanceof UnaryPredicateInterface) {
            $this->predicate = $predicate;
        } else {
            $this->predicate = new UnaryPredicate($predicate);
        }
    }
}
