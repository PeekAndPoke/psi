<?php
/**
 * File was created 02.10.2015 11:35
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi\Str;

use PeekAndPoke\Component\Psi\Functions\Unary\ParameterizedUnaryFunction;
use PeekAndPoke\Types\LocalDate;
use PeekAndPoke\Types\ValueHolder;

/**
 * ToLocalDate maps a string to a LocalDate object using the given parameter as the timezone
 *
 * @see ParameterizedUnaryFunction
 * @see ToLocalDateTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ToLocalDate extends ParameterizedUnaryFunction
{
    /**
     * @param string|\DateTimeZone|ValueHolder $timezone
     */
    public function __construct($timezone)
    {
        parent::__construct($timezone);
    }

    /**
     * @param mixed $input
     *
     * @return LocalDate
     */
    public function __invoke($input)
    {
        return new LocalDate($input, $this->getValue());
    }
}
