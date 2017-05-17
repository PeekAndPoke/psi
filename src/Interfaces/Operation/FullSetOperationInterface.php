<?php
/**
 * File was created 06.05.2015 16:24
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Interfaces\Operation;

/**
 * FullSetOperationInterface
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
interface FullSetOperationInterface
{
    /**
     * @param \Iterator $set
     *
     * @return \Iterator
     */
    public function apply(\Iterator $set);
}
