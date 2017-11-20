<?php

namespace Calendar;

use DateTimeInterface;

class Calendar implements CalendarInterface
{
    /**
     * @var DateTimeInterface
     */
    private $inputDate;

    /**
     * @param DateTimeInterface $datetime
     */
    public function __construct(DateTimeInterface $datetime)
    {
        $this->inputDate = $datetime;
    }

    /**
     * Get the day
     *
     * @return int
     */
    public function getDay()
    {
        return (int) $this->inputDate->format('d');
    }

    /**
     * Get the weekday (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getWeekDay()
    {
        return (int) $this->inputDate->format('N');
    }

    /**
     * Get the first weekday of this month (1-7, 1 = Monday)
     *
     * @return int
     */
    public function getFirstWeekDay()
    {
        $firstDayOfWeek = new \DateTime($this->inputDate->format('Y-m-01'));

        return (int) $firstDayOfWeek->format('N');
    }

    /**
     * Get the first week of this month (18th March => 9 because March starts on week 9)
     *
     * @return int
     */
    public function getFirstWeek()
    {
        $firstWeekOfMonth = new \DateTime($this->inputDate->format('Y-m-01'));

        return (int) $firstWeekOfMonth->format('W');
    }

    /**
     * Get the first week of this month (18th March => 9 because March starts on week 9)
     *
     * @return int
     */
    private function getLastWeek()
    {
        $lastWeekOfMonth = new \DateTime($this->inputDate->format('Y-m-d'));
        $lastWeekOfMonth->modify('last day of this month');

        return (int) $lastWeekOfMonth->format('W');
    }

    /**
     * Get the number of days in this month
     *
     * @return int
     */
    public function getNumberOfDaysInThisMonth()
    {
        $lastDayOfMonth = new \DateTime($this->inputDate->format('Y-m-d'));
        $lastDayOfMonth->modify('last day of this month');

        return (int) $lastDayOfMonth->format('d');
    }

    /**
     * Get the number of days in the previous month
     *
     * @return int
     */
    public function getNumberOfDaysInPreviousMonth()
    {
        $lastDayOfPreviousMonth = new \DateTime($this->inputDate->format('Y-m-d'));
        $lastDayOfPreviousMonth->modify('last day of previous month');

        return (int) $lastDayOfPreviousMonth->format('d');
    }

    /**
     * Get the calendar array
     *
     * @return array
     */
    public function getCalendar()
    {
       $calendar = array();
       $week = $this->getFirstWeek();

       for($i = 0; $i < 6; $i++) {
           $highlighted = $this->isHighlighted($week);
           $calendar[$week] = $this->getWeek($highlighted, $week);
           $week = $this->incrementWeek($week);

           if($this->incrementWeek($this->getLastWeek()) == $week) {
               break;
           }
      }

        return $calendar;
    }

    /**
     * @param $highlighted
     * @param $week
     * @return array
     */
    private function getWeek($highlighted, $week)
    {
        $day = new \DateTime();
        $year = (int) $this->inputDate->format('Y');

        if($week == 53 && $this->inputDate->format('m') == 1) {
            $year--;
            $day->setISODate($year, $week);
        } else {
            $day->setISODate($year, $week);
        }

        for($d = 0; $d < 7; $d++) {
            $weekArray[$day->format('j')] = $highlighted;
            $day->modify('+1 day');
        }

        return $weekArray;
    }

    /**

    /**
     * @param $day
     * @return bool
     */
    private function isHighlighted($week)
    {
        if($week == 53) {
            return $this->getInputDateWeek() == 1;
        }

        return $this->getInputDateWeek() - 1 == $week;
    }

    /**
     * @param $week
     * @return int
     */
    private function incrementWeek($week)
    {
        if($week == 53){
            return 1;
        }

        return $week + 1;
    }

    /**
     * @return int
     */
    private function getInputDateWeek()
    {
        return (int) $this->inputDate->format('W');
    }
}
