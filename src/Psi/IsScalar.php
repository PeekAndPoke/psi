<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 * IsScalar checks if the given value is scalar
 *
 * @see    IsScalarIsNotScalarTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsScalar implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return is_scalar($input);
    }
}
