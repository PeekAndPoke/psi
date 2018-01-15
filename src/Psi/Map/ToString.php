<?php
/**
 * Created by gerk on 20.11.17 17:34
 */

namespace PeekAndPoke\Component\Psi\Psi\Map;

use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ToString implements UnaryFunction
{
    /** @var string */
    private $default;

    /**
     * @param string $default
     */
    public function __construct($default = '')
    {
        $this->default = (string) $default;
    }

    /**
     * @param mixed $input
     *
     * @return string
     */
    public function __invoke($input)
    {
        if (is_scalar($input)) {
            return (string) $input;
        }

        if (is_object($input) && method_exists($input, '__toString')) {
            return (string) $input;
        }

        return $this->default;
    }
}
