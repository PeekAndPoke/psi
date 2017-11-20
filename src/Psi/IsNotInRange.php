<?php
/**
 * File was created 29.05.2015 21:25
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

/**
 * IsNotInRange
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsNotInRange extends IsInRange
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
