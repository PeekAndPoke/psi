<?php
/**
 * Created by gerk on 30.11.17 05:44
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNotContaining extends IsContaining
{
    public function __invoke($input)
    {
        return false === parent::__invoke($input);
    }
}
