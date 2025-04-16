<?php

namespace App;

enum  SensorDataType: string
{
    case TEMPERATURE = 'temperature';
	case HUMIDITY = 'humidity';
	case LIGHTLEVEL = 'light_level';
	case PRESSURE = 'pressure';

	public function getUnit(): string
	{
		return match($this) {
			self::TEMPERATURE 	=> '˚C',
			self::PRESSURE 		=> 'HPa',
			self::HUMIDITY 		=> '%',
			self::LIGHTLEVEL 	=> 'lm',
		};
	}

	public function getLabel(): string
	{
		return match($this) {
			self::TEMPERATURE 	=> 'Teplota',
			self::PRESSURE 		=> 'Tlak',
			self::HUMIDITY 		=> 'Vlhkost',
			self::LIGHTLEVEL 	=> 'Množství světla',
		};
	}

	public static function getValuesArray(): array
	{
		return array_column(self::cases(), 'value');
	}
}
