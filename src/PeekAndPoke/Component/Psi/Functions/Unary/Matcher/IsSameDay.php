<?php
/**
 * File was created 01.10.2015 18:02
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\Matcher;

use PeekAndPoke\Component\Psi\Functions\Unary\AbstractParameterisedUnaryFunction;
use PeekAndPoke\Types\LocalDate;

/**
 * IsSameDay
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsSameDay extends AbstractParameterisedUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        $val = $this->getValue();

        if (!$val instanceof LocalDate || !$input instanceof LocalDate) {
            return false;
        }

        return $val->getStartOfDay()->isEqual($input->getStartOfDay());
    }
}
