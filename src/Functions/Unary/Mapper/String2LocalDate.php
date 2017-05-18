<?php
/**
 * File was created 02.10.2015 11:35
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\Mapper;

use PeekAndPoke\Component\Psi\Functions\Unary\AbstractParameterizedUnaryFunction;
use PeekAndPoke\Types\LocalDate;
use PeekAndPoke\Types\ValueHolder;

/**
 * String2LocalDate
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class String2LocalDate extends AbstractParameterizedUnaryFunction
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
