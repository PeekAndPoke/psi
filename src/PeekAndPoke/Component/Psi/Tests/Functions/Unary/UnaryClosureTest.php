<?php
/**
 * File was created 30.05.2015 13:16
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary;

use PeekAndPoke\Component\Psi\Functions\Unary\UnaryClosure;

/**
 * Test UnaryClosureTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class UnaryClosureTest extends \PHPUnit_Framework_TestCase
{
    /**
     */
    public function testUnaryClosureInvocation()
    {
        $subject = new UnaryClosure(function ($i) { return $i + 1; });

        $resultApply = $subject(1);
        $this->assertSame(2, $resultApply);

        $resultInvoke = $subject->__invoke(10);
        $this->assertSame(11, $resultInvoke);
    }
}
