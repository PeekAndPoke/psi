<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 * IsBool if the given value is of type bool
 *
 * @see    IsBoolIsNotBoolTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsBool implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return is_bool($input);
    }
}
