<?php namespace Calendar;

use Calendar\CalendarInterface;
use Carbon\Carbon;

class Calendar
{
	/**
	 * @param DateTimeInterface $datetime
	 */
	public function __construct()
	{
		$this->today = Carbon::today();
	}

	/**
	 * Get the day
	 *
	 * @return int
	 */
	public function getDay()
	{
		return $this->today->format('l');
	}

	/**
	 * Get the weekday (1-7, 1 = Monday)
	 *
	 * @return int
	 */
	public function getWeekDay()
	{
		return $this->today->format('N');
	}

	/**
	 * Get the first weekday of this month (1-7, 1 = Monday)
	 *
	 * @return int
	 */
	public function getFirstWeekDay()
	{
		return $this->today->firstOfMonth()->format('N');
	}

	/**
	 * Get the first week of this month (18th March => 9 because March starts on week 9)
	 *
	 * @return int
	 */
	public function getFirstWeek()
	{
		return $this->today->firstOfMonth()->weekOfYear;
	}

	/**
	 * Get the number of days in this month
	 *
	 * @return int
	 */
	public function getNumberOfDaysInThisMonth()
	{
		return $this->today->daysInMonth;
	}

	/**
	 * Get the number of days in the previous month
	 *
	 * @return int
	 */
	public function getNumberOfDaysInPreviousMonth()
	{
		return $this->today->subMonth()->daysInMonth;
	}

	/**
	 * Get the calendar array
	 *
	 * @return array
	 */
	public function getCalendar()
	{
		// I'm suppose this is useful for calling on where I'm not using a pre-written function - in which I have
		// already taken necessary formatting into account
		return $this->today;
	}


	public function getCalendarArray()
	{
		// I'm not sure if this is useful as the Carbon library is loaded when this class is instantiated, and I'm
		// performing my operations on those.  But here's an array with a years worth of values anyway.
		$i=1;
		$current_date = $this->today->startOfYear()->format('d/m/Y');
		$calendar[] = $current_date;
		while ($i <= 365)
		{
			$calendar[] =   $this->today->addDay()->format('d/m/Y');
			$i++;
		}
		return $calendar;
	}
}