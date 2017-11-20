<?php
/**
 * File was created 01.10.2015 18:02
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

/**
 * IsNotNumericString check if the string contains an number
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNotNumericString extends IsNumericString
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
