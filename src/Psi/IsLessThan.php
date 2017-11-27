<?php
/**
 * File was created 29.05.2015 21:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Functions\ParameterizedUnaryFunction;

/**
 * LessThan is a value is less than the given parameter
 *
 * @see    ParameterizedUnaryFunction
 * @see    IsLessThanTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsLessThan extends ParameterizedUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return $input < $this->getValue();
    }
}
