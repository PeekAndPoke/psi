<?php
/**
 * File was created 12.06.2015 09:31
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Iterator;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class KeylessAppendIterator extends \AppendIterator
{
    /**
     * @var int
     */
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
     * @return int
     */
    public function key()
    {
        return $this->key;
    }
}
