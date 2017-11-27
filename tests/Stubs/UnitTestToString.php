<?php
/**
 * File was created 30.05.2015 13:24
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Stubs;

/**
 * @visibility \PeekAndPoke\Component\Psi
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class UnitTestToString
{
    /**
     * @var string
     */
    private $string;

    /**
     * @param string $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * @return string
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }
}
