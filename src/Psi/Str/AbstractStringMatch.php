<?php
/**
 * Created by gerk on 29.11.17 08:38
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

use PeekAndPoke\Component\Psi\Functions\ParameterizedUnaryFunction;
use PeekAndPoke\Types\ValueHolder;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractStringMatch extends ParameterizedUnaryFunction
{
    /**
     * @param string|ValueHolder $search
     * @param bool|ValueHolder   $caseSensitive
     */
    public function __construct($search, $caseSensitive = true)
    {
        parent::__construct($search, $caseSensitive);
    }

    /**
     * This is where the real comparison happens
     *
     * @param string $needle
     * @param string $haystack
     *
     * @return bool
     */
    abstract public function match($needle, $haystack);

    public function __invoke($input)
    {
        if (! is_string($input)) {
            return false;
        }

        $search = $this->getValue();

        if (! is_string($search)) {
            return false;
        }

        if ((bool) $this->getValue2()) {
            return $this->match($search, $input);
        }

        return $this->match(strtolower($search), strtolower($input));
    }
}
