<?php
/**
 * File was created 27.08.2015 08:44
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\Mapper;

use PeekAndPoke\Component\Psi\Interfaces\Functions\UnaryFunctionInterface;

/**
 * IdentityMap
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IdentityMapper implements UnaryFunctionInterface
{
    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function __invoke($input)
    {
        return $input;
    }
}
