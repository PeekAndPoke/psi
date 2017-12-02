<?php
/**
 * File was created 06.05.2015 16:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate;

use PeekAndPoke\Component\Psi\BinaryFunction;
use PeekAndPoke\Component\Psi\Solver\IntermediateContext;
use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class FilterByPredicate extends AbstractPredicateOperation
{
    /** @var callable|\Closure|BinaryFunction|UnaryFunction */
    private $mapper;

    /**
     * FilterByPredicate constructor.
     *
     * @param callable|\Closure|BinaryFunction|UnaryFunction $mapper
     * @param callable|\Closure|BinaryFunction|UnaryFunction $condition
     */
    public function __construct($mapper, $condition)
    {
        parent::__construct($condition);
        $this->mapper = $mapper;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, IntermediateContext $context)
    {
        $mapper = $this->mapper;

        $context->outUseItem     = $this->test($mapper($input), $index);
        $context->outCanContinue = true;

        return $input;
    }
}
