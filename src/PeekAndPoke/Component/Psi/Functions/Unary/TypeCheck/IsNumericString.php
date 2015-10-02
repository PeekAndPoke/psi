<?php
/**
 * File was created 01.10.2015 18:02
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Functions\Unary\AbstractUnaryFunction;

/**
 * IsNumericString check if the string contains an number
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNumericString extends AbstractUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return is_numeric($input) && (((double) $input) == $input);
    }
}
