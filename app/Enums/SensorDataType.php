<?php

namespace App\Enums;

use App\Models\Data;

enum SensorDataType: string
{
	case EVENT_COUNT = 'event-count';
    case TEMPERATURE = 'temperature';
	case HUMIDITY = 'relative-humidity';
	case LIGHTLEVEL = 'illuminance';
	case PRESSURE = 'pressure';
	case ALTITUDE = 'altitude';
	case CO2 = 'co2';

	public function getUnit(): string
	{
		return match($this) {
			self::TEMPERATURE 	=> '˚C',
			self::PRESSURE 		=> 'HPa',
			self::HUMIDITY 		=> '%',
			self::LIGHTLEVEL 	=> 'lux',
			self::EVENT_COUNT 	=> 'x',
			self::ALTITUDE 		=> 'm',
			self::CO2			=> 'ppm',
		};
	}

	public function getSpecs(): array
	{
		return match($this) {
			self::TEMPERATURE 	=> ['type' => SpecificationType::MINMAX, 'min' => 20, 'max' => 28],
			self::PRESSURE 		=> ['type' => SpecificationType::MINMAX, 'min' => 963.25, 'max' => 1063.25],
			self::HUMIDITY 		=> ['type' => SpecificationType::MINMAX, 'min' => 30, 'max' => 65],
			self::CO2			=> ['type' => SpecificationType::MANY, 'entries' => ['oxidu uhličitého' => 900,]],
			self::LIGHTLEVEL 	=> ['type' => SpecificationType::MANY, 'entries' => ['čtení a psaní' => 500, 'technické kreslení' => 750]],
			self::EVENT_COUNT,
			self::ALTITUDE 		=> ['type' => SpecificationType::NULL],
		};
	}
	public function getSpecsMinMax(): array
	{
		return match ($this) {
			self::TEMPERATURE, self::PRESSURE, self::HUMIDITY => ['min' => $this->getSpecs()['min'] * 0.9, 'max' => $this->getSpecs()['max'] * 1.1],
			self::CO2, self::LIGHTLEVEL => ['min' => min($this->getSpecs()['entries']) * 0.9, 'max' => max($this->getSpecs()['entries']) * 1.1],
			default => ['min' => null, 'max' => null]
		};
	}

	public function getSpecLabel(): string
	{
		return match($this) {
			self::TEMPERATURE 	=> 'Doporučená teplota ',
			self::PRESSURE 		=> 'Doporučený tlak ',
			self::HUMIDITY 		=> 'Doporučená vlhkost ',
			self::LIGHTLEVEL 	=> 'Doporučená úroveň osvětlení pro ',
			self::EVENT_COUNT 	=> 'Počet kliknutí ',
			self::ALTITUDE 		=> 'Nadmořská výška ',
			self::CO2 			=> 'Maximální množství '
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
			self::CO2 			=> 'Oxid uhličitý'
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
			self::CO2			=> '#1E1E1E',  // Dark gray
		};
	}

	public function getLighthouseValues(): array
	{
		return match($this) {
			self::TEMPERATURE  => [
				'limit_high' => 28,
				'limit_low' => 20,
			],
			self::PRESSURE => [
				'limit_high' => 1063.25,
				'limit_low' => 963.25,
			],
			self::HUMIDITY => [
				'limit_high' => 999999,
				'limit_low' => 30,
			],
			self::CO2 => [
				'limit_high' => 900,
				'limit_low' => -999999,
			],
			self::LIGHTLEVEL => [
				'limit_high' => 999999,
				'limit_low' => 500,
			],
			self::EVENT_COUNT,
			self::ALTITUDE => null,
		};

	}

	public function getLatest(): int|string|float
	{
		return Data::getLatestValue($this) ?? '? ';
	}

	public static function getValuesArray(): array
	{
		return array_column(self::cases(), 'value');
	}
}
