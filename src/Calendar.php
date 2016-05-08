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
		}

		/**
		 * Get the day
		 *
		 * @return int
		 */
		public function getDay()
		{
			// $today = Carbon::now()->format('l');
			$today = Carbon::today()->format('l');
			return $today;
		}

		/**
		 * Get the weekday (1-7, 1 = Monday)
		 *
		 * @return int
		 */
		public function getWeekDay()
		{
			$day_num = Carbon::today()->format('N');
			return $day_num;
		}

		/**
		 * Get the first weekday of this month (1-7, 1 = Monday)
		 *
		 * @return int
		 */
		public function getFirstWeekDay()
		{

		}

		/**
		 * Get the first week of this month (18th March => 9 because March starts on week 9)
		 *
		 * @return int
		 */
		public function getFirstWeek()
		{
			$today = Carbon::today();
			return $today->weekOfMonth;
		}

		/**
		 * Get the number of days in this month
		 *
		 * @return int
		 */
		public function getNumberOfDaysInThisMonth()
		{

		}

		/**
		 * Get the number of days in the previous month
		 *
		 * @return int
		 */
		public function getNumberOfDaysInPreviousMonth()
		{

		}

		/**
		 * Get the calendar array
		 *
		 * @return array
		 */
		public function getCalendar()
		{

		}
	}