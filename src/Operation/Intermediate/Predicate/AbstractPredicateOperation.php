<?php
/**
 * File was created 07.05.2015 12:05
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate;

use PeekAndPoke\Component\Psi\BinaryFunction;
use PeekAndPoke\Component\Psi\IntermediateOperation;
use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractPredicateOperation implements IntermediateOperation
{
    /** @var callable|\Closure|UnaryFunction|BinaryFunction */
    protected $function;

    /**
     * @param callable|\Closure|UnaryFunction|BinaryFunction $binaryFunction
     */
    public function __construct($binaryFunction)
    {
        $this->function = $binaryFunction;
    }

    /**
     * @param $input1
     * @param $input2
     *
     * @return bool
     */
    protected function test($input1, $input2 = null)
    {
        $func = $this->function;

        return (bool) $func($input1, $input2);
    }
}
