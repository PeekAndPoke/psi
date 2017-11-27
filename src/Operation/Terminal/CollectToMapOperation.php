<?php
/**
 * File was created 07.05.2015 09:11
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\BinaryFunction;
use PeekAndPoke\Component\Psi\Psi\Map\Identity;
use PeekAndPoke\Component\Psi\TerminalOperation;
use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 * CollectToMapOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class CollectToMapOperation implements TerminalOperation
{
    /** @var \Closure|UnaryFunction|BinaryFunction */
    private $keyMapper;
    /** @var \Closure|UnaryFunction|BinaryFunction */
    private $valueMapper;

    /**
     * @param \Closure|UnaryFunction|BinaryFunction $keyMapper
     * @param \Closure|UnaryFunction|BinaryFunction $valueMapper
     */
    public function __construct($keyMapper, $valueMapper = null)
    {
        $this->keyMapper   = $keyMapper;
        $this->valueMapper = $valueMapper ?: new Identity();
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
