<?php
/**
 * File was created 07.05.2015 09:11
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\Interfaces\TerminalOperation;

/**
 * CollectToArrayOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class CollectToArrayOperation implements TerminalOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        return array_values(
            iterator_to_array($set)
        );
    }
}
