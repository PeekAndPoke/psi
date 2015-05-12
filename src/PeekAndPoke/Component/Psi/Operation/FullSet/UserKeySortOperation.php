<?php
/**
 * File was created 06.05.2015 22:14
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\Functions\BinaryFunction;
use PeekAndPoke\Component\Psi\Interfaces\Functions\BinaryFunctionInterface;
use PeekAndPoke\Component\Psi\Interfaces\Operation\FullSetOperationInterface;

/**
 * UserKeySortOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class UserKeySortOperation implements FullSetOperationInterface
{
    /** @var BinaryFunctionInterface */
    private $biFunction;

    /**
     * @param \Closure|BinaryFunctionInterface $biFunction
     */
    public function __construct($biFunction)
    {
        if ($biFunction instanceof BinaryFunctionInterface) {
            $this->biFunction = $biFunction;
        } else {
            $this->biFunction = new BinaryFunction($biFunction);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $data = iterator_to_array($set);

        uksort($data, $this->biFunction);

        return new \ArrayIterator($data);
    }
}