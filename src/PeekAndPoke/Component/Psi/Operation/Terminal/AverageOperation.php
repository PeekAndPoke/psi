<?php
/**
 * File was created 07.05.2015 09:11
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\Interfaces\Operation\TerminalOperationInterface;

/**
 * AverageOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class AverageOperation implements TerminalOperationInterface
{
    /**
     * {@inheritdoc}
     *
     * @return float
     */
    public function apply(\Iterator $set)
    {
        $data = iterator_to_array($set);

        if (count($data) == 0) {
            return 0;
        }

        return array_sum($data) / count($data);
    }
}
