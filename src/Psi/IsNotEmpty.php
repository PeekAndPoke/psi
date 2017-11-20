<?php
/**
 * File was created 29.05.2015 21:06
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

/**
 * IsNotEmpty
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNotEmpty extends IsEmpty
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
