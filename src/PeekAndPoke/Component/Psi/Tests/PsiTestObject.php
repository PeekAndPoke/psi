<?php
/**
 * File was created 08.05.2015 15:10
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests;

/**
 * PsiTestObject
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiTestObject
{
    /** @var string */
    private $name;
    /** @var float */
    private $age;

    /**
     * @param string $name
     * @param float  $age
     */
    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param float $age
     *
     * @return $this
     */
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function incAge($value = 1)
    {
        $this->age += $value;

        return $this;
    }
}
