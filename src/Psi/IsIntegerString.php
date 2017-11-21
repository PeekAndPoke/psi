<?php
/**
 * File was created 01.10.2015 18:02
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Interfaces\UnaryFunction;

/**
 * IsIntegerString check if the given value is an integer encoded as a string
 *
 * @see    IsIntegerStringIsNotIntegerStringTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsIntegerString implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        /** @noinspection TypeUnsafeComparisonInspection */
        return is_string($input)
               && is_numeric($input)
               && (((int) $input) == $input) // the non-type-safe comparison here is on purpose
            ;
    }
}
