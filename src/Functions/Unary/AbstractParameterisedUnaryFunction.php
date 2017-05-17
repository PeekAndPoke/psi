<?php
/**
 * File was created 29.05.2015 21:26
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary;

use PeekAndPoke\Component\Psi\Interfaces\Functions\ValueHolderInterface;

/**
 * AbstractParameterisedUnaryFunction
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractParameterisedUnaryFunction extends AbstractUnaryFunction
{
    /** @var mixed|ValueHolderInterface */
    private $val;
    /** @var mixed|ValueHolderInterface */
    private $val2;

    /**
     * @param mixed|ValueHolderInterface $val
     * @param mixed|ValueHolderInterface $val2
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
        return $this->val instanceof ValueHolderInterface
            ? $this->val->getValue()
            : $this->val;
    }

    /**
     * @return mixed
     */
    public function getValue2()
    {
        return $this->val2 instanceof ValueHolderInterface
            ? $this->val2->getValue()
            : $this->val2;
    }
}
