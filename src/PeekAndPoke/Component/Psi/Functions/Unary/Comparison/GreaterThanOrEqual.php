<?php
/**
 * File was created 29.05.2015 21:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\Comparison;

use PeekAndPoke\Component\Psi\Functions\Unary\AbstractParameterisedUnaryFunction;

/**
 * GreaterThanOrEqual does a non type safe comparison "=="
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class GreaterThanOrEqual extends AbstractParameterisedUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function __invoke($input)
    {
        return $input >= $this->val;
    }
}
