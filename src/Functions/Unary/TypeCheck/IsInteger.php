<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Functions\Unary\AbstractUnaryFunction;

/**
 * IsInteger
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsInteger extends AbstractUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function __invoke($input)
    {
        return is_int($input);
    }
}
