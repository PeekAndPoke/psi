<?php
/**
 * File was created 02.10.2015 11:35
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\Mapper;

use PeekAndPoke\Component\Psi\Functions\Unary\AbstractParameterisedUnaryFunction;
use PeekAndPoke\Component\Psi\Interfaces\Functions\ValueHolderInterface;
use PeekAndPoke\Horizons\DateAndTime\LocalDate;

/**
 * String2LocalDate
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class String2LocalDate extends AbstractParameterisedUnaryFunction
{
    /**
     * @param string|\DateTimeZone|ValueHolderInterface $timezone
     */
    public function __construct($timezone)
    {
        parent::__construct($timezone);
    }

    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function __invoke($input)
    {
        return new LocalDate($input, $this->getValue());
    }
}
