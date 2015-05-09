<?php
/**
 * File was created 06.05.2015 22:14
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Operation\FullSet;

/**
 * KeySortOperation
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class KeyReverseSortOperation extends AbstractSortingOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $data = iterator_to_array($set);

        krsort($data, $this->sortFlags);

        return new \ArrayIterator($data);
    }
}
