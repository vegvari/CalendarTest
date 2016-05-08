<?php
	require 'vendor/autoload.php';
	use Calendar\Calendar;
	//	use Carbon\Carbon;

	$calendar = new Calendar();
?>
<p>Today is: <strong><?php echo $calendar->getDay(); ?></strong>, which is day No. <strong><?php echo $calendar->getWeekDay(); ?></strong>.</p>
<p>The first weekday of this month was day No. <strong><?php echo $calendar->getFirstWeekDay(); ?></strong></p>
<p>The first week of this month was week: <strong><?php echo $calendar->getFirstWeek(); ?></strong></p>
<p>The number of days in this month <strong>(<?php echo $calendar->getCalendar()->format('F'); ?>)</strong> is: <strong><?php echo $calendar->getNumberOfDaysInThisMonth(); ?></strong></p>
<p>Last month was <strong><?php echo $calendar->getCalendar()->subMonth()->format('F'); ?></strong>, which has: <strong><?php echo $calendar->getNumberOfDaysInPreviousMonth(); ?></strong> days</p>
<p>Here is an array of dates for every day of <?php echo $calendar->getCalendar()->format('Y'); ?></p>
<ul>
	<?php
		$calendarArray = $calendar->getCalendarArray();
		foreach ($calendarArray as $date) {
			echo '<li>' . $date . '</li>';
		}
	?>
</ul>

