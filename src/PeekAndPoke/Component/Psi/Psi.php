<?php
/**
 * File was created 06.05.2015 16:09
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi;

use PeekAndPoke\Component\Psi\Exception\PsiException;
use PeekAndPoke\Component\Psi\Interfaces\Functions\BinaryFunctionInterface;
use PeekAndPoke\Component\Psi\Interfaces\Operation\TerminalOperationInterface;
use PeekAndPoke\Component\Psi\Interfaces\OperationChainSolverInterface;
use PeekAndPoke\Component\Psi\Interfaces\Predicate\BinaryPredicateInterface;
use PeekAndPoke\Component\Psi\Interfaces\Predicate\UnaryPredicateInterface;
use PeekAndPoke\Component\Psi\Operation\FullSet\FlatMapOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\KeyReverseSortOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\KeySortOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\ReverseOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\ReverseSortOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\SortOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\UniqueOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\UserSortOperation;
use PeekAndPoke\Component\Psi\Operation\Intermediate\Functional\EachOperation;
use PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate\FilterKeyPredicate;
use PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate\FilterValueKeyPredicate;
use PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate\FilterPredicate;
use PeekAndPoke\Component\Psi\Operation\Intermediate\Predicate\AnyMatchPredicate;
use PeekAndPoke\Component\Psi\Operation\Intermediate\Functional\MapOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\AverageOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\CollectOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\GetFirstOperation;
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
     * @param array|\Iterator $streamable
     *
     * @return Psi
     * @throws PsiException
     */
    public static function it($streamable)
    {
        if ($streamable instanceof \Iterator) {
            return new Psi($streamable);
        }

        if ($streamable instanceof \Traversable) {
            // TODO: figure out what to do
//            return new Psi(new \ArrayIterator($streamable));
        }

        if (is_array($streamable)) {
            return new Psi(new \ArrayIterator($streamable));
        }


        throw new PsiException('Invalid input, not an array an iterator');
    }

    /**
     * Use this to suppress warnings about unused parameters
     *
     * @param null $a
     */
    public static function nop($a = null)
    {
        // nop
    }

    /**
     * @param \Iterator $input
     */
    private function __construct(\Iterator $input)
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
     * @param \Closure|UnaryPredicateInterface $predicate
     *
     * @return $this
     */
    public function filter($predicate)
    {
        $this->operationChain->append(new FilterPredicate($predicate));

        return $this;
    }

    /**
     * @param \Closure|UnaryPredicateInterface $predicate
     *
     * @return $this
     */
    public function filterKey($predicate)
    {
        $this->operationChain->append(new FilterKeyPredicate($predicate));

        return $this;
    }

    /**
     * @param \Closure|BinaryPredicateInterface $biPredicate
     *
     * @return $this
     */
    public function filterValueKey($biPredicate)
    {
        $this->operationChain->append(new FilterValueKeyPredicate($biPredicate));

        return $this;
    }

    /**
     * @param $predicate
     *
     * @return $this
     */
    public function anyMatch($predicate)
    {
        $this->operationChain->append(new AnyMatchPredicate($predicate));

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
     * @return $this
     */
    public function flatMap()
    {
        $this->operationChain->append(new FlatMapOperation());

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
     * @param \Closure|BinaryFunctionInterface $biFunction
     *
     * @return $this
     */
    public function usort($biFunction)
    {
        $this->operationChain->append(new UserSortOperation($biFunction));

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

    ////  PRIVATE METHODS  /////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param TerminalOperationInterface $terminal
     *
     * @return mixed
     */
    private function solveOperationsAndApplyTerminal(TerminalOperationInterface $terminal)
    {
        $result = $this->operationChainSolver->solve($this->operationChain, $this->input);

        return $terminal->apply($result);
    }
}
