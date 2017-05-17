<?php
/**
 * File was created 06.05.2015 16:24
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Interfaces\Operation;

/**
 * TerminalOperationInterface
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
interface TerminalOperationInterface
{
    /**
     * @param \Iterator $set
     *
     * @return mixed
     */
    public function apply(\Iterator $set);
}
