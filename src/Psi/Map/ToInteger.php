<?php
/**
 * Created by gerk on 20.11.17 17:34
 */

namespace PeekAndPoke\Component\Psi\Psi\Map;

use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ToInteger implements UnaryFunction
{
    /** @var int */
    private $default;

    /**
     * ToInteger constructor.
     *
     * @param int $default
     */
    public function __construct($default = 0)
    {
        $this->default = (int) $default;
    }

    /**
     * @param mixed $input
     *
     * @return int
     */
    public function __invoke($input)
    {
        if (is_object($input) && method_exists($input, '__toString')) {
            $input = (string) $input;
        }

        if (is_numeric($input)) {
            return (int) (0 + $input);
        }

        return $this->default;
    }
}
