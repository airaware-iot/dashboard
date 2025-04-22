<?php

namespace App;

//event-count x
//temperature x
//illuminance x
//relative-humidity x
//pressure x
//altitude x

enum  SensorDataType: string
{
	case EVENT_COUNT = 'event-count';
    case TEMPERATURE = 'temperature';
	case HUMIDITY = 'relative-humidity';
	case LIGHTLEVEL = 'illuminance';
	case PRESSURE = 'pressure';
	case ALTITUDE = 'altitude';

	public function getUnit(): string
	{
		return match($this) {
			self::TEMPERATURE 	=> '˚C',
			self::PRESSURE 		=> 'HPa',
			self::HUMIDITY 		=> '%',
			self::LIGHTLEVEL 	=> 'lm',
			self::EVENT_COUNT 	=> 'x',
			self::ALTITUDE 		=> 'm',
		};
	}

	public function getLabel(): string
	{
		return match($this) {
			self::TEMPERATURE 	=> 'Teplota',
			self::PRESSURE 		=> 'Tlak',
			self::HUMIDITY 		=> 'Vlhkost',
			self::LIGHTLEVEL 	=> 'Množství světla',
			self::EVENT_COUNT 	=> 'Počet kliknutí',
			self::ALTITUDE 		=> 'Nadmořská výška',
		};
	}

	public function getIcon(): string
	{
		// TODO: finish icons
		return match($this) {
			self::TEMPERATURE 	=> 'ico-temperature.svg',
			self::PRESSURE 		=> 'ico-pressure.svg',
			self::HUMIDITY 		=> 'ico-humidity.svg',
			self::LIGHTLEVEL 	=> 'ico-lightlevel.svg',
			self::EVENT_COUNT 	=> 'ico-button.svg',
			self::ALTITUDE 		=> 'ico-altitude.svg',
		};
	}

	public static function getValuesArray(): array
	{
		return array_column(self::cases(), 'value');
	}
}
