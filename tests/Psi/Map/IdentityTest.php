<?php
/**
 * File was created 08.02.2016 22:28
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Psi\Map;

use PeekAndPoke\Component\Psi\Functions\Unary\Mapper\IdentityMapper;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IdentityTest extends TestCase
{
    public function testSubject()
    {
        $subject = new Identity();

        $this->assertSame(0, $subject(0, 0));
        $this->assertSame('a', $subject('a', 1));

        $obj = new \stdClass();
        $this->assertSame($obj, $subject($obj, 2));

        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject = new IdentityMapper();

        $this->assertSame(0, $subject(0, 0));
        $this->assertSame('a', $subject('a', 1));

        $obj = new \stdClass();
        $this->assertSame($obj, $subject($obj, 2));
    }
}
