<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\Matcher;

/**
 * IsNotInstanceOf
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNotInstanceOf extends IsInstanceOf
{
    /**
     * @param mixed $input
     *
     * @return bool
     */
    public function __invoke($input)
    {
        return ! parent::__invoke($input);
    }
}
