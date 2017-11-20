<?php
/**
 * File was created 29.05.2015 21:26
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Functions\Unary;

use PeekAndPoke\Types\ValueHolder;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractParameterizedUnaryFunction extends AbstractUnaryFunction
{
    /** @var mixed|ValueHolder */
    private $val;
    /** @var mixed|ValueHolder */
    private $val2;

    /**
     * @param mixed|ValueHolder $val
     * @param mixed|ValueHolder $val2
     */
    public function __construct($val, $val2 = null)
    {
        parent::__construct();

        $this->val  = $val;
        $this->val2 = $val2;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->val instanceof ValueHolder
            ? $this->val->getValue()
            : $this->val;
    }

    /**
     * @return mixed
     */
    public function getValue2()
    {
        return $this->val2 instanceof ValueHolder
            ? $this->val2->getValue()
            : $this->val2;
    }
}
