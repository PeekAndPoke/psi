<?php
/**
 * File was created 29.05.2015 21:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Functions\Unary\AbstractParameterizedUnaryFunction;

/**
 * NotEqualTo does a non type safe comparison "!="
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNotEqualTo extends AbstractParameterizedUnaryFunction
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
