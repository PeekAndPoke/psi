<?php
/**
 * Created by gerk on 27.11.17 06:33
 */

namespace PeekAndPoke\Component\Psi;

use PeekAndPoke\Component\Psi\Iterator\KeylessAppendIterator;
use PeekAndPoke\Component\Psi\Stubs\UnitTestIterator;
use PeekAndPoke\Component\Psi\Stubs\UnitTestTraversable;
use PHPUnit\Framework\TestCase;

/**
 *
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class DefaultPsiFactoryTest extends TestCase
{
    public function testNoInputs()
    {
        $subject = new DefaultPsiFactory();

        $result = $subject->createIterator([], new PsiOptions());

        $this->assertInstanceOf(\ArrayIterator::class, $result);
        $this->assertCount(0, $result);
    }

    public function testCreateIteratorFromSingleArray()
    {
        $subject = new DefaultPsiFactory();

        $result = $subject->createIterator([[1, 2]], new PsiOptions());

        $this->assertInstanceOf(\ArrayIterator::class, $result);
        $this->assertCount(2, $result);
    }

    public function testCreateIteratorFromSingleArrayIterator()
    {
        $subject = new DefaultPsiFactory();

        $result = $subject->createIterator([new \ArrayIterator([1, 2])], new PsiOptions());

        $this->assertInstanceOf(\ArrayIterator::class, $result);
        $this->assertCount(2, $result);
    }

    public function testCreateIteratorFromSingleCollection()
    {
        $subject = new DefaultPsiFactory();

        $result = $subject->createIterator([new UnitTestIterator([1, 2])], new PsiOptions());

        $this->assertInstanceOf(UnitTestIterator::class, $result);
        $this->assertCount(2, $result);
    }

    public function testCreateIteratorFromMultipleInputsWithoutPreserveKeysOption()
    {
        $subject = new DefaultPsiFactory();

        /** @var \AppendIterator $result */
        $result = $subject->createIterator(
            [
                [1, 2],
                new \ArrayIterator([3, 4]),
                new UnitTestIterator([5, 6]),
                new UnitTestTraversable([7, 8]),
            ],
            new PsiOptions()
        );

        // by default the keyless iterator is to be used
        $this->assertInstanceOf(KeylessAppendIterator::class, $result);

        // number of data elements must be correct
        $this->assertCount(8, $result);

        // number of child-iterators must be correct
        $childIterators = $result->getArrayIterator();
        $this->assertCount(4, $childIterators);

        // check that each child iterator has the correct type
        $this->assertInstanceOf(\ArrayIterator::class, $childIterators[0]);
        $this->assertInstanceOf(\ArrayIterator::class, $childIterators[1]);
        $this->assertInstanceOf(UnitTestIterator::class, $childIterators[2]);
        $this->assertInstanceOf(\IteratorIterator::class, $childIterators[3]);
    }

    public function testCreateIteratorFromMultipleInputsWithPreserveKeysOption()
    {
        $subject = new DefaultPsiFactory();

        /** @var \AppendIterator $result */
        $result = $subject->createIterator(
            [
                [1, 2],
                new \ArrayIterator([3, 4]),
                new UnitTestIterator([5, 6]),
                new UnitTestTraversable([7, 8]),
            ],
            (new PsiOptions())->setPreserveKeysOfMultipleInputs(true)
        );

        // in this case the default AppendIterator is to be used
        $this->assertInstanceOf(\AppendIterator::class, $result);
        $this->assertNotInstanceOf(KeylessAppendIterator::class, $result);

        // number of data elements must be correct
        $this->assertCount(8, $result);

        // number of child-iterators must be correct
        $childIterators = $result->getArrayIterator();
        $this->assertCount(4, $childIterators);

        // check that each child iterator has the correct type
        $this->assertInstanceOf(\ArrayIterator::class, $childIterators[0]);
        $this->assertInstanceOf(\ArrayIterator::class, $childIterators[1]);
        $this->assertInstanceOf(UnitTestIterator::class, $childIterators[2]);
        $this->assertInstanceOf(\IteratorIterator::class, $childIterators[3]);
    }

    /**
     * @param array $input
     *
     * @dataProvider provideTestInvalidInputThrows
     *
     * @expectedException \PeekAndPoke\Component\Psi\Exception\PsiException
     */
    public function testInvalidInputThrows($input)
    {
        $subject = new DefaultPsiFactory();

        $subject->createIterator($input, new PsiOptions());
    }

    public function provideTestInvalidInputThrows()
    {
        // the 0 or '0' is what will make the factory throw

        return [
            [
                [0],
            ],
            [
                [new \ArrayIterator(), 0],
            ],
            [
                [[], 0],
            ],
            [
                [new \ArrayIterator(), '0'],
            ],
            [
                [[], '0'],
            ],
            [
                [0, new \ArrayIterator()],
            ],
            [
                [0, []],
            ],
        ];
    }
}
