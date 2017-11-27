<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 * IsResource checks if the given value is a resource
 *
 * @see    IsResourceIsNotResourceTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsResource implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return is_resource($input);
    }
}
