<?php
/**
 * File was created 06.05.2015 16:23
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
interface IntermediateOperation
{
    /**
     * @param mixed $input
     * @param mixed $index       [IN]  The index in the input iterator
     * @param bool  $useItem     [OUT] set to true when the current item can be used for the total result
     * @param bool  $canContinue [OUT] set to true when processing can continue with next item
     *
     * @return mixed
     */
    public function apply($input, $index, &$useItem, &$canContinue);
}
