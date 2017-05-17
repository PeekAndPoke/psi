<?php
/**
 * File was created 12.06.2015 09:39
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Interfaces;

use PeekAndPoke\Component\Psi\Exception\PsiException;
use PeekAndPoke\Component\Psi\PsiOptions;

/**
 * PsiFactoryInterface
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
interface PsiFactoryInterface
{
    /**
     * @return OperationChainSolverInterface
     */
    public function createSolver();

    /**
     * @param array      $iteratables
     * @param PsiOptions $options
     *
     * @return \Iterator
     *
     * @throws PsiException When one of the inputs cannot be used
     */
    public function createIterator(array $iteratables, PsiOptions $options);
}
