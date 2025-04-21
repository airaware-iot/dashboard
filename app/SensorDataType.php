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

	public function getIcon(): string
	{
		return match($this) {
			self::TEMPERATURE 	=> 'ico-temperature.svg',
			self::PRESSURE 		=> 'ico-pressure.svg',
			self::HUMIDITY 		=> 'ico-humidity.svg',
			self::LIGHTLEVEL 	=> 'ico-lightlevel.svg',
		};
	}

	public static function getValuesArray(): array
	{
		return array_column(self::cases(), 'value');
	}
}
