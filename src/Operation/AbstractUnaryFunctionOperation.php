<?php
/**
 * File was created 07.05.2015 12:08
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation;

use PeekAndPoke\Component\Psi\Interfaces\UnaryFunction;

/**
 * AbstractUnaryFunctionOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractUnaryFunctionOperation
{
    /** @var callable|\Closure|UnaryFunction */
    protected $function;

    /**
     * @param callable|\Closure|UnaryFunction $function
     */
    public function __construct($function)
    {
        $this->function = $function;
    }
}
