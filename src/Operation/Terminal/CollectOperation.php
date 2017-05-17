<?php
/**
 * File was created 07.05.2015 09:11
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\Interfaces\Operation\TerminalOperationInterface;

/**
 * CollectOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class CollectOperation implements TerminalOperationInterface
{
    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        return $set;
    }
}
