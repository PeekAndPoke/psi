<?php
/**
 * File was created 06.05.2015 22:14
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\Interfaces\Operation\FullSetOperationInterface;

/**
 * FullSetOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
abstract class AbstractSortingOperation implements FullSetOperationInterface
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

    /**
     * @return int
     */
    public function getSortFlags()
    {
        return $this->sortFlags;
    }
}
