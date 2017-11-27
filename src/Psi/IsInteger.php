<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 * IsInteger checks if the given value is an integer
 *
 * @see    IsIntegerIsNotIntegerTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsInteger implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return is_int($input);
    }
}
