<?php
/**
 * File was created 07.05.2015 09:11
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\Interfaces\Operation\TerminalOperationInterface;
use PeekAndPoke\Component\Psi\Operation\AbstractUnaryFunctionOperation;

/**
 * CollectToMapOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class CollectToMapOperation extends AbstractUnaryFunctionOperation implements TerminalOperationInterface
{
    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $result = [];

        $mapper = $this->function;

        foreach ($set as $item) {
            $result[$mapper($item)] = $item;
        }

        return $result;
    }
}
