<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\Comparison;

use PeekAndPoke\Component\Psi\Functions\Unary\AbstractParameterisedUnaryFunction;

/**
 * IsInstanceOf
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsInstanceOf extends AbstractParameterisedUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function __invoke($input)
    {
        $n = $this->val;

        if (is_string($n) == false && is_object($n) == false) {
            return false;
        }

        return $input instanceof $n;
    }
}
