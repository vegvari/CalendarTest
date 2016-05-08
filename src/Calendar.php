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
//			echo "hello";
//				Parent::__construct(DateTimeInterface $datetime)
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
//			$first_day = Carbon::today()->subMonth(1)->daysInMonth;
//			return $first_day;
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
			// I'm not sure if this is useful as the Carbon library is loaded when this class is instantiated and I'm
			// performing my operations on those.
			return $this->today;


			
			
		}


		public function getCalendarArray()
		{
			// I'm not sure if this is useful as the Carbon library is loaded when this class is instantiated and I'm
			// performing my operations on those.

//			$calendar = array();
			$i=1;
			$current_date = $this->today->startOfYear()->format('d/m/Y');
			$calendar[] = $current_date;
			while ($i <= 365)
			{
				$calendar[] = 	$this->today->addDay()->format('d/m/Y');

				$i++;
			}

//			var_dump($calendar);

//			$current_date = $this->today->startOfYear();
//			while ($current_date !== $this->today->endOfYear())
//			{
//				$calendar[]= $current_date->format('d/m/Y');
//				$current_date->addDay();
//			}
//
			return $calendar;

		}


	}