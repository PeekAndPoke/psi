<?php
/**
 * File was created 07.05.2015 09:11
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\TerminalOperation;

/**
 * MedianOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class MedianOperation implements TerminalOperation
{
    /**
     * {@inheritdoc}
     *
     * @return float
     */
    public function apply(\Iterator $set)
    {
        /** @var float[] $data */
        $data  = array_values(iterator_to_array($set));
        $count = count($data);

        if ($count === 0) {
            return 0;
        }

        sort($data);

        $middle = (($count + 1) / 2) - 1;
        $left   = (int) floor($middle);
        $right  = (int) ceil($middle);

        $leftVal  = $data[$left];
        $rightVal = $data[$right];

        if (! is_scalar($leftVal) || ! is_scalar($rightVal)) {
            return 0;
        }

        return ($data[$left] + $data[$right]) / 2;
    }
}
