<?php
/**
 * File was created 06.05.2015 21:00
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Functional;

use PeekAndPoke\Component\Psi\Interfaces\Operation\IntermediateOperationInterface;
use PeekAndPoke\Component\Psi\Operation\AbstractBinaryFunctionOperation;

/**
 * MapOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class MapOperation extends AbstractBinaryFunctionOperation implements IntermediateOperationInterface
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, &$useItem, &$canContinue)
    {
        $useItem     = true;
        $canContinue = true;

        return $this->biFunction->__invoke($input, $index);
    }
}
