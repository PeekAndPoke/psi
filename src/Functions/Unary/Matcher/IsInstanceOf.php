<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\Matcher;

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
     * @return bool
     */
    public function __invoke($input)
    {
        $val = $this->getValue();

        return $this->isApplicable($val) && ($input instanceof $val);
    }

    /**
     * @param $val
     * @return bool
     */
    private function isApplicable($val)
    {
        return is_string($val) || is_object($val);
    }
}
