<?php
/**
 * File was created 06.05.2015 16:09
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi;

use PeekAndPoke\Component\Psi\Exception\PsiException;
use PeekAndPoke\Component\Psi\Functions\Unary\Mapper\IdentityMapper;
use PeekAndPoke\Component\Psi\Interfaces\Functions\BinaryFunctionInterface;
use PeekAndPoke\Component\Psi\Interfaces\Functions\UnaryFunctionInterface;
use PeekAndPoke\Component\Psi\Interfaces\Operation\TerminalOperationInterface;
use PeekAndPoke\Component\Psi\Interfaces\PsiFactoryInterface;
use PeekAndPoke\Component\Psi\Operation\FullSet\FlattenOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\GroupOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\KeyReverseSortOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\KeySortOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\ReverseOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\ReverseSortOperation;
use PeekAndPoke\Component\Psi\Operation\FullSet\SortByOperation;
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
use PeekAndPoke\Component\Psi\Operation\Terminal\CollectToKeyValueArrayOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\CollectToMapOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\CountOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\GetFirstOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\JoinOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\MaxOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\MinOperation;
use PeekAndPoke\Component\Psi\Operation\Terminal\SumOperation;

/** @noinspection SingletonFactoryPatternViolationInspection */
/**
 * Psi the Php Streams Api Implementation (inspired by Java Streams Api)
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class Psi
{
    /** @var array */
    private $inputs;

    /** @var \ArrayIterator */
    private $operationChain;
    /** @var PsiFactoryInterface */
    private $factory;

    private $options;

    /**
     * @param mixed $_ Everything that can be iterated, Provide as many params as you want (from 1 to n)
     *
     * @return Psi
     * @throws PsiException
     */
    public static function it($_ = null)
    {
        return new Psi(func_get_args());
    }

    /**
     * @param array $inputs
     */
    protected function __construct($inputs)
    {
        $this->operationChain = new \ArrayIterator();
        $this->factory        = new PsiFactory();
        $this->options        = new PsiOptions();

        $this->inputs = $inputs;
    }

    ////  CONFIGURATION METHODS  ///////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param PsiFactoryInterface $factory
     *
     * @return $this
     */
    public function useFactory(PsiFactoryInterface $factory)
    {
        $this->factory = $factory;

        return $this;
    }

    /**
     * Configure if the keys should be preserved when we have multiple inputs.
     *
     * Depending on the inputs, preserving the keys will most likely lead to conflicts in the operation like
     * - sort
     * - unique
     * Thus the outcome of these operations will be unpredicted.
     *
     * By default this option is turned OFF. So for multiple inputs the keys will get lost. On the other hand all
     * values will survive all operations.
     *
     * @param bool $preserve
     *
     * @return $this
     */
    public function preserveKeysOfMultipleInputs($preserve = true)
    {
        $this->options->setPreserveKeysOfMultipleInputs($preserve);

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
     * @param UnaryFunctionInterface|\Closure $function
     *
     * @return $this
     */
    public function group($function)
    {
        $this->operationChain->append(new GroupOperation($function));

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
     * @param UnaryFunctionInterface|\Closure $function Return the value used for comparison
     *
     * @return $this
     */
    public function sortBy($function)
    {
        $this->operationChain->append(new SortByOperation($function));

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
     * @param bool $compareStrict
     *
     * @return $this
     */
    public function unique($compareStrict = true)
    {
        $this->operationChain->append(new UniqueOperation($compareStrict));

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

    ////  TERMINAL OPERATIONS - generating output and ending the chain  ////////////////////////////////////////////////

    /**
     * @return \Iterator
     */
    public function collect()
    {
        return $this->solveOperationsAndApplyTerminal(new CollectOperation());
    }

    /**
     * Terminal operation that will collect a "real" array with numeric keys 0, 1, 2, ...
     *
     * The original keys will be lost. If you need the original keys please use toKeyValueArray()
     *
     * @see Psi::toKeyValueArray()
     *
     * @return array
     */
    public function toArray()
    {
        return $this->solveOperationsAndApplyTerminal(new CollectToArrayOperation());
    }

    /**
     * Terminal operation that will collect a php array while keeping the keys.
     *
     * Use this over toArray() if keeping the keys is necessary
     *
     * @see Psi::toArray()
     *
     * @return array
     */
    public function toKeyValueArray()
    {
        return $this->solveOperationsAndApplyTerminal(new CollectToKeyValueArrayOperation());
    }

    /**
     * @param BinaryFunctionInterface|Callable $keyMapper   Maps the value down to a string or number
     * @param BinaryFunctionInterface|Callable $valueMapper If not given the value will not be changed
     *
     * @return array
     */
    public function toMap($keyMapper, $valueMapper = null)
    {
        return $this->solveOperationsAndApplyTerminal(
            new CollectToMapOperation(
                $keyMapper,
                $valueMapper ? $valueMapper : new IdentityMapper()
            )
        );
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
        if (count($this->operationChain) === 0) {
            $this->operationChain->append(new EmptyIntermediateOp());
        }

        $iterator = $this->factory->createIterator($this->inputs, $this->options);
        $solver   = $this->factory->createSolver();

        $result = $solver->solve($this->operationChain, $iterator);

        return $terminal->apply($result);
    }
}