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
class KeySortOperation extends AbstractSortingOperation
{
    /**
     * {@inheritdoc}
     */
    public function apply(\Iterator $set)
    {
        $data = iterator_to_array($set);

        ksort($data, $this->sortFlags);

        return new \ArrayIterator($data);
    }
}
