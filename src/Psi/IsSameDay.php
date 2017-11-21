<?php
/**
 * File was created 01.10.2015 18:02
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Functions\Unary\ParameterizedUnaryFunction;
use PeekAndPoke\Types\LocalDate;

/**
 * IsSameDay checks if a LocalDate is on the same day as the given parameter
 *
 * TODO: implement for normal \DateTime as well
 *
 * @see ParameterizedUnaryFunction
 * @see IsSameDayIsNotSameDayTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsSameDay extends ParameterizedUnaryFunction
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
