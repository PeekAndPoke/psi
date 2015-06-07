<?php
/**
 * File was created 07.05.2015 12:08
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation;

use PeekAndPoke\Component\Psi\Interfaces\Functions\BinaryFunctionInterface;

/**
 * AbstractBinaryFunction
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractBinaryFunction
{
    /** @var BinaryFunctionInterface */
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

//            $this->function = new BinaryClosure($function);
            $this->biFunction = $biFunction;
        }
    }
}