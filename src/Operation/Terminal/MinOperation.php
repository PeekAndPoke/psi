<?php
/**
 * File was created 07.05.2015 09:11
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\Interfaces\TerminalOperation;

/**
 * MinOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class MinOperation implements TerminalOperation
{
    /**
     * {@inheritdoc}
     *
     * @return float
     */
    public function apply(\Iterator $set)
    {
        $data = iterator_to_array($set);

        return count($data) > 0 ? min($data) : 0;
    }
}
