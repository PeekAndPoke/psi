<?php
/**
 * File was created 07.05.2015 09:11
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\Interfaces\Functions\UnaryFunctionInterface;
use PeekAndPoke\Component\Psi\Interfaces\Operation\TerminalOperationInterface;

/**
 * CollectToMapOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class CollectToMapOperation implements TerminalOperationInterface
{
    /** @var \Closure|UnaryFunctionInterface */
    private $keyMapper;
    /** @var \Closure|UnaryFunctionInterface */
    private $valueMapper;

    /**
     * @param \Closure|UnaryFunctionInterface $keyMapper
     * @param \Closure|UnaryFunctionInterface $valueMapper
     */
    public function __construct($keyMapper, $valueMapper)
    {
        // todo type-check on $keyMapper
        $this->keyMapper   = $keyMapper;
        // todo type-check on $valueMapper
        $this->valueMapper = $valueMapper;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $result = [];

        $keyMapper   = $this->keyMapper;
        $valueMapper = $this->valueMapper;

        foreach ($set as $item) {
            $result[$keyMapper($item)] = $valueMapper($item);
        }

        return $result;
    }
}
