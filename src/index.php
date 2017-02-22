<?php

// This file was just created to test the functions on my localhost

use Calendar\Calendar;
require '../vendor/autoload.php';

$calendar = new Calendar(new DateTime("2016-01-10"));
$calendar->getCalendar();
