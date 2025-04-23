<?php

namespace App;

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
			self::LIGHTLEVEL 	=> 'lux',
			self::EVENT_COUNT 	=> 'x',
			self::ALTITUDE 		=> 'm',
		};
	}

	public function getSpecs(): array
	{
		return match($this) {
			self::TEMPERATURE 	=> ['type' => SpecificationType::MINMAX, 'min' => 20, 'max' => 28],
			self::PRESSURE 		=> ['type' => SpecificationType::MINMAX, 'min' => 96325, 'max' => 106325],
			self::HUMIDITY 		=> ['type' => SpecificationType::MINMAX, 'min' => 30, 'max' => 65],
			self::LIGHTLEVEL 	=> ['type' => SpecificationType::MANY, 'entries' => [
				'Čtení a psaní' => 500,
				'Technické kreslení' => 750
			]],

			self::EVENT_COUNT,
			self::ALTITUDE 		=> ['type' => SpecificationType::NULL],
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

	public function getColor(): string
	{
		return match($this) {
			self::TEMPERATURE 	=> '#FF5733',  // Warm orange-red
			self::PRESSURE 		=> '#3498DB',  // Calm blue
			self::HUMIDITY 		=> '#1ABC9C',  // Fresh green
			self::LIGHTLEVEL 	=> '#F1C40F',  // Bright yellow
			self::EVENT_COUNT 	=> '#9B59B6',  // Purple
			self::ALTITUDE 		=> '#2C3E50',  // Deep navy blue
		};
	}

	public static function getValuesArray(): array
	{
		return array_column(self::cases(), 'value');
	}
}
