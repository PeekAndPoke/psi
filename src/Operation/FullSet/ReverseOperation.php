<?php
/**
 * File was created 06.05.2015 22:14
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\FullSetOperation;

/**
 * ReverseOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ReverseOperation implements FullSetOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $data = iterator_to_array($set);

        $reversed = array_reverse($data);

        return new \ArrayIterator($reversed);
    }
}
