<?php
/**
 * File was created 12.06.2015 09:51
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi;

/**
 * PsiOptions
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class PsiOptions
{
    /** @var bool */
    private $preserveKeysOfMultipleInputs = false;

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
