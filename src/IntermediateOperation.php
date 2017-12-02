<?php
/**
 * File was created 06.05.2015 16:23
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi;

use PeekAndPoke\Component\Psi\Solver\IntermediateContext;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
interface IntermediateOperation
{
    /**
     * @param mixed               $input   The element in the stream
     * @param mixed               $index   The index in the input iterator
     * @param IntermediateContext $context The solving context
     *
     * @return mixed
     */
    public function apply($input, $index, IntermediateContext $context);
}
