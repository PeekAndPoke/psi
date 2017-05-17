<?php
/**
 * File was created 08.05.2015 15:26
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\Interfaces\Operation\TerminalOperationInterface;

/**
 * GetFirstOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class GetFirstOperation implements TerminalOperationInterface
{
    /** @var */
    private $default;

    /**
     * @param mixed $default
     */
    public function __construct($default)
    {
        $this->default = $default;
    }

    /**
     * @param \Iterator $set
     *
     * @return mixed
     */
    public function apply(\Iterator $set)
    {
        $set->rewind();

        return $set->valid() ? $set->current() : $this->default;
    }
}
