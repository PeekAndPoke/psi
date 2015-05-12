<?php
/**
 * File was created 11.05.2015 07:05
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi;

use PeekAndPoke\Component\Psi\Exception\PsiException;

/**
 * PsiFactory
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiFactory
{
    /**
     * @param array $iteratables
     *
     * @return \Iterator
     *
     * @throws PsiException
     */
    public function createIterator(array $iteratables)
    {
        $count = count($iteratables);

        if ($count == 1) {
            return $this->createSingleIterator($iteratables[0]);
        }

        if ($count > 1) {
            $iterator = new \AppendIterator();

            foreach ($iteratables as $iteratable) {
                $iterator->append(
                    $this->createSingleIterator($iteratable)
                );
            }

            return $iterator;
        }

        return $this->createIterator(null);
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
