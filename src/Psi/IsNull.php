<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Interfaces\UnaryFunction;

/**
 * IsNull checks if the given value is null
 *
 * @see    IsNullIsNotNullTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNull implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return $input === null;
    }
}
