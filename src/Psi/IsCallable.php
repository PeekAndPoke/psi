<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 * IsCallable checks if the given value is a callable.
 *
 * This is true when the value is:
 *
 * - a Closure
 * - an anonymous function
 * - a class that implements the __invoke function
 *
 * @see    IsCallableIsNotCallableTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsCallable implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return is_callable($input);
    }
}
