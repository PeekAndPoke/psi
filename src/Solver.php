<?php
/**
 * File was created 06.05.2015 22:54
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
interface Solver
{
    /**
     * @param \Iterator $operations
     * @param \Iterator $items
     *
     * @return \ArrayIterator
     */
    public function solve(\Iterator $operations, \Iterator $items);
}
