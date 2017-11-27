<?php
/**
 * File was created 06.05.2015 21:01
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
interface UnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function __invoke($input);
}
