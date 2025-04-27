<?php

namespace App\Services;

class GreetingService
{
	public static function getGreeting(): string
	{
		// Note: set timezone in config/app.php
		$hour = now()->hour;

		if ($hour >= 5 && $hour < 12) 		return 'Dobré ráno';
		elseif ($hour >= 12 && $hour < 18) 	return 'Dobré odpoledne';
		else 								return 'Dobrý večer';
	}

}