<?php

namespace App;

enum SensorDataTypes: string
{
    case TEMPERATURE = 'temperature';
	case HUMIDITY = 'humidity';
	case LIGHTLEVEL = 'light_level';
	case PRESSURE = 'pressure';

	public function getDataType(): string
	{
		return match($this) {
			self::TEMPERATURE,
			self::PRESSURE
			=> 'float',

			self::HUMIDITY,
			self::LIGHTLEVEL
			=> 'percentage'
		};
	}

	public static function getValueArray(): array
	{
		return array_column(self::cases(), 'value');
	}
}
