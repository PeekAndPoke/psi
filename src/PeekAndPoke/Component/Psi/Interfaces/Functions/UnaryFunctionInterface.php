<?php
/**
 * File was created 06.05.2015 21:01
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Interfaces\Functions;


/**
 * UnaryFunctionInterface
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
interface UnaryFunctionInterface
{
    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function __invoke($input);
}
