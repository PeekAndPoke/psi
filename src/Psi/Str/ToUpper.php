<?php
/**
 * Created by gerk on 20.11.17 08:43
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

use PeekAndPoke\Component\Psi\Psi\Map\ToString;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ToUpper extends ToString
{
    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function __invoke($input)
    {
        return strtoupper(
            parent::__invoke($input)
        );
    }
}
