<?php
/**
 * File was created 06.05.2015 22:18
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Functional;

use PeekAndPoke\Component\Psi\Interfaces\Operation\IntermediateOperationInterface;
use PeekAndPoke\Component\Psi\Operation\AbstractBinaryFunction;

/**
 * EachOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class EachOperation extends AbstractBinaryFunction implements IntermediateOperationInterface
{
    /**
     * {@inheritdoc}
     */
    public function apply($input, $index, &$useItem, &$canContinue)
    {
        $useItem     = true;
        $canContinue = true;

        $this->biFunction->__invoke($input, $index);

        // return the input unmodified
        return $input;
    }
}
