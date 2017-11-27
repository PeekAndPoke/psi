<?php
/**
 * File was created 09.06.2015 06:50
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\FullSetOperation;
use PeekAndPoke\Component\Psi\Operation\AbstractUnaryFunctionOperation;

/**
 * GroupOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class GroupByOperation extends AbstractUnaryFunctionOperation implements FullSetOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $ret  = [];
        $func = $this->function;

        foreach ($set as $item) {
            $group = $func($item);

            $ret[$group][] = $item;
        }

        return new \ArrayIterator($ret);
    }
}
