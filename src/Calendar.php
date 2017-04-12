<?php

namespace Calendar;

use DateTimeInterface;

class Calendar implements CalendarInterface
{

    private $date;

    /**
     * @param DateTimeInterface $datetime
     */
    public function __construct(DateTimeInterface $datetime)
    {
        $this->date = $datetime;
    }

    /**
     * Get the day
     *
     * @return int
     */
    public function getDay()
    {
        return (int)$this->date->format('d');
    }

    /**
     * Get the weekday (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getWeekDay()
    {
        return (int)$this->date->format('N');
    }

    /**
     * Get the first weekday of this month (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getFirstWeekDay()
    {
        $newDate = new \DateTime($this->date->format('Y-m-1'));

        return (int)$newDate->format('N');
    }

    /**
     * Get the first week of this month (18th March => 9 because March starts on week 9)
     *
     * @return int
     */
    public function getFirstWeek()
    {
        $newDate = new \DateTime($this->date->format('Y-m-1'));

        return (int)$newDate->format('W');
    }

    /**
     * Get the number of days in this month
     *
     * @return int
     */
    public function getNumberOfDaysInThisMonth()
    {
        $newDate = new \DateTime($this->date->format('Y-m-d'));

        return (int)$newDate->format('t');
    }

    /**
     * Get the number of days in the previous month
     *
     * @return int
     */
    public function getNumberOfDaysInPreviousMonth()
    {
        //any day < 28
        $newDate = new \DateTime($this->date->format('Y-m-1'));

        return (int)$newDate->modify('-1 month')->format('t');
    }

    /**
     * Get the calendar array
     *
     * @return array
     */
    public function getCalendar()
    {
        $weeks = [];
        $weekStartNum = $this->getFirstWeek();

        //Get valid year when week number falls in previous or next year
        $weekDate = new \DateTime();
        $weekStart = new \DateTime($this->date->format('Y-m-1'));
        $weekDate->setISODate((int)$weekStart->format('o'), $weekStartNum);

        for($i = 1, $weekTotal = $this->getNumWeeksCurrentMonth(); $i <= $weekTotal; $i++) {
            //Write calendar
            $weeks[$weekStartNum] = $this->getDaysInWeek($weekStartNum, $weekDate);

            //Set valid week number
            $weekStartNum = $weekStartNum + 1 > 53 ? 1 : $weekStartNum + 1;
            $weekDate->modify('+1 week');
        }

        return $weeks;
    }

    /**
     * Returns array of days for given week. Set values to true if the current day is in the given week
     *
     * @param $weekNum
     * @param $weekDate
     * @return array
     */
    private function getDaysInWeek($weekNum, $weekDate) {
        $currentWeek = (int)$this->date->format('W');
        $interval = new \DateInterval('P1D');
        $period = new \DatePeriod($weekDate, $interval, 6);

        $days = [];
        $validWeek = $currentWeek - 1 <= 0 ? 53 : $currentWeek - 1;
        $highLight = ($validWeek === $weekNum);

        foreach($period as $day) {
            $days[$day->format('j')] = $highLight;
        }

        return $days;
    }

    /**
     * Returns the number of weeks for the current month
     * Takes in consideration leap years
     *
     * @return int
     */
    private function getNumWeeksCurrentMonth(): int {
        $firstWeek = $this->getFirstWeek();
        $lastWeek = $this->getLastWeek();
        $currentYear = (int)$this->date->format('Y');
        $weeksYear = ($currentYear % 4 === 0) ? 53 : 52;

        if($firstWeek > $lastWeek) {
            return (($weeksYear + $lastWeek) - $firstWeek) + 1;
        }

        return ($lastWeek - $firstWeek) + 1;
    }

    /**
     * Gets the number of the last week of the current month
     *
     * @return string
     */
    private function getLastWeek() {
        $tempDate = new \DateTime($this->date->format('Y-m-t'));

        return $tempDate->format('W');
    }

}