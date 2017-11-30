<?php
/**
 * Created by gerk on 30.11.17 05:44
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

use PeekAndPoke\Component\Psi\Functions\ParameterizedUnaryFunction;
use PeekAndPoke\Types\ValueHolder;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsMatchingRegex extends ParameterizedUnaryFunction
{
    /**
     * @param mixed|ValueHolder $regex
     */
    public function __construct($regex)
    {
        parent::__construct($regex);
    }

    public function __invoke($input)
    {
        if (! is_scalar($input)) {
            return false;
        }

        $regex = $this->getValue();

        return preg_match($regex, $input) === 1;
    }
}
