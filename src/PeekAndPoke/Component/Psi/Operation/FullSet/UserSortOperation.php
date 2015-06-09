<?php
/**
 * File was created 06.05.2015 22:14
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\FullSet;

use PeekAndPoke\Component\Psi\Interfaces\Operation\FullSetOperationInterface;
use PeekAndPoke\Component\Psi\Operation\AbstractBinaryFunctionOperation;

/**
 * KeySortOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class UserSortOperation extends AbstractBinaryFunctionOperation implements FullSetOperationInterface
{
    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $data = iterator_to_array($set);

        usort($data, $this->biFunction);

        return new \ArrayIterator($data);
    }
}
