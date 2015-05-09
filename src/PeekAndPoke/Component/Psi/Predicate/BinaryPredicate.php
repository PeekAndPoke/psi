<?php
/**
 * File was created 06.05.2015 17:23
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Predicate;

use PeekAndPoke\Component\Psi\Interfaces\Predicate\BinaryPredicateInterface;

/**
 * BinaryPredicate
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class BinaryPredicate implements BinaryPredicateInterface
{
    /** @var \Closure */
    private $predicate;

    /**
     * @param \Closure $predicate
     */
    public function __construct(\Closure $predicate)
    {
        $this->predicate = $predicate;
    }

    /**
     * Returns a composed predicate that represents a short-circuiting logical AND of this predicate and another.
     *
     * @param BinaryPredicateInterface $other
     *
     * @return BinaryPredicateInterface
     */
    public function logicalAnd(BinaryPredicateInterface $other)
    {
        // TODO: Implement logicalAnd() method.
    }

    /**
     * Returns a predicate that represents the logical negation of this predicate.
     *
     * @param BinaryPredicateInterface $other
     *
     * @return BinaryPredicateInterface
     */
    public function logicalNegate(BinaryPredicateInterface $other)
    {
        // TODO: Implement logicalNegate() method.
    }

    /**
     * Returns a composed predicate that represents a short-circuiting logical OR of this predicate and another.
     *
     * @param BinaryPredicateInterface $other
     *
     * @return BinaryPredicateInterface
     */
    public function logicalOr(BinaryPredicateInterface $other)
    {
        // TODO: Implement logicalOr() method.
    }

    /**
     * {@inheritdoc}
     */
    public function test($input1, $input2)
    {
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        /** @noinspection PhpVoidFunctionResultUsedInspection */
        return (bool) $this->predicate->__invoke($input1, $input2);
    }
}
