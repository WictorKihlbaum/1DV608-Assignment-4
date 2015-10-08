<?php

class DateTimeView {

	public function showDateTime() {
		// Set correct timezone.
		date_default_timezone_set('Europe/Stockholm');
		$timeString = date("l") . ", the " . date("jS") . " of " . date("F Y") . ", The time is " . date("H:i:s");

		return '<p>' . $timeString . '</p>';
	}
}