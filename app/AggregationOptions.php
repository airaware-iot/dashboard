<?php

namespace App;

enum AggregationOptions: string
{
    case HOURLY = 'hourly';
	case DAILY = 'daily';

	public function getInterval(): int
	{
		return match($this) {
			self::HOURLY 	=> 3_600,
			self::DAILY 	=> 86_400,
		};
	}
}
