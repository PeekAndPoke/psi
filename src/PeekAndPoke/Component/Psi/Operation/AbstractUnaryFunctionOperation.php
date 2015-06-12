<?php
/**
 * File was created 07.05.2015 12:08
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation;

use PeekAndPoke\Component\Psi\Interfaces\Functions\UnaryFunctionInterface;

/**
 * AbstractUnaryFunctionOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractUnaryFunctionOperation
{
    /** @var callable */
    protected $function;

    /**
     * @param \Closure|UnaryFunctionInterface $function
     */
    public function __construct($function)
    {
        if ($function instanceof UnaryFunctionInterface) {
            $this->function = $function;
        } else {
            // TODO: add a check that this is a \Closure and that is has the correct number of parameters
            $this->function = $function;
        }
    }
}
