<?php
/**
 * Created by gerk on 01.12.17 23:33
 */

namespace PeekAndPoke\Component\Psi\Psi\Num;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNotPrime extends IsPrime
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return false === parent::__invoke($input);
    }
}
