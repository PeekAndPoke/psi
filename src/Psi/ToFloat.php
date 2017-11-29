<?php
/**
 * Created by gerk on 20.11.17 17:34
 */

namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\UnaryFunction;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ToFloat implements UnaryFunction
{
    /** @var float */
    private $default;

    /**
     * @param float $default
     */
    public function __construct($default = 0.0)
    {
        $this->default  = (float) $default;
    }

    /**
     * @param mixed $input
     *
     * @return float
     */
    public function __invoke($input)
    {
        if (is_object($input) && method_exists($input, '__toString')) {
            $input = (string) $input;
        }

        if (is_numeric($input)) {
            return (float) (0 + $input);
        }

        return $this->default;
    }
}
