<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Interfaces\UnaryFunction;

/**
 * IsFloat checks if the given value is a float, real or double
 *
 * @see IsFloatIsNotFloatTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsFloat implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return is_float($input);
    }
}
