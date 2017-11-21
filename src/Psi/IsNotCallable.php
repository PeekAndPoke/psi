<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Interfaces\UnaryFunction;

/**
 * IsNotCallable checks if the given value is NOT a callable
 *
 * @see IsCallable
 * @see IsCallableIsNotCallableTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNotCallable implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return ! is_callable($input);
    }
}
