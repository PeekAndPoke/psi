<?php
/**
 * File was created 07.05.2015 09:11
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\Interfaces\TerminalOperation;

/**
 * JoinOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class JoinOperation implements TerminalOperation
{
    /** @var */
    private $delimiter;

    /**
     * @param $delimiter
     */
    public function __construct($delimiter)
    {
        $this->delimiter = $delimiter;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function apply(\Iterator $set)
    {
        $data = iterator_to_array($set);

        return implode($this->delimiter, $data);
    }
}
