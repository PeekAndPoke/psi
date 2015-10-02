<?php
/**
 * File was created 06.05.2015 22:18
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Functional;

use PeekAndPoke\Component\Psi\Interfaces\Operation\IntermediateOperationInterface;
use PeekAndPoke\Component\Psi\Operation\AbstractBinaryFunctionOperation;

/**
 * EachOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class EachOperation extends AbstractBinaryFunctionOperation implements IntermediateOperationInterface
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, &$useItem, &$canContinue)
    {
        $useItem     = true;
        $canContinue = true;

        $fun = $this->biFunction;
        $fun($input, $index);

        // return the input unmodified
        return $input;
    }
}
