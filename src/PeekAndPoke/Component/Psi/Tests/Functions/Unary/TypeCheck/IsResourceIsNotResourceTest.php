<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\TypeCheck;

use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotResource;
use PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsResource;
use PeekAndPoke\Component\Psi\Tests\Mocks\MockA;
use PeekAndPoke\Component\Psi\Tests\Mocks\ToStringMock;

/**
 * Test IsResource
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsResourceIsNotResourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsResource($psiValue, $expectedResult)
    {
        $subject = new IsResource();

        $result = $subject->apply($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @param $psiValue
     * @param $expectedResult
     *
     * @dataProvider provide
     */
    public function testIsNotResource($psiValue, $expectedResult)
    {
        $expectedResult = ! $expectedResult;

        $subject = new IsNotResource();

        $result = $subject->apply($psiValue);

        $this->assertSame($expectedResult, $result);
    }

    /**
     * @return array
     */
    public static function provide()
    {
        $reflect = new \ReflectionClass(new MockA());

        $openFile = fopen($reflect->getFileName(), 'rb');

        $closedFile = fopen($reflect->getFileName(), 'rb');
        fclose($closedFile);

        return [
            // positives
            [$openFile,             true],

            // negatives
            [$closedFile,           false],
            [null,                  false],
            [0,                     false],
            [true,                  false],
            [false,                 false],
            [new MockA(),           false],
            [new ToStringMock('a'), false],
        ];
    }
}
