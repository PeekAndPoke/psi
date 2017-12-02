<?php
/**
 * File was created 09.06.2015 06:50
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\FullSetOperation;
use PeekAndPoke\Component\Psi\Operation\AbstractBinaryFunctionOperation;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class GroupByOperation extends AbstractBinaryFunctionOperation implements FullSetOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $ret  = [];
        $func = $this->function;

        foreach ($set as $key => $item) {
            $group = $func($item, $key);

            $ret[$group][] = $item;
        }

        return new \ArrayIterator($ret);
    }
}
