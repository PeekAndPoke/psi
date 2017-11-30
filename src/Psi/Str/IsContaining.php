<?php
/**
 * Created by gerk on 30.11.17 05:44
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsContaining extends AbstractStringMatch
{
    public function match($needle, $haystack)
    {
        $len = strlen($needle);

        return $len > 0 && strpos($haystack, $needle) !== false;
    }
}
