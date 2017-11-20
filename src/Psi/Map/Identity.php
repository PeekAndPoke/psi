<?php
/**
 * File was created 27.08.2015 08:44
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi\Map;

use PeekAndPoke\Component\Psi\Interfaces\BinaryFunction;

/**
 * Returns input without changing it
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class Identity implements BinaryFunction
{
    /**
     * @param mixed $input
     * @param mixed $key
     *
     * @return mixed
     */
    public function __invoke($input, $key)
    {
        return $input;
    }
}
