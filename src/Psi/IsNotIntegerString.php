<?php
/**
 * File was created 01.10.2015 18:02
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

/**
 * IsNotIntegerString check if the string contains an integer
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNotIntegerString extends IsIntegerString
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
