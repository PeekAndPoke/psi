<?php
/**
 * Created by gerk on 02.12.17 10:13
 */

namespace PeekAndPoke\Component\Psi\Solver;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IntermediateContext
{
    /**
     * A storage where each operation can store custom data
     *
     * @var \SplObjectStorage
     */
    public $memory;

    /**
     * Written by Intermediate operations to indicate whether an element of the stream is to be used
     *
     * @var bool
     */
    public $outUseItem = true;

    /**
     * Written by Intermediate operations to indicate whether to continue with the next element or not
     *
     * @var bool
     */
    public $outCanContinue = true;

    public function __construct()
    {
        $this->memory = new \SplObjectStorage();
    }
}
