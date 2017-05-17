<?php
/**
 * File was created 08.02.2016 22:28
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Functions\Unary\Mapper;

use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IdentityMapperTest extends TestCase
{
    public function testSubject()
    {
        $subject = new IdentityMapper();

        $this->assertSame(0, $subject(0));
        $this->assertSame('a', $subject('a'));

        $obj = new \stdClass();
        $this->assertSame($obj, $subject($obj));
    }
}
