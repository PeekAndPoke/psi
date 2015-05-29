<?php
/**
 * File was created 07.05.2015 12:08
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Functional;

use PeekAndPoke\Component\Psi\Functions\BinaryClosure;
use PeekAndPoke\Component\Psi\Interfaces\Functions\BinaryFunctionInterface;
use PeekAndPoke\Component\Psi\Interfaces\Operation\IntermediateOperationInterface;

/**
 * AbstractBinaryFunctionalOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractBinaryFunctionalOperation implements IntermediateOperationInterface
{
    /** @var \Closure|BinaryFunctionInterface */
    protected $function;

    /**
     * @param \Closure|BinaryFunctionInterface $function
     */
    public function __construct($function)
    {
        if ($function instanceof BinaryFunctionInterface) {
            $this->function = $function;
        } else {
            $this->function = new BinaryClosure($function);
        }
    }
}
