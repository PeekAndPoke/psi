<?php
/**
 * File was created 01.10.2015 18:02
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\Matcher;

use PeekAndPoke\Component\Psi\Functions\Unary\AbstractUnaryFunction;

/**
 * IsDateString
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsDateString extends AbstractUnaryFunction
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return $this->isValidDateString($input);
    }

    /**
     * @param string    $str
     *
     * @return bool
     */
    public static function isValidDateString($str)
    {
        if (!is_string($str)) {
            return false;
        }

        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})T((\d{2}):(\d{2}):(\d{2})(\.\d{3}(Z)?)?([+-]\d{2}:\d{2})?)$/', $str)) {
            return true;
        }

        $stamp = strtotime($str);

        if (!is_numeric($stamp)) {
            return false;
        }

        return checkdate(date('m', $stamp), date('d', $stamp), date('Y', $stamp));
    }
}
