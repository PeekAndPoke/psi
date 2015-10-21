<?php
/**
 * File was created 11.03.2015 14:51
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
namespace PeekAndPoke\Horizons\DateAndTime;

/**
 * Date
 *
 * @author Karsten J. Gerber <kontakt@karsten-gerber.de>
 */
class LocalDate
{
    /** @var \DateTime */
    private $date;
    /** @var \DateTimeZone */
    private $timezone;

    /**
     * @param int                  $timestamp The unix timestamp
     * @param \DateTimeZone|string $timezone  The timezone or a string the DateTimeZone c'tor can understand
     *
     * @return LocalDate
     */
    public static function fromTimestamp($timestamp, $timezone)
    {
        return new LocalDate($timestamp, $timezone);
    }

    /**
     * @return LocalDate
     */
    public static function now()
    {
        return self::raw(new \DateTime());
    }

    /**
     * When you need the same "now" multiple times
     *
     * @return LocalDate
     */
    public static function stickyNow()
    {
        static $v;
        return $v ?: $v = self::raw(new \DateTime());
    }

    /**
     * @param \DateTime $dateTime
     * @return LocalDate
     */
    public static function raw(\DateTime $dateTime)
    {
        $tz = $dateTime->getTimezone();

        // normalize input coming from Javascript or Java etc...
        if ($tz->getName() == 'Z') {
            $tz = new \DateTimeZone('Etc/UTC');
        }

        return new LocalDate($dateTime, $tz);
    }

    /**
     * @param \DateTime|string|float $input    The date or a string the DateTime c'tor can understand or a timestamp
     * @param \DateTimeZone|string   $timezone The timezone or a string the DateTimeZone c'tor can understand
     */
    public function __construct($input, $timezone)
    {
        if (! $timezone instanceof \DateTimeZone) {
            $timezone = new \DateTimeZone((string) $timezone);
        }

        /////
        // We have to trick PHP a bit here, but why?
        //
        // Apparently things behave different, when setting a timezone like
        // a) 'Europe/Berlin'
        // b) '+02:00'
        //
        // When the date already has a timezone set then
        // a) will only set the timezone
        // b) will set the timezone and will also change the timestamp by 2 hours
        //
        // Therefore we create a fresh date, that does not have a timezone yet, set the timestamp, and then apply the
        // timezone
        //
        // See the unit tests for more as well
        ////

        if ($input instanceof \DateTime) {
            $date = (new \DateTime())->setTimestamp($input->getTimestamp());
        } elseif (is_numeric($input)) {
            $date = (new \DateTime())->setTimestamp($input);
        } else {
            $date = new \DateTime($input);
        }

        // now we have a fresh date and we can set the timezone
        $date->setTimezone($timezone);

        $this->date     = $date;
        $this->timezone = $timezone;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->format();
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return clone $this->date;
    }

    /**
     * @return int
     */
    public function getTimestamp()
    {
        return $this->date->getTimestamp();
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->date->getOffset();
    }

    /**
     * @return \DateTimeZone
     */
    public function getTimezone()
    {
        return clone $this->timezone;
    }

    /**
     * @return float
     */
    public function getTimezoneOffsetInHours()
    {
        $offset = $this->getTimezone()->getOffset($this->getDate());

        return $offset / (60 * 60);
    }

    /**
     * @param string $format
     *
     * @return string
     */
    public function format($format = 'c')
    {
        return $this->date->format($format);
    }

    /**
     * @return LocalDate
     */
    public function getClone()
    {
        return new LocalDate($this->date, $this->timezone);
    }

    /**
     * Get the time saving shift on this date in seconds
     *
     * @return int
     */
    public function getDaylightSavingShift()
    {
        $previousNoon = $this->getStartOfPreviousDay()->modifyByHours(12);

        return  $this->getOffset() - $previousNoon->getOffset();
    }

    /**
     * @return LocalDate
     */
    public function getStartOfDay()
    {
        return $this->modifyTime(0, 0, 0);
    }

    /**
     * Get the nearest start of a day, either the current or the next day depending on the time in the day
     *
     * @return LocalDate
     */
    public function getNearestStartOfDay()
    {
        if ($this->getHours() < 12) {
            return $this->getStartOfDay();
        }

        return $this->getStartOfNextDay();
    }

    /**
     * @return LocalDate
     */
    public function getStartOfPreviousDay()
    {
        $dateCloned = clone $this->getDate();

        // take switches between summer and winter time into account
        if ($dateCloned->format('H') > 21) {
            $dateCloned->modify('-27 hours');
        } else {
            $dateCloned->modify('-24 hours');
        }

        $temp = new LocalDate($dateCloned, $this->timezone);

        return $temp->getStartOfDay();
    }

    /**
     * @return LocalDate
     */
    public function getStartOfNextDay()
    {
        $dateCloned = clone $this->getDate();

        // take switches between summer and winter time into account
        if ($dateCloned->format('H') < 3) {
            $dateCloned->modify('+27 hours');
        } else {
            $dateCloned->modify('+24 hours');
        }

        $temp = new LocalDate($dateCloned, $this->timezone);

        return $temp->getStartOfDay();
    }

    /**
     * @return LocalDate
     */
    public function getEndOfDay()
    {
        return $this->getStartOfDay()->modifyByDays(1);
    }

