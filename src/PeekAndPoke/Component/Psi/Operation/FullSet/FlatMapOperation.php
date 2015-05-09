<?php
/**
 * File was created 06.05.2015 22:14
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\Interfaces\Operation\FullSetOperationInterface;

/**
 * FlatMapOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class FlatMapOperation implements FullSetOperationInterface
{
    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $result = new \ArrayIterator();

        $this->flatten($result, $set);

        return $result;
    }

    /**
     * @param \ArrayIterator $result
     * @param mixed          $input
     */
    private function flatten(\ArrayIterator $result, $input)
    {
        if (is_array($input) || $input instanceof \Traversable) {

            foreach ($input as $item) {
                $this->flatten($result, $item);
            }

            return;
        }

        $result->append($input);
    }
}
