<?php
/**
 * File was created 29.05.2015 21:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Functions\ParameterizedUnaryFunction;

/**
 * GreaterThan checks if a value is greater than the given parameter
 *
 * @see    ParameterizedUnaryFunction
 * @see    IsGreaterThanTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsGreaterThan extends ParameterizedUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return $input > $this->getValue();
    }
}
