<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 * IsObject checks if the given value is an object
 *
 * @see    IsObjectIsNotObjectTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsObject implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return is_object($input);
    }
}
