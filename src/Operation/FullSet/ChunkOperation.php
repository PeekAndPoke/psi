<?php
/**
 * File was created 09.06.2015 06:50
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\FullSetOperation;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ChunkOperation implements FullSetOperation
{
    /** @var int */
    private $chunkSize;

    /**
     * @param int $chunkSize
     */
    public function __construct($chunkSize)
    {
        $this->chunkSize = max(1, (int) $chunkSize);
    }

    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $group   = 0;
        $counter = $this->chunkSize;
        $ret     = [];

        foreach ($set as $item) {

            $ret[$group][] = $item;

            if (--$counter === 0) {
                $counter = $this->chunkSize;
                ++$group;
            }
        }

        return new \ArrayIterator($ret);
    }
}
