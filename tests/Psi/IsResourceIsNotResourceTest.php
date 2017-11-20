<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi;

use PeekAndPoke\Component\Psi\Mocks\MockA;
use PeekAndPoke\Component\Psi\Mocks\ToStringMock;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IsResourceIsNotResourceTest extends TestCase
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
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsResource();
        $result  = $subject->__invoke($psiValue);

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
        $result  = $subject->__invoke($psiValue);

        $this->assertSame($expectedResult, $result);


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new \PeekAndPoke\Component\Psi\Functions\Unary\TypeCheck\IsNotResource();
        $result  = $subject->__invoke($psiValue);

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
