<?php
/**
 * Created by gerk on 01.12.17 23:33
 */

namespace PeekAndPoke\Component\Psi\Psi\Num;

use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsPrime implements UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        if (! is_int($input)) {
            return false;
        }

        $n = abs($input);

        if ($n < 2) {
            return false;
        }

        $sqrt = sqrt($n);

        $i = 2;

        while ($i <= $sqrt) {

            if ($n % $i === 0) {
                return false;
            }

            $i++;
        }

        return true;
    }
}
