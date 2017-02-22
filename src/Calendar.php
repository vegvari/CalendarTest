<?php

namespace Calendar;

use DateTime;
use DateTimeInterface;

/**
 * @package Calendar
 * @see CalendarInterface for more excessive phpDoc documentation on getters
 */
class Calendar implements CalendarInterface
{

    /** @var DateTime */
    protected $datetime;

    /**
     * @param DateTimeInterface $datetime
     */
    public function __construct(DateTimeInterface $datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @return int
     */
    public function getDay()
    {
        return (int)$this->datetime->format('j');
    }

    /**
     * @return int
     */
    public function getWeekDay()
    {
        return (int)$this->datetime->format('N');
    }

    /**
     * @return int
     */
    public function getFirstWeekDay()
    {
        return (int)(new DateTime($this->datetime->format('Y-m-01')))->format('N');
    }

    /**
     * @return int
     */
    public function getFirstWeek()
    {
        return (int)(new DateTime($this->datetime->format('Y-m-01')))->format('W');
    }

    /**
     * @return int
     */
    public function getNumberOfDaysInThisMonth()
    {
        return (int)$this->datetime->format('t');
    }

    /**
     * @return int
     */
    public function getNumberOfDaysInPreviousMonth()
    {
        return (int)(new DateTime($this->datetime->format('Y-m-d')))->modify('last day of previous month')->format('j');
    }

    /**
     * @return array
     */
    public function getCalendar()
    {
        $current_day = new DateTime($this->datetime->format('Y-m-01'));

        // if the first week beings in the previous month
        if ($this->getFirstWeekDay() !== 1) {
            $current_day->modify('-' . ($this->getFirstWeekDay() - 1) . ' day');
        }

        $result = [];
        for ($week_count = 0; $week_count < 6; $week_count++) {
            $week_number = (int)$current_day->format('W');
            $selected_week = (new DateTime($this->datetime->format('Y-m-d')))->modify('Monday this week');
            $is_highlighted = $current_day < $selected_week && $current_day->diff($selected_week)->format('%a') == 7;
            $is_hidden = $current_day->format('m') !== $this->datetime->format('m');

            // iterate through each week individually
            $this_week = [];
            for ($d = 1; $d <= 7; $d++) {
                $this_week[(new Calendar($current_day))->getDay()] = $is_highlighted;
                $current_day->modify('+1 day');
            }

            // usually all 6 weeks are being drawn, however in this case we need to check if the first or last week
            // overlays with the selected month, if not, then we won't display them at all
            if ($is_hidden && $current_day->format('m') !== $this->datetime->format('m')) {
                continue;
            }

            $result[$week_number] = $this_week;
        }

        return $result;
    }
}
