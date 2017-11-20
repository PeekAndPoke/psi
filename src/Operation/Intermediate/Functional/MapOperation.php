<?php
/**
 * File was created 06.05.2015 21:00
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Functional;

use PeekAndPoke\Component\Psi\Interfaces\IntermediateOperation;
use PeekAndPoke\Component\Psi\Operation\AbstractBinaryFunctionOperation;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class MapOperation extends AbstractBinaryFunctionOperation implements IntermediateOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, &$useItem, &$canContinue)
    {
        $useItem     = true;
        $canContinue = true;

        $func = $this->function;

        return $func($input, $index);
    }
}
