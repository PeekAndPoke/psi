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
class StartingWith extends AbstractStringMatch
{
    /**
     * @param string $needle
     * @param string $haystack
     *
     * @return bool
     */
    public function match($needle, $haystack)
    {
        /** @noinspection SubStrUsedAsStrPosInspection */
        return substr($haystack, 0, strlen($needle)) === $needle;
    }
}
