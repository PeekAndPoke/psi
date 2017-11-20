<?php
/**
 * File was created 29.05.2015 21:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Functions\Unary\AbstractParameterizedUnaryFunction;

/**
 * SameAs does a type safe comparison "==="
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsSameAs extends AbstractParameterizedUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return $input === $this->getValue();
    }
}
