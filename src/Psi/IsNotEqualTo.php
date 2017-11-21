<?php
/**
 * File was created 29.05.2015 21:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Functions\Unary\ParameterizedUnaryFunction;

/**
 * IsNotEqualTo checks if a value is not equal to the given parameter doing a non type safe compare "=="
 *
 * @see ParameterizedUnaryFunction
 * @see IsEqualToIsNotEqualToTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNotEqualTo extends ParameterizedUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        /** @noinspection TypeUnsafeComparisonInspection */
        return $input != $this->getValue(); // the non-type-safe comparison here is on purpose
    }
}
