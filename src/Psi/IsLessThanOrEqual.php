<?php
/**
 * File was created 29.05.2015 21:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Functions\Unary\ParameterizedUnaryFunction;

/**
 * LessThanOrEqual checks if a value is less than or equal to the given parameter
 *
 * @see ParameterizedUnaryFunction
 * @see IsLessThanOrEqualTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsLessThanOrEqual extends ParameterizedUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return $input <= $this->getValue();
    }
}
