<?php
/**
 * Created by gerk on 27.11.17 16:35
 */

namespace PeekAndPoke\Component\Psi\Stubs;

use Traversable;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class UnitTestTraversable implements \IteratorAggregate
{
    /** @var array */
    private $data;

    /**
     * UnitTestTraversable constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Retrieve an external iterator
     * @link  http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }
}
