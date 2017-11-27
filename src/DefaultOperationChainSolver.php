<?php
/**
 * File was created 06.05.2015 22:56
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi;

/**
 * @api
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class DefaultOperationChainSolver implements OperationChainSolver
{
    /**
     * {@inheritdoc}
     */
    public function solve(\Iterator $operations, \Iterator $items)
    {
        // search for all UnaryOperations
        $tempResult = $items;
        $unaryChain = new \ArrayIterator();

        foreach ($operations as $operation) {

            // collect all unary operators
            if ($operation instanceof IntermediateOperation) {
                $unaryChain->append($operation);
            } else {
                // execute all the collected unary operations

                if ($unaryChain->count() > 0) {
                    $tempResult = $this->solveIntermediateOperationChain($unaryChain, $tempResult);
                    $unaryChain = new \ArrayIterator();
                }

                // execute full set operations (like sort)
                if ($operation instanceof FullSetOperation) {
                    $tempResult = $operation->apply($tempResult);
                }
            }
        }

        // resolve the rest of the unary operation
        if ($unaryChain->count() > 0) {
            $tempResult = $this->solveIntermediateOperationChain($unaryChain, $tempResult);
        }

        return $tempResult;
    }

    /**
     * @param \Iterator $operatorChain
     * @param \Iterator $input
     *
     * @return \ArrayIterator
     */
    private function solveIntermediateOperationChain(\Iterator $operatorChain, \Iterator $input)
    {
        $results = new \ArrayIterator();

        $input->rewind();

        $continueWithNextItem = true;

        while ($continueWithNextItem && $input->valid()) {

            $result    = $input->current();
            $useResult = true;

            // do the whole intermediate operation chain for the current input
            $operatorChain->rewind();

            while ($useResult && $operatorChain->valid()) {

                /** @var IntermediateOperation $current */
                $current = $operatorChain->current();
                // apply intermediate operations
                $result = $current->apply($result, $input->key(), $useResult, $returnedCanContinue);
                // track the continuation flags
                $continueWithNextItem = $continueWithNextItem && $returnedCanContinue;

                // iterate
                $operatorChain->next();
            }

            if ($useResult) {
                $results->offsetSet($input->key(), $result);
            }

            // goto next item
            $input->next();
        }

        return $results;
    }
}
