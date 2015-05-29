<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck;

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

        return $input instanceof $n;
    }
}
