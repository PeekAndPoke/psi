<?php
/**
 * Created by gerk on 20.11.17 08:43
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

use PeekAndPoke\Component\Psi\Interfaces\UnaryFunction;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ToLower implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function __invoke($input)
    {
        if (! is_scalar($input)) {
            return null;
        }

        return strtolower($input);
    }
}
