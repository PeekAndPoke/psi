<?php
/**
 * Created by gerk on 29.11.17 07:01
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsEndingWith extends AbstractStringMatch
{
    /**
     * @param string $needle
     * @param string $haystack
     *
     * @return bool
     */
    public function match($needle, $haystack)
    {
        $len = strlen($needle);

        return $len === 0 || substr($haystack, -$len) === $needle;
    }
}
