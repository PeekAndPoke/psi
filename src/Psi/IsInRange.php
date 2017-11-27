<?php
/**
 * File was created 29.05.2015 21:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Functions\ParameterizedUnaryFunction;

/**
 * IsInRange checks if a value is within a certain range, including the boundaries
 *
 * @see    ParameterizedUnaryFunction
 * @see    IsInRangeIsNotInRangeTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsInRange extends ParameterizedUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return $input >= $this->getValue() && $input <= $this->getValue2();
    }
}
