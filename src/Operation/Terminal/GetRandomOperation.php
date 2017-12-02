<?php
/**
 * File was created 08.05.2015 15:26
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\Terminal;

use PeekAndPoke\Component\Psi\TerminalOperation;

/**
 * GetRandomOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class GetRandomOperation implements TerminalOperation
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
        $data  = array_values(iterator_to_array($set));
        $count = count($data);

        if ($count === 0) {
            return $this->default;
        }

        return $data[(int) mt_rand(0, $count - 1)];
    }
}
