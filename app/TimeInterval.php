<?php

namespace App;

use App\Models\Data;

enum TimeInterval: string
{
	case LAST_SIX_HOURS = 'Posledních 6 hodin';
	case LAST_TWELVE_HOURS = 'Posledních 12 hodin';
	case LAST_TWENTY_FOUR_HOURS = 'Posledních 24 hodin';
	case LAST_FORTY_EIGHT_HOURS = 'Posledních 48 hodin';
	case LAST_SEVENTY_TWO_HOURS = 'Posledních 72 hodin';
	case LAST_THREE_DAYS = 'Poslední 3 dny';
	case LAST_WEEK = 'Poslední týden';
	case LAST_TWO_WEEKS = 'Poslední dva týdny';
	case LAST_MONTH = 'Poslední měsíc';
	case LAST_QUARTER = 'Poslední čtvrtletí';
	case LAST_SEMESTER = 'Poslední pololetí';
	case LAST_YEAR = 'Poslední rok';

	public function getData(SensorDataType $dataType): array
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
