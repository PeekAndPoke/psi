<?php
/**
 * File was created 07.05.2015 12:08
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation;

use PeekAndPoke\Component\Psi\BinaryFunction;

/**
 * AbstractBinaryFunctionOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractBinaryFunctionOperation
{
    /** @var callable|\Closure|BinaryFunction */
    protected $function;

    /**
     * @param callable|\Closure|BinaryFunction $function
     */
    public function __construct($function)
    {
        $this->function = $function;
    }
}
