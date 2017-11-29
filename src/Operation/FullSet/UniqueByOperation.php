<?php
/**
 * File was created 06.05.2015 22:14
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\BinaryFunction;
use PeekAndPoke\Component\Psi\FullSetOperation;
use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class UniqueByOperation implements FullSetOperation
{
    /** @var callable|UnaryFunction|BinaryFunction */
    protected $mapper;
    /** @var bool */
    private $strict;

    /**
     * @param callable|UnaryFunction|BinaryFunction $mapper Mapper function
     * @param bool                                  $strict Do strict comparison
     */
    public function __construct($mapper, $strict)
    {
        $this->mapper = $mapper;
        $this->strict = $strict;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $map    = $this->mapper;
        $result = [];
        $known  = [];

        foreach ($set as $item) {

            $mapped = $map($item);

            if (! in_array($mapped, $known, $this->strict)) {
                $known[]  = $mapped;
                $result[] = $item;
            }
        }

        return new \ArrayIterator($result);
    }
}
