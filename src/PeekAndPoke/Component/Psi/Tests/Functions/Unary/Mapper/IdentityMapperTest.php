<?php
/**
 * File was created 08.02.2016 22:28
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Component\Psi\Tests\Functions\Unary\Mapper;

use PeekAndPoke\Component\Psi\Functions\Unary\Mapper\IdentityMapper;

/**
 * IdentityMapperTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class IdentityMapperTest extends \PHPUnit_Framework_TestCase
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
