<?php
/**
 * File was created 12.06.2015 12:38
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\FullSet;


use PeekAndPoke\Component\Psi\Interfaces\Operation\FullSetOperationInterface;
use PeekAndPoke\Component\Psi\Operation\AbstractUnaryFunctionOperation;

/**
 * SortByOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class SortByOperation extends AbstractUnaryFunctionOperation implements FullSetOperationInterface
{
    /**
     * @param \Iterator $set
     *
     * @return \Iterator
     */
    public function apply(\Iterator $set)
    {
        $func = $this->function;

        $data = iterator_to_array($set);

        usort(
            $data,
            function ($i1, $i2) use ($func) {

                $val1 = $func($i1);
                $val2 = $func($i2);

                if ($val1 === $val2) {
                    return null;
                }
                return $val1 > $val2 ? 1 : -1;
            }
        );

        return new \ArrayIterator($data);

    }
}
