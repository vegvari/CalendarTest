<?php
	require 'vendor/autoload.php';
	use Calendar\Calendar;

	$calendar = new Calendar();
?>
<ul>
	<li>Get the day: <strong><?php echo $calendar->getDay(); ?></strong></li>
	<li>Get the weekday (1-7, 1 = Monday): <strong><?php echo $calendar->getWeekDay(); ?></strong></li>
	<li>Get the first weekday of this month (1-7, 1 = Monday): <strong><?php echo $calendar->getFirstWeekDay(); ?></strong></li>
	<li>Get the first week of this month (18th March => 9 because March starts on week 9): <strong><?php echo $calendar->getFirstWeek(); ?></strong></li>
	<li>Get the number of days in this month: <strong><?php echo $calendar->getNumberOfDaysInThisMonth(); ?></strong></li>
	<li>Get the number of days in the previous month: <strong><?php echo $calendar->getNumberOfDaysInPreviousMonth(); ?></strong></li>
	<li>Get the calendar array: <strong><?php echo $calendar->getCalendar(); ?></strong></li>
</ul>

