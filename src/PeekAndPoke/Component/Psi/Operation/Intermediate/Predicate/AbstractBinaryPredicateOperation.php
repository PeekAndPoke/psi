<?php
/**
 * File was created 07.05.2015 12:05
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate;

use PeekAndPoke\Component\Psi\Interfaces\Operation\IntermediateOperationInterface;
use PeekAndPoke\Component\Psi\Interfaces\Predicate\BinaryPredicateInterface;
use PeekAndPoke\Component\Psi\Predicate\BinaryPredicate;

/**
 * AbstractBinaryPredicateOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractBinaryPredicateOperation implements IntermediateOperationInterface
{
    /** @var BinaryPredicateInterface */
    protected $predicate;

    /**
     * @param \Closure|BinaryPredicateInterface $predicate
     */
    public function __construct($predicate)
    {
        if ($predicate instanceof BinaryPredicateInterface) {
            $this->predicate = $predicate;
        } else {
            $this->predicate = new BinaryPredicate($predicate);
        }
    }
}
