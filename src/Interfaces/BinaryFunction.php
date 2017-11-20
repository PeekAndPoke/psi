<?php
/**
 * File was created 06.05.2015 21:01
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Interfaces;


/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
interface BinaryFunction
{
    /**
     * @param mixed $input1
     * @param mixed $input2
     *
     * @return mixed
     */
    public function __invoke($input1, $input2);
}
