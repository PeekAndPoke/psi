<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsCallable;
use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotCallable;
use PeekAndPoke\Component\Psi\Tests\Mocks\CallableMock;
use PeekAndPoke\Component\Psi\Tests\Mocks\MockA;

/**
 * Test IsCallableIsNotCallableTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsCallableIsNotCallableTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsCallable($psiValue, $expectedResult)
    {
        $subject = new IsCallable();

        $result = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotCallable($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotCallable();

        $result = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        return [
            // positives
            [function () {},        true],
            [new CallableMock(),    true],

            // negatives
            [new \ArrayIterator(),  false],
            [true,                  false],
            [null,                  false],
            [0,                     false],
            ['Z',                   false],
            [new MockA(),           false],
        ];
    }
}
