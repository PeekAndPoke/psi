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
interface BinaryPredicateInterface
{
    /**
     * Returns a composed predicate that represents a short-circuiting logical AND of this predicate and another.
     *
     * @param BinaryPredicateInterface $other
     *
     * @return BinaryPredicateInterface
     */
    public function logicalAnd(BinaryPredicateInterface $other);

    /**
     * Returns a predicate that represents the logical negation of this predicate.
     *
     * @param BinaryPredicateInterface $other
     *
     * @return BinaryPredicateInterface
     */
    public function logicalNegate(BinaryPredicateInterface $other);

    /**
     * Returns a composed predicate that represents a short-circuiting logical OR of this predicate and another.
     *
     * @param BinaryPredicateInterface $other
     *
     * @return BinaryPredicateInterface
     */
    public function logicalOr(BinaryPredicateInterface $other);

    /**
     * @param mixed $input1
     * @param mixed $input2
     *
     * @return bool
     */
    public function test($input1, $input2);
}
