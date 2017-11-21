<?php
/**
 * File was created 08.02.2016 22:31
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */

namespace PeekAndPoke\Component\Psi\Psi\Str;

use PeekAndPoke\Component\Psi\Functions\Unary\Mapper\String2LocalDate;
use PeekAndPoke\Types\GenericHolder;
use PeekAndPoke\Types\LocalDate;
use PHPUnit\Framework\TestCase;

/**
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class ToLocalDateTest extends TestCase
{
    public function testSubject()
    {
        $subject  = new ToLocalDate(new \DateTimeZone('Europe/Berlin'));
        $expected = new LocalDate('2016-01-01', 'Europe/Berlin');

        /** @noinspection ImplicitMagicMethodCallInspection */
        $this->assertEquals($expected->getTimestamp(), $subject->__invoke('2016-01-01')->getTimestamp());
        /** @noinspection ImplicitMagicMethodCallInspection */
        $this->assertEquals($expected->getTimezone(), $subject->__invoke('2016-01-01')->getTimezone());


        // deprecated
        /** @noinspection PhpDeprecationInspection */
        $subject  = new String2LocalDate(new \DateTimeZone('Europe/Berlin'));
        $expected = new LocalDate('2016-01-01', 'Europe/Berlin');

        /** @noinspection ImplicitMagicMethodCallInspection */
        $this->assertEquals($expected->getTimestamp(), $subject->__invoke('2016-01-01')->getTimestamp());
        /** @noinspection ImplicitMagicMethodCallInspection */
        $this->assertEquals($expected->getTimezone(), $subject->__invoke('2016-01-01')->getTimezone());
    }

    public function testSubjectWithValueHolder()
    {
        $holder   = new GenericHolder(new \DateTimeZone('Europe/Berlin'));
        $subject  = new ToLocalDate($holder);
        $expected = new LocalDate('2016-01-01', 'Europe/Berlin');

        /** @noinspection ImplicitMagicMethodCallInspection */
        $this->assertEquals($expected->getTimestamp(), $subject->__invoke('2016-01-01')->getTimestamp());
        /** @noinspection ImplicitMagicMethodCallInspection */
        $this->assertEquals($expected->getTimezone(), $subject->__invoke('2016-01-01')->getTimezone());
    }
}
