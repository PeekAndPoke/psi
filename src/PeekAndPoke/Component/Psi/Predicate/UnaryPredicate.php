<?php
/**
 * File was created 06.05.2015 17:23
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Predicate;

use PeekAndPoke\Component\Psi\Interfaces\Predicate\UnaryPredicateInterface;

/**
 * UnaryPredicate
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class UnaryPredicate implements UnaryPredicateInterface
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
     * @param UnaryPredicateInterface $other
     *
     * @return UnaryPredicateInterface
     */
    public function logicalAnd(UnaryPredicateInterface $other)
    {
        // TODO: Implement logicalAnd() method.
    }

    /**
     * Returns a predicate that represents the logical negation of this predicate.
     *
     * @param UnaryPredicateInterface $other
     *
     * @return UnaryPredicateInterface
     */
    public function logicalNegate(UnaryPredicateInterface $other)
    {
        // TODO: Implement logicalNegate() method.
    }

    /**
     * Returns a composed predicate that represents a short-circuiting logical OR of this predicate and another.
     *
     * @param UnaryPredicateInterface $other
     *
     * @return UnaryPredicateInterface
     */
    public function logicalOr(UnaryPredicateInterface $other)
    {
        // TODO: Implement logicalOr() method.
    }

    /**
     * {@inheritdoc}
     */
    public function test($input)
    {
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        /** @noinspection PhpVoidFunctionResultUsedInspection */
        return (bool) $this->predicate->__invoke($input);
    }
}
