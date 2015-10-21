<?php
/**
 * File was created 08.05.2015 15:10
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Horizons\Tests;

use PeekAndPoke\Horizons\DateAndTime\LocalDate;

/**
 * LocalDateTest
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class LocalDateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideTestFromTimestamp
     *
     * @param int    $timestamp
     * @param string $timezoneStr
     * @param string $expected
     */
    public function testFromTimestamp($timestamp, $timezoneStr, $expected)
    {
        $subject = LocalDate::fromTimestamp($timestamp, $timezoneStr);

        $this->assertEquals(
            $timestamp,
            $subject->getTimestamp(),
            'Setting the timezone must NOT change the timestamp'
        );

        $this->assertEquals(
            $expected,
            $subject->format(),
            'The date must be formatted correctly'
        );
    }

    /**
     * @return array
     */
    public static function provideTestFromTimestamp()
    {
        return [
            [282828282, 'Etc/UTC',          '1978-12-18T11:24:42+00:00'],
            [282828282, 'Europe/Berlin',    '1978-12-18T12:24:42+01:00'],
            [282828282, 'America/Chicago',  '1978-12-18T05:24:42-06:00'],
            [282828282, '+02:00',           '1978-12-18T13:24:42+02:00'],
            [282828282, '-02:00',           '1978-12-18T09:24:42-02:00'],
        ];
    }

    /**
     * @dataProvider provideTestRaw
     *
     * @param \DateTime $raw
     * @param string    $expectedTimeZone
     * @param string    $expectedString
     */
    public function testRaw($raw, $expectedTimeZone, $expectedString)
    {
        $localDate = LocalDate::raw($raw);

        $this->assertEquals(
            $expectedString,
            $localDate->format(),
            'A date created from a raw date must be formatted correctly'
        );

        $this->assertEquals(
            $expectedTimeZone,
            $localDate->getTimezone()->getName(),
            'A date created from a raw date must have the correct timezone'
        );
    }

    /**
     * @return array
     */
    public static function provideTestRaw()
    {
        $default = date_default_timezone_get();

        return [
            [new \DateTime('1978-12-18'),                $default,     '1978-12-18T00:00:00+00:00'],
            [new \DateTime('1978-12-18T12:00'),          $default,     '1978-12-18T12:00:00+00:00'],
            [new \DateTime('1978-12-18T12:00:00'),       $default,     '1978-12-18T12:00:00+00:00'],

            [new \DateTime('1978-12-18T12:00:00+01:00'), '+01:00',      '1978-12-18T12:00:00+01:00'],
            [new \DateTime('1978-12-18T12:00:00-01:00'), '-01:00',      '1978-12-18T12:00:00-01:00'],

            [new \DateTime('1978-12-18T12:00:00.000Z'),  'Etc/UTC',     '1978-12-18T12:00:00+00:00'],
            [new \DateTime('1978-12-18T12:00:00.999Z'),  'Etc/UTC',     '1978-12-18T12:00:00+00:00'],
        ];
    }

    /**
     * @dataProvider provideTestFromTimestamp
     *
     * @param int    $timestamp
     * @param string $timezoneStr
     * @param string $expected
     */
    public function testConstructFromTimestamp($timestamp, $timezoneStr, $expected)
    {
        $subject = new LocalDate($timestamp, $timezoneStr);

        $this->assertEquals(
            $timestamp,
            $subject->getTimestamp(),
            'Constructing from timestamp must work'
        );

        $this->assertEquals(
            $expected,
            $subject->format(),
            'A date constructed from timestamp must be formatted correctly'
        );
    }

    /**
     * @dataProvider provideTestConstructor
     *
     * @param mixed  $input
     * @param string $timezoneStr
     * @param string $expected
     */
    public function testConstruct($input, $timezoneStr, $expected)
    {
        $subject = new LocalDate($input, $timezoneStr);

        $this->assertEquals(
            $expected,
            $subject->format(),
            'A date constructed from timestamp must be formatted correctly'
        );
    }

    /**
     * @return array
     */
    public static function provideTestConstructor()
    {
       return [
           [282828282,   'Etc/UTC',          '1978-12-18T11:24:42+00:00'],
           ['282828282', 'Etc/UTC',          '1978-12-18T11:24:42+00:00'],

           [new \DateTime('1978-12-18'),        'Etc/UTC',         '1978-12-18T00:00:00+00:00'],
           [new \DateTime('1978-12-18'),        'Europe/Berlin',   '1978-12-18T01:00:00+01:00'],
           [new \DateTime('1978-12-18'),        'America/Chicago', '1978-12-17T18:00:00-06:00'],

           [new \DateTime('1978-12-18T12:00'),  'Etc/UTC',         '1978-12-18T12:00:00+00:00'],
           [new \DateTime('1978-12-18T12:00'),  'Europe/Berlin',   '1978-12-18T13:00:00+01:00'],
           [new \DateTime('1978-12-18T12:00'),  'America/Chicago', '1978-12-18T06:00:00-06:00'],

           [new \DateTime('1978-12-18T12:00:00'),   'Etc/UTC',         '1978-12-18T12:00:00+00:00'],
           [new \DateTime('1978-12-18T12:00:00'),   'Europe/Berlin',   '1978-12-18T13:00:00+01:00'],
           [new \DateTime('1978-12-18T12:00:00'),   'America/Chicago', '1978-12-18T06:00:00-06:00'],

           [new \DateTime('1978-12-18T12:00:00+01:00'), 'Etc/UTC',         '1978-12-18T11:00:00+00:00'],
           [new \DateTime('1978-12-18T12:00:00+01:00'), 'Europe/Berlin',   '1978-12-18T12:00:00+01:00'],
           [new \DateTime('1978-12-18T12:00:00+01:00'), 'America/Chicago', '1978-12-18T05:00:00-06:00'],

           [new \DateTime('1978-12-18T12:00:00-01:00'), 'Etc/UTC',         '1978-12-18T13:00:00+00:00'],
           [new \DateTime('1978-12-18T12:00:00-01:00'), 'Europe/Berlin',   '1978-12-18T14:00:00+01:00'],
           [new \DateTime('1978-12-18T12:00:00-01:00'), 'America/Chicago', '1978-12-18T07:00:00-06:00'],
       ];
    }

}
