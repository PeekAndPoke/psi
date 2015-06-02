<?php
/**
 * File was created 06.05.2015 16:09
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi;

use PeekAndPoke\Component\Psi\Exception\PsiException;
use PeekAndPoke\Component\Psi\Interfaces\Functions\BinaryFunctionInterface;
use PeekAndPoke\Component\Psi\Interfaces\Functions\UnaryFunctionInterface;
use PeekAndPoke\Component\Psi\Interfaces\Operation\TerminalOperationInterface;
use PeekAndPoke\Component\Psi\Interfaces\OperationChainSolverInterface;
use PeekAndPoke\Component\Psi\Operation\FullSet\FlattenOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\KeyReverseSortOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\KeySortOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\ReverseOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\ReverseSortOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\SortOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\UniqueOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\UserKeySortOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\UserSortOperation;
use PeekAndPoke\Component\Psi\Operation\Intermediate\EmptyIntermediateOp;
use PeekAndPoke\Component\Psi\Operation\Intermediate\Functional\EachOperation;
use PeekAndPoke\Component\Psi\Operation\Intermediate\Functional\MapOperation;
use PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate\AnyMatchPredicate;
use PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate\FilterKeyPredicate;
use PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate\FilterPredicate;
use PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate\FilterValueKeyPredicate;
use PeekAndPoke\Component\Psi\Operation\Terminal\AverageOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\CollectOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\CollectToArrayOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\CountOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\GetFirstOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\JoinOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\MaxOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\MinOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\SumOperation;
use PeekAndPoke\Component\Psi\Solver\DefaultOperationChainSolver;

/**
 * Psi the Php Streams Api Implementation (inspired by Java Streams Api)
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class Psi
{
    /** @var \Iterator */
    private $input;
    /** @var \ArrayIterator */
    private $operationChain = null;
    /** @var OperationChainSolverInterface  */
    private $operationChainSolver = null;

    /**
     * @param mixed $_ Everything that can be iterated, Provide as many params as you want (from 1 to n)
     *
     * @return Psi
     * @throws PsiException
     */
    public static function it($_ = null)
    {
        $factory = new PsiFactory();

        $iterator = $factory->createIterator(func_get_args());

        return new Psi($iterator);
    }

    /**
     * @param \Iterator $input
     */
    protected function __construct(\Iterator $input)
    {
        $this->operationChain       = new \ArrayIterator();
        $this->operationChainSolver = new DefaultOperationChainSolver();

        $this->input = $input;
    }

    ////  CONFIGURATION METHODS  ///////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param OperationChainSolverInterface $solver
     *
     * @return $this
     */
    public function useSolver(OperationChainSolverInterface $solver)
    {
        $this->operationChainSolver = $solver;

        return $this;
    }

    ////  INTERMEDIATE OPERATIONS - working on one item at a time  /////////////////////////////////////////////////////

    /**
     * @param \Closure|UnaryFunctionInterface $unaryFunction
     *
     * @return $this
     */
    public function filter($unaryFunction)
    {
        $this->operationChain->append(new FilterPredicate($unaryFunction));

        return $this;
    }

    /**
     * @param \Closure|UnaryFunctionInterface $unaryFunction
     *
     * @return $this
     */
    public function filterKey($unaryFunction)
    {
        $this->operationChain->append(new FilterKeyPredicate($unaryFunction));

        return $this;
    }

    /**
     * @param \Closure|BinaryFunctionInterface $biPredicate
     *
     * @return $this
     */
    public function filterValueKey($biPredicate)
    {
        $this->operationChain->append(new FilterValueKeyPredicate($biPredicate));

        return $this;
    }

    /**
     * @param \Closure|UnaryFunctionInterface $unaryFunction
     *
     * @return $this
     */
    public function anyMatch($unaryFunction)
    {
        $this->operationChain->append(new AnyMatchPredicate($unaryFunction));

        return $this;
    }

    /**
     * @param \Closure|BinaryFunctionInterface $biFunction
     *
     * @return $this
     */
    public function each($biFunction)
    {
        $this->operationChain->append(new EachOperation($biFunction));

        return $this;
    }

    /**
     * @param \Closure|BinaryFunctionInterface $function
     *
     * @return $this
     */
    public function map($function)
    {
        $this->operationChain->append(new MapOperation($function));

        return $this;
    }

    ////  FULL SET OPERATIONS - working on all items at a time  ////////////////////////////////////////////////////////

    /**
     * Flattens the input recursively into a no longer nested iterator.
     *
     * Example: [1, [2, [3, 4], 5], 6] will become [1, 2, 3, 4, 5, 6]
     *
     * @return $this
     */
    public function flatten()
    {
        $this->operationChain->append(new FlattenOperation());

        return $this;
    }

    /**
     * @param int|null $sortFlags
     *
     * @see sort()
     *
     * @return $this
     */
    public function sort($sortFlags = null)
    {
        $this->operationChain->append(new SortOperation($sortFlags));

        return $this;
    }

    /**
     * @param int|null $sortFlags
     *
     * @see sort()
     *
     * @return $this
     */
    public function rsort($sortFlags = null)
    {
        $this->operationChain->append(new ReverseSortOperation($sortFlags));

        return $this;
    }

    /**
     * @param int|null $sortFlags
     *
     * @see ksort()
     *
     * @return $this
     */
    public function ksort($sortFlags = null)
    {
        $this->operationChain->append(new KeySortOperation($sortFlags));

        return $this;
    }

    /**
     * @param int|null $sortFlags
     *
     * @return $this
     */
    public function krsort($sortFlags = null)
    {
        $this->operationChain->append(new KeyReverseSortOperation($sortFlags));

        return $this;
    }

    /**
     * @param BinaryFunctionInterface|\Closure $biFunction
     *
     * @return $this
     */
    public function usort($biFunction)
    {
        $this->operationChain->append(new UserSortOperation($biFunction));

        return $this;
    }

    /**
     * @param BinaryFunctionInterface|\Closure $biFunction
     *
     * @return $this
     */
    public function uksort($biFunction)
    {
        $this->operationChain->append(new UserKeySortOperation($biFunction));

        return $this;
    }

    /**
     * @return $this
     */
    public function reverse()
    {
        $this->operationChain->append(new ReverseOperation());

        return $this;
    }

    /**
     * @return $this
     */
    public function unique()
    {
        $this->operationChain->append(new UniqueOperation());

        return $this;
    }

    ////  TERMINAL OPERATIONS - generating output and ending the chain  ////////////////////////////////////////////////

    /**
     * @return \Iterator
     */
    public function collect()
    {
        return $this->solveOperationsAndApplyTerminal(new CollectOperation());
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->solveOperationsAndApplyTerminal(new CollectToArrayOperation());
    }

    /**
     * @param string $delimiter
     *
     * @return string
     */
    public function join($delimiter)
    {
        return $this->solveOperationsAndApplyTerminal(new JoinOperation($delimiter));
    }

    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function getFirst($default = null)
    {
        return $this->solveOperationsAndApplyTerminal(new GetFirstOperation($default));
    }

    /**
     * @return float
     */
    public function min()
    {
        return $this->solveOperationsAndApplyTerminal(new MinOperation());
    }

    /**
     * @return float
     */
    public function max()
    {
        return $this->solveOperationsAndApplyTerminal(new MaxOperation());
    }

    /**
     * @return float
     */
    public function sum()
    {
        return $this->solveOperationsAndApplyTerminal(new SumOperation());
    }

    /**
     * @return float
     */
    public function avg()
    {
        return $this->solveOperationsAndApplyTerminal(new AverageOperation());
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->solveOperationsAndApplyTerminal(new CountOperation());
    }

    ////  PRIVATE METHODS  /////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param TerminalOperationInterface $terminal
     *
     * @return mixed
     */
    private function solveOperationsAndApplyTerminal(TerminalOperationInterface $terminal)
    {
        // When we have not a single operation in the chain we add a dummy one, in order to map down multiple input
        // living inside the \AppendIterator (in case we have multiple inputs)
        if (count($this->operationChain) == 0) {
            $this->operationChain->append(new EmptyIntermediateOp());
        }

        $result = $this->operationChainSolver->solve($this->operationChain, $this->input);

        return $terminal->apply($result);
    }
}
