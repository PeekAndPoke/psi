<?php
/**
 * File was created 06.05.2015 22:14
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\FullSetOperation;

/**
 * AbstractSortingOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractSortingOperation implements FullSetOperation
{
    /** @var int */
    protected $sortFlags;

    /**
     * @param int $sortFlags
     */
    public function __construct($sortFlags)
    {
        $this->sortFlags = $sortFlags;
    }
}
