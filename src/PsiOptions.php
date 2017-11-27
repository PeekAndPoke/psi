<?php
/**
 * File was created 12.06.2015 09:51
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiOptions
{
    /** @var PsiFactory */
    private $factory;
    /** @var bool */
    private $preserveKeysOfMultipleInputs = false;

    public function __construct()
    {
        $this->factory = new DefaultPsiFactory();
    }

    /**
     * @return PsiFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }

    /**
     * @param PsiFactory $factory
     *
     * @return $this
     */
    public function setFactory(PsiFactory $factory)
    {
        $this->factory = $factory;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isPreserveKeysOfMultipleInputs()
    {
        return $this->preserveKeysOfMultipleInputs;
    }

    /**
     * @param boolean $preserveKeysOfMultipleInputs
     *
     * @return $this
     */
    public function setPreserveKeysOfMultipleInputs($preserveKeysOfMultipleInputs)
    {
        $this->preserveKeysOfMultipleInputs = $preserveKeysOfMultipleInputs;

        return $this;
    }
}
