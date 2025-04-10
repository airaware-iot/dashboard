<?php

namespace App;

enum AggregationOptions: string
{
	case MINUTES = 'minutes';
    case HOURS = 'hours';
	case DAYS = 'days';

	public function getInterval(): int
	{
		return match($this) {
			self::MINUTES 	=> 60,
			self::HOURS 	=> 3_600,
			self::DAYS 		=> 86_400,
		};
	}
}
