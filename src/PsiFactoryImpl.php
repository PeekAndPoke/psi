<?php
/**
 * File was created 11.05.2015 07:05
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi;

use PeekAndPoke\Component\Psi\Exception\PsiException;
use PeekAndPoke\Component\Psi\Interfaces\PsiFactory;
use PeekAndPoke\Component\Psi\Iterator\KeylessAppendIterator;
use PeekAndPoke\Component\Psi\Solver\DefaultOperationChainSolver;

/**
 * PsiFactory
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiFactoryImpl implements PsiFactory
{
    /**
     * {@inheritdoc}
     */
    public function createSolver()
    {
        return new DefaultOperationChainSolver();
    }

    /**
     * {@inheritdoc}
     */
    public function createIterator(array $iteratables, PsiOptions $options)
    {
        $count = count($iteratables);

        if ($count === 1) {
            return $this->createSingleIterator($iteratables[0]);
        }

        if ($count > 1) {
            // when we have multiple inputs we need an option to decide on how to deal with colliding keys
            if ($options->isPreserveKeysOfMultipleInputs()) {
                // this iterator return the original keys of each child iterator
                // -> this leads to conflicts OR means we preserve keys
                $iterator = new \AppendIterator();
            } else {
                // this iterator will create numeric keys from 0 .. n
                $iterator = new KeylessAppendIterator();
            }

            foreach ($iteratables as $iteratable) {

                $iterator->append(
                    $this->createSingleIterator($iteratable)
                );
            }

            return $iterator;
        }

        return new \ArrayIterator();
    }

    /**
     * @param mixed $iteratable
     * @return \Iterator
     *
     * @throws PsiException
     */
    private function createSingleIterator($iteratable)
    {
        if ($iteratable === null) {
            return new \ArrayIterator();
        }

        if ($iteratable instanceof \Iterator) {
            return $iteratable;
        }

        if ($iteratable instanceof \Traversable) {
            // TODO: figure out if that is correct
            return new \IteratorIterator($iteratable);
        }

        if (is_array($iteratable)) {
            return new \ArrayIterator($iteratable);
        }

        // TODO: what about classes implementing \ArrayAccess and/or \Countable?

        throw new PsiException('Invalid input, not an array or an Iterator or a Traversable');
    }
}
