<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Functions\Unary\AbstractUnaryFunction;

/**
 * IsDouble
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsDouble extends AbstractUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function __invoke($input)
    {
        return is_double($input);
    }
}
