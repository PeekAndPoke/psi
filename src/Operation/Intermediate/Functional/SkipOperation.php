<?php
/**
 * Created by gerk on 02.12.17 10:34
 */

namespace PeekAndPoke\Component\Psi\Operation\Intermediate\Functional;

use PeekAndPoke\Component\Psi\IntermediateOperation;
use PeekAndPoke\Component\Psi\Solver\IntermediateContext;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class SkipOperation implements IntermediateOperation
{
    /** @var int */
    private $skip;

    /**
     * @param int $skip
     */
    public function __construct($skip)
    {
        $this->skip = $skip;
    }

    /**
     * @param mixed               $input   The element in the stream
     * @param mixed               $index   The index in the input iterator
     * @param IntermediateContext $context The solving context
     *
     * @return mixed
     */
    public function apply($input, $index, IntermediateContext $context)
    {
        if (! $context->memory->contains($this)) {
            $context->memory->offsetSet($this, 0);
        }

        $count = $context->memory->offsetGet($this);
        $context->memory->offsetSet($this, $count+1);

        $takeIt = $count >= $this->skip;

        $context->outUseItem     = $takeIt;
        $context->outCanContinue = true;

        return $input;
    }
}
