<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Interfaces\UnaryFunction;

/**
 * IsEmpty checks if the given value is empty bu using empty(...)
 *
 * @see IsEmptyIsNotEmptyTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsEmpty implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return empty($input);
    }
}
