<?php
/**
 * File was created 29.05.2015 21:26
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary;

/**
 * AbstractParameterisedUnaryFunction
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractParameterisedUnaryFunction extends AbstractUnaryFunction
{
    /** @var string */
    protected $val;

    /**
     * @param string $val
     */
    public function __construct($val)
    {
        $this->val = $val;
    }
}
