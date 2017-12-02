<?php
/**
 * Created by gerk on 01.12.17 23:33
 */

namespace PeekAndPoke\Component\Psi\Psi\Num;

use PeekAndPoke\Component\Psi\Functions\ParameterizedUnaryFunction;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsMultipleOf extends ParameterizedUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        $factor = $this->getValue();

        if (! is_numeric($factor) || ! is_numeric($input) || (float) $factor === 0.0) {
            return false;
        }

        return ($input % $factor) === 0;
    }
}