    /**
     * @param int   $hour
     * @param int   $minute
     * @param int   $second
     *
     * @return LocalDate
     */
    public function modifyTime($hour, $minute, $second)
    {
        $hour   = (int) $hour;
        $minute = (int) $minute;
        $second = (int) $second;

        $clonedDate = clone $this->date;

        $clonedDate->setTime((int) $hour, (int) $minute, (int) $second);

        return new LocalDate($clonedDate, $this->timezone);
    }

    /**
     * @param int $numSeconds
     *
     * @return LocalDate
     */
    public function modifyBySeconds($numSeconds)
    {
        $numSeconds = (int) $numSeconds;

        $dateCloned = clone $this->date;
        $dateCloned->modify("$numSeconds seconds");

        return new LocalDate($dateCloned, $this->timezone);
    }

    /**
     * @param int $numMinutes
     *
     * @return LocalDate
     */
    public function modifyByMinutes($numMinutes)
    {
        $numMinutes = (int) $numMinutes;

        $dateCloned = clone $this->date;
        $dateCloned->modify("$numMinutes minutes");

        return new LocalDate($dateCloned, $this->timezone);
    }

    /**
     * @param int $numHours
     *
     * @return LocalDate
     */
    public function modifyByHours($numHours)
    {
        $numHours = (int) $numHours;

        $dateCloned = clone $this->date;
        $dateCloned->modify("$numHours hours");

        return new LocalDate($dateCloned, $this->timezone);
    }

    /**
     * @param int $numDays
     *
     * @return LocalDate
     */
    public function modifyByDays($numDays)
    {
        $numDays = (int) $numDays;

        $dateCloned = clone $this->date;
        $dateCloned->modify("$numDays days");

        return new LocalDate($dateCloned, $this->timezone);
    }

    /**
     * @param \DateInterval|string $interval
     *
     * @return LocalDate
     */
    public function modifyByInterval($interval)
    {
        if (!$interval instanceof \DateInterval) {
            $interval = new \DateInterval($interval);
        }

        $dateCloned = clone $this->date;
        $dateCloned->add($interval);

        return new LocalDate($dateCloned, $this->timezone);
    }

    /**
     * @param $minutesInterval
     *
     * @return LocalDate
     */
    public function alignToMinutesInterval($minutesInterval)
    {
        // This is a work-around for the day-light-saving shift days
        // If we would use minutesIntoDay and then add those to startOfDay, we loose one hour.
        // Example would be '2015-03-29 11:20' with tz 'Europe/Berlin' would result in '2015-03-29 10:00'
        $minutesIntoDay = ((int)$this->date->format('H') * 60) + ((int)$this->date->format('i'));
        // cut off partial intervals
        $corrected = ((int)($minutesIntoDay / $minutesInterval)) * $minutesInterval;

        return $this->getStartOfDay()->modifyByMinutes($corrected);
    }

    /**
     * @return int
     */
    public function getMinutesIntoDay()
    {
        $day  = $this->getStartOfDay();
        $diff = $this->getTimestamp() - $day->getTimestamp();

        return (int) ($diff / 60);
    }

    /**
     * Get the hours portion of the current time
     *
     * @return int
     */
    public function getHours()
    {
        return (int) $this->format('H');
    }

    /**
     * @return int
     */
    public function getWeekday()
    {
        return (int) $this->format('N');
    }

    ////  COMPARISON METHODS  //////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Returns the data that is earlier, either the current or the other
     *
     * @param LocalDate|\DateTime $other
     *
     * @return LocalDate
     */
    public function min($other)
    {
        $other = $this->ensure($other);

        return $this->isBefore($other) ? $this : $other;
    }

    /**
     * Returns the data that is later, either the current or the other
     *
     * @param LocalDate|\DateTime $other
     *
     * @return LocalDate
     */
    public function max($other)
    {
        $other = $this->ensure($other);

        return $this->isAfter($other) ? $this : $other;
    }

    /**
     * @param LocalDate|\DateTime $other
     *
     * @return float Absolute number of minutes this and the other
     */
    public function diffInMinutes($other)
    {
        $other = $this->ensure($other);

        return abs(($this->getTimestamp() - $other->getTimestamp()) / (60));
    }


    /**
     * @param LocalDate|\DateTime $other
     *
     * @return bool
     */
    public function isBefore($other)
    {
        $other = $this->ensure($other);

        return $this->date < $other->date;
    }

    /**
     * @param LocalDate|\DateTime $other
     *
     * @return bool
     */
    public function isBeforeOrEqual($other)
    {
        $other = $this->ensure($other);

        return $this->date <= $other->date;
    }

    /**
     * @param LocalDate|\DateTime $other
     *
     * @return bool
     */
    public function isEqual($other)
    {
        $other = $this->ensure($other);

        return $this->date == $other->date;
    }

    /**
     * @param LocalDate|\DateTime $other
     *
     * @return bool
     */
    public function isAfter($other)
    {
        $other = $this->ensure($other);

        return $this->date > $other->date;
    }

    /**
     * @param LocalDate|\DateTime $other
     *
     * @return bool
     */
    public function isAfterOrEqual($other)
    {
        $other = $this->ensure($other);

        return $this->date >= $other->date;
    }

    ////  PRIVATE HELPER  //////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @param mixed $input
     *
     * @return LocalDate
     */
    private function ensure($input)
    {
        if ($input instanceof LocalDate) {
            return $input;
        }

        if ($input instanceof \DateTime) {
            return new LocalDate($input, $this->timezone);
        }

        return new LocalDate($input, $this->timezone);
    }
}
