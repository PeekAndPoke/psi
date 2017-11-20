<?php
/**
 * File was created 06.05.2015 22:14
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\Interfaces\FullSetOperation;

/**
 * FlattenOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class FlattenOperation implements FullSetOperation
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
     * @param mixed|mixed[]  $input
     */
    private function flatten(\ArrayIterator $result, $input)
    {
        if (is_array($input) || $input instanceof \Traversable) {

            /** @noinspection ForeachSourceInspection */
            foreach ($input as $item) {
                $this->flatten($result, $item);
            }

            return;
        }

        $result->append($input);
    }
}
