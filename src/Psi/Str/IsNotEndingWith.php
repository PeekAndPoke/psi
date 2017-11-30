<?php
/**
 * Created by gerk on 29.11.17 07:01
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNotEndingWith extends IsEndingWith
{
    public function __invoke($input)
    {
        return false === parent::__invoke($input);
    }
}
