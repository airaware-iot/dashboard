<?php

namespace App;

use App\Models\Data;

enum TimeIntervals: string
{
	case LAST_SIX_HOURS = 'Last 6 Hours';
	case LAST_TWELVE_HOURS = 'Last 12 Hours';
	case LAST_TWENTY_FOUR_HOURS = 'Last 24 Hours';
	case LAST_FORTY_EIGHT_HOURS = 'Last 48 Hours';
	case LAST_SEVENTY_TWO_HOURS = 'Last 72 Hours';
	case LAST_THREE_DAYS = 'Last 3 Days';
	case LAST_WEEK = 'Last Week';
	case LAST_TWO_WEEKS = 'Last 2 Weeks';
	case LAST_MONTH = 'Last Month';
	case LAST_QUARTER = 'Last Quarter';
	case LAST_SEMESTER = 'Last Semester';
	case LAST_YEAR = 'Last Year';

	public function getData(SensorDataTypes $dataType): array
	{
		return match($this) {
			self::LAST_SIX_HOURS 			=> Data::getLastSixHours($dataType),
			self::LAST_TWELVE_HOURS 		=> Data::getLastTwelveHours($dataType),
			self::LAST_TWENTY_FOUR_HOURS 	=> Data::getLastTwentyFourHours($dataType),
			self::LAST_FORTY_EIGHT_HOURS 	=> Data::getLastFortyEightHours($dataType),
			self::LAST_SEVENTY_TWO_HOURS 	=> Data::getLastSeventyTwoHours($dataType),
			self::LAST_THREE_DAYS 			=> Data::getLastThreeDays($dataType),
			self::LAST_WEEK 				=> Data::getLastWeek($dataType),
			self::LAST_TWO_WEEKS 			=> Data::getLastTwoWeeks($dataType),
			self::LAST_MONTH 				=> Data::getLastMonth($dataType),
			self::LAST_QUARTER 				=> Data::getLastQuarter($dataType),
			self::LAST_SEMESTER 			=> Data::getLastSemester($dataType),
			self::LAST_YEAR 				=> Data::getLastYear($dataType),
		};
	}
	//	public static function ()
//	{
//		return match($this)
//	}
}
