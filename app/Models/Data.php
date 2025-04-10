<?php

namespace App\Models;

use App\AggregationOptions;
use App\SensorDataTypes;
use App\Services\DataAggregationService;
use Carbon\Carbon;
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

	/*
	 * Data aggregation methods
	 */

	public static function getMinutesAvg(SensorDataTypes $dataType, Carbon $dateFrom, Carbon $dateTo): array
	{
		return DataAggregationService::aggregateData($dataType, AggregationOptions::MINUTES, $dateFrom, $dateTo);
	}

	public static function getHourlyAvg(SensorDataTypes $dataType, Carbon $dateFrom, Carbon $dateTo): array
	{
		return DataAggregationService::aggregateData($dataType, AggregationOptions::HOURS, $dateFrom, $dateTo);
	}

	public static function getDailyAvg(SensorDataTypes $dataType, Carbon $dateFrom, Carbon $dateTo): array
	{
		return DataAggregationService::aggregateData($dataType, AggregationOptions::DAYS, $dateFrom, $dateTo);
	}

	/*
	 * Statistical average helpers
	 */
	public static function getLatestValue(SensorDataTypes $dataType): float
	{
		return (float)self::whereType($dataType->value)->first()->data;
	}

	public static function getHighestHourlyValue(SensorDataTypes $dataType, Carbon $dateFrom, Carbon $dateTo) : float
	{
		$collection = collect(self::getHourlyAvg($dataType, $dateFrom, $dateTo));

		return $collection->max('average');
	}

	public static function getLowestHourlyValue(SensorDataTypes $dataType, Carbon $dateFrom, Carbon $dateTo) : float
	{
		$collection = collect(self::getHourlyAvg($dataType, $dateFrom, $dateTo));

		return $collection->min('average');
	}

	public static function getMedianHourlyValue(SensorDataTypes $dataType, Carbon $dateFrom, Carbon $dateTo) : float
	{
		$collection = collect(self::getHourlyAvg($dataType, $dateFrom, $dateTo));

		return $collection->median('average');
	}


	public static function getHighestDailyValue(SensorDataTypes $dataType, Carbon $dateFrom, Carbon $dateTo) : float
	{
		$collection = collect(self::getDailyAvg($dataType, $dateFrom, $dateTo));

		return $collection->max('average');
	}

	public static function getLowestDailyValue(SensorDataTypes $dataType, Carbon $dateFrom, Carbon $dateTo) : float
	{
		$collection = collect(self::getDailyAvg($dataType, $dateFrom, $dateTo));

		return $collection->min('average');
	}

	public static function getMedianDailyValue(SensorDataTypes $dataType, Carbon $dateFrom, Carbon $dateTo) : float
	{
		$collection = collect(self::getDailyAvg($dataType, $dateFrom, $dateTo));

		return $collection->median('average');
	}

	/*
	 * Hourly average helpers
	 */
	public static function getLastHour(SensorDataTypes $dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHour());
	}

	public static function getLastSixHours(SensorDataTypes $dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(6));
	}

	public static function getLastTwelveHours(SensorDataTypes $dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(12));
	}

	public static function getLastTwentyFourHours(SensorDataTypes $dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(24));
	}

	public static function getLastFortyEightHours(SensorDataTypes $dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(48));
	}

	public static function getLastSeventyTwoHours(SensorDataTypes $dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(72));
	}

	/*
	 * Daily average helpers
	 */
	public static function getLastDay(SensorDataTypes $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subDay());
	}

	public static function getLastThreeDays(SensorDataTypes $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subDays(3));
	}

	public static function getLastWeek(SensorDataTypes $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subWeek());
	}

	public static function getLastTwoWeeks(SensorDataTypes $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subWeeks(2));
	}

	public static function getLastMonth(SensorDataTypes $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subMonth());
	}

	public static function getLastQuarter(SensorDataTypes $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subMonths(3));
	}

	public static function getLastSemester(SensorDataTypes $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subMonths(6));
	}

	public static function getLastYear(SensorDataTypes $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subYear());
	}
}
