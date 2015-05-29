<?php
/**
 * File was created 29.05.2015 21:38
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary;

use PeekAndPoke\Component\Psi\Interfaces\Functions\UnaryFunctionInterface;

/**
 * AbstractUnaryFunction
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractUnaryFunction implements UnaryFunctionInterface
{
    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function apply($input)
    {
        return $this->__invoke($input);
    }
}
