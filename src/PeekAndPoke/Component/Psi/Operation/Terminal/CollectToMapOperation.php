<?php
/**
 * File was created 07.05.2015 09:11
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\Interfaces\Functions\BinaryFunctionInterface;
use PeekAndPoke\Component\Psi\Interfaces\Operation\TerminalOperationInterface;

/**
 * CollectToMapOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class CollectToMapOperation implements TerminalOperationInterface
{
    /** @var \Closure|BinaryFunctionInterface */
    private $keyMapper;
    /** @var \Closure|BinaryFunctionInterface */
    private $valueMapper;

    /**
     * @param \Closure|BinaryFunctionInterface $keyMapper
     * @param \Closure|BinaryFunctionInterface $valueMapper
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

        foreach ($set as $key => $item) {
            $result[$keyMapper($item, $key)] = $valueMapper($item, $key);
        }

        return $result;
    }
}
