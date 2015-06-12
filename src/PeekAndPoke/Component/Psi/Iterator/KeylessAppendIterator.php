<?php
/**
 * File was created 12.06.2015 09:31
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Iterator;

/**
 * KeylessAppendIterator
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class KeylessAppendIterator extends \AppendIterator
{
    private $key;

    public function rewind()
    {
        $this->key = 0;

        parent::rewind();
    }

    public function next()
    {
        if ($this->valid()) {
            parent::next();
            ++$this->key;
        }
    }

    /**
     * @return null
     */
    public function key()
    {
        return $this->key;
    }
}
