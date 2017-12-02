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
class DefaultSolver implements Solver
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

        $context              = new Solver\IntermediateContext();
        $continueWithNextItem = true;

        while ($continueWithNextItem && $input->valid()) {

            $result              = $input->current();
            $context->outUseItem = true;

            // do the whole intermediate operation chain for the current input
            $operatorChain->rewind();

            while ($context->outUseItem && $operatorChain->valid()) {

                /** @var IntermediateOperation $current */
                $current = $operatorChain->current();
                // apply intermediate operations
                $result = $current->apply($result, $input->key(), $context);
                // track the continuation flags
                $continueWithNextItem = $continueWithNextItem && $context->outCanContinue;

                // iterate
                $operatorChain->next();
            }

            if ($context->outUseItem) {
                $results->offsetSet($input->key(), $result);
            }

            // goto next item
            $input->next();
        }

        return $results;
    }
}
