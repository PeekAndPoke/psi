<?php
/**
 * File was created 06.05.2015 17:19
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Interfaces\Predicate;

/**
 * UnaryPredicateInterface
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
interface UnaryPredicateInterface
{
    /**
     * Returns a composed predicate that represents a short-circuiting logical AND of this predicate and another.
     *
     * @param UnaryPredicateInterface $other
     *
     * @return UnaryPredicateInterface
     */
    public function logicalAnd(UnaryPredicateInterface $other);

    /**
     * Returns a predicate that represents the logical negation of this predicate.
     *
     * @param UnaryPredicateInterface $other
     *
     * @return UnaryPredicateInterface
     */
    public function logicalNegate(UnaryPredicateInterface $other);

    /**
     * Returns a composed predicate that represents a short-circuiting logical OR of this predicate and another.
     *
     * @param UnaryPredicateInterface $other
     *
     * @return UnaryPredicateInterface
     */
    public function logicalOr(UnaryPredicateInterface $other);

    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function test($input);
}
