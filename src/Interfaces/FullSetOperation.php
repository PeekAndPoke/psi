<?php
/**
 * File was created 06.05.2015 16:24
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Interfaces;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
interface FullSetOperation
{
    /**
     * @param \Iterator $set
     *
     * @return \Iterator
     */
    public function apply(\Iterator $set);
}
