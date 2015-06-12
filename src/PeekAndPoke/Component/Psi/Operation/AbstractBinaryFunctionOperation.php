<?php
/**
 * File was created 07.05.2015 12:08
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation;

use PeekAndPoke\Component\Psi\Interfaces\Functions\BinaryFunctionInterface;

/**
 * AbstractBinaryFunctionOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractBinaryFunctionOperation
{
    /** @var callable */
    protected $biFunction;

    /**
     * @param \Closure|BinaryFunctionInterface $biFunction
     */
    public function __construct($biFunction)
    {
        if ($biFunction instanceof BinaryFunctionInterface) {
            $this->biFunction = $biFunction;
        } else {
            // TODO: add a check that this is a \Closure and that is has the correct number of parameters
            $this->biFunction = $biFunction;
        }
    }
}
