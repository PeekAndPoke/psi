<?php
/**
 * File was created 30.05.2015 13:24
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Mocks;

/**
 * INTERNAL test class, not for any other use
 *
 * @visibility \PeekAndPoke\Component\Psi\Tests
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ToStringMock
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
    public function __toString()
    {
        return $this->string;
    }
}
