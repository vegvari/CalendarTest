<?php

namespace Calendar;

use Calendar\CalendarInterface;
use DateTimeInterface;
include 'CalendarInterface.php';

/**
 * Description of Calendar
 *
 * @author myriampuchalt
 * @date   21.02.2017
 */
class Calendar implements CalendarInterface {

    var $today;

    /**
     * @param DateTimeInterface $datetime
     */
    public function __construct(DateTimeInterface $datetime) {
        $this->today = $datetime;
    }

    /**
     * Get the day
     * @return int
     */
    public function getDay() {
        return (int) $this->today->format('d');
    }

    /**
     * Get the weekday (1-7, 1 = Monday)
     * @return int
     */
    public function getWeekDay() {
        //** We check if it is sunday (0), and if so, return 7
        return (int) ($this->today->format('w') == 0 ? 7 : $this->today->format('w'));
    }

    /**
     * Get the first weekday of this month (1-7, 1 = Monday)
     * @return int
     */
    public function getFirstWeekDay() {
        $newdate = clone $this->today;
        $firstdayofmonth = $newdate->modify('first day of this month');
        //** We check if it is sunday (0), and if so, return 7
        return (int) ($firstdayofmonth->format('w') == 0 ? 7 : $firstdayofmonth->format('w'));
    }

    /**
     * Get the first week of this month (18th March => 9 because March starts on week 9)
     * @return int
     */
    public function getFirstWeek() {
        $newdate = clone $this->today;
        return (int) $newdate->modify('first day of this month')->format('W');
    }

    /**
     * Get the number of days in this month
     * @return int
     */
    public function getNumberOfDaysInThisMonth() {
        return (int) $this->today->format('t');
    }

    /**
     * Get the number of days in the previous month
     * @return int
     */
    public function getNumberOfDaysInPreviousMonth() {
        $newdate = clone $this->today;
        //** If the current month has 31 days, we make it have 30, as the previous one won't have 31
        if ($newdate->format('d') == 31) $newdate->modify('-1 day');
        $lastmonth = $newdate->modify('-1 month');
        return (int) $lastmonth->format('t');
    }

    /**
     * Get the calendar array
     * @return array
     */
    public function getCalendar() {

        $month = $this->today->format('m');
        $year = (int)$this->today->format('Y');
        $weekofcalendar = $this->getFirstWeek();
        
        //** If it's January but still the last week of the year,
        //  we use the previous year to get the first day of that week
        
        if (($weekofcalendar == 53) && ($month == 1)) $year--;   
        
        $firstdayofweek = new \DateTime();
        $firstdayofweek->setISODate($year, $weekofcalendar);
        
        $calendar = array();
        
        //** Fill calendar with dates until the first day of the week belongs to the following month
        //** The echos were just for me to test the output on my localhost ** //

        do {           
            //echo $weekofcalendar . " => ["; 
            $calendar[$weekofcalendar] = $this->getweekdays($firstdayofweek);
                    
            //echo "], </br>";
            $weekofcalendar = (int)($firstdayofweek->format('W'));
            
        } while ($firstdayofweek->format('m') == $month);

        return $calendar;
    }
    
    /**
     * Get the weekdays array, given the first day of the week
     * @return array
     */
    public function getweekdays(&$firstdayofweek) {

        $currentweek = $this->today->format('W');
        $firstdow = clone $firstdayofweek;
        $firstdow->modify('+7 days');
        
        $weekdays = array();

        for ($i = 0; $i < 7; $i++) {
            $weekdays[(int) $firstdayofweek->format('d')] = ($currentweek == $firstdow->format('W'));
            //echo (int) $firstdayofweek->format('d') . " => " . (($currentweek == $firstdow->format('W')) ? "true, " : "false, ");
            $firstdayofweek->modify('+1 day');
        }
        
        return $weekdays;
    }

}
