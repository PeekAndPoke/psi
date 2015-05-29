<?php
/**
 * File was created 07.05.2015 12:08
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Functional;

use PeekAndPoke\Component\Psi\Functions\UnaryClosure;
use PeekAndPoke\Component\Psi\Interfaces\Functions\UnaryFunctionInterface;
use PeekAndPoke\Component\Psi\Interfaces\Operation\IntermediateOperationInterface;

/**
 * AbstractUnaryFunctionalOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractUnaryFunctionalOperation implements IntermediateOperationInterface
{
    /** @var \Closure|UnaryFunctionInterface */
    protected $function;

    /**
     * @param \Closure|UnaryFunctionInterface $function
     */
    public function __construct($function)
    {
        if ($function instanceof UnaryFunctionInterface) {
            $this->function = $function;
        } else {
            $this->function = new UnaryClosure($function);
        }
    }
}
