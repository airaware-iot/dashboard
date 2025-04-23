<?php

namespace App\Overrides;

use DateTime;
use Maantje\Charts\Formatter;

class CustomFormatter extends Formatter
{
	public static function empty(): \Closure
	{
		return fn() => '';
	}
}