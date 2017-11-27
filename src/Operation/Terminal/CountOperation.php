<?php
/**
 * File was created 07.05.2015 09:11
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\TerminalOperation;

/**
 * CountOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class CountOperation implements TerminalOperation
{
    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function apply(\Iterator $set)
    {
        $data = iterator_to_array($set);

        return count($data);
    }
}
