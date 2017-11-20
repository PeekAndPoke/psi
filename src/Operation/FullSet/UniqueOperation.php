<?php
/**
 * File was created 06.05.2015 22:14
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\Interfaces\FullSetOperation;

/**
 * UniqueOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class UniqueOperation implements FullSetOperation
{
    /** @var bool */
    protected $strict;

    /**
     * @param bool $strict
     */
    public function __construct($strict)
    {
        $this->strict = (bool) $strict;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $result = [];

        foreach ($set as $item) {
            if (! in_array($item, $result, $this->strict)) {
                $result[] = $item;
            }
        }

        return new \ArrayIterator($result);
    }
}
