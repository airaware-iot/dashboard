<?php

namespace App\Models;

use App\SensorDataTypes;
use App\Services\DataAggregationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    /** @use HasFactory<\Database\Factories\DataFactory> */
    use HasFactory;

	protected $fillable = ['type', 'data', 'timestamp'];

	protected $casts = [
		'type' => SensorDataTypes::class,
		'timestamp' => 'datetime',
	];

	protected static function isValidDataType($dataType): bool
	{
		return in_array($dataType, SensorDataTypes::getValueArray());
	}

	public static function getHourlyAvg($dataType, $dateFrom, $dateTo): array
	{
		if(! self::isValidDataType($dataType)) return [];

		return DataAggregationService::aggregateData($dataType, $dateFrom, $dateTo);
	}

	public static function getDailyAvg($dataType, $dateFrom, $dateTo): array
	{
		if(! self::isValidDataType($dataType)) return [];

		return DataAggregationService::getDailyAvg($dataType, $dateFrom, $dateTo);
	}

	/*
	 * Hourly average helpers
	 */

	public static function getLastHour($dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHour());
	}

	public static function getLastSixHours($dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(6));
	}

	public static function getLastTwelveHours($dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(12));
	}
	public static function getLastTwentyFourHours($dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(24));
	}
	public static function getLastFortyEightHours($dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(48));
	}
	public static function getLastSeventyTwoHours($dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(72));
	}

	public static function getLastTwoDays($dataType): array
	{

	}

}
