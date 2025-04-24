<?php

namespace App\Models;

use App\Enums\AggregationInterval;
use App\Enums\SensorDataType;
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
		'type' => SensorDataType::class,
		'timestamp' => 'datetime',
	];

	/*
	 * Data aggregation methods
	 */

	public static function getMinutesAvg(SensorDataType $dataType, Carbon $dateFrom, Carbon $dateTo): array
	{
		return DataAggregationService::aggregateData($dataType, AggregationInterval::MINUTES, $dateFrom, $dateTo);
	}

	public static function getHourlyAvg(SensorDataType $dataType, Carbon $dateFrom, Carbon $dateTo): array
	{
		return DataAggregationService::aggregateData($dataType, AggregationInterval::HOURS, $dateFrom, $dateTo);
	}

	public static function getDailyAvg(SensorDataType $dataType, Carbon $dateFrom, Carbon $dateTo): array
	{
		return DataAggregationService::aggregateData($dataType, AggregationInterval::DAYS, $dateFrom, $dateTo);
	}

	/*
	 * Statistical average helpers
	 */
	public static function getLatestValue(SensorDataType $dataType): float
	{
		$value = self::whereType($dataType->value)->first();

		if($value) return $value->data;
		else return -1;

	}

	public static function getHighestHourlyValue(SensorDataType $dataType, Carbon $dateFrom, Carbon $dateTo) : float
	{
		$collection = collect(self::getHourlyAvg($dataType, $dateFrom, $dateTo));

		return $collection->max('average');
	}

	public static function getLowestHourlyValue(SensorDataType $dataType, Carbon $dateFrom, Carbon $dateTo) : float
	{
		$collection = collect(self::getHourlyAvg($dataType, $dateFrom, $dateTo));

		return $collection->min('average');
	}

	public static function getMedianHourlyValue(SensorDataType $dataType, Carbon $dateFrom, Carbon $dateTo) : float
	{
		$collection = collect(self::getHourlyAvg($dataType, $dateFrom, $dateTo));

		return $collection->median('average');
	}


	public static function getHighestDailyValue(SensorDataType $dataType, Carbon $dateFrom, Carbon $dateTo) : float
	{
		$collection = collect(self::getDailyAvg($dataType, $dateFrom, $dateTo));

		return $collection->max('average');
	}

	public static function getLowestDailyValue(SensorDataType $dataType, Carbon $dateFrom, Carbon $dateTo) : float
	{
		$collection = collect(self::getDailyAvg($dataType, $dateFrom, $dateTo));

		return $collection->min('average');
	}

	public static function getMedianDailyValue(SensorDataType $dataType, Carbon $dateFrom, Carbon $dateTo) : float
	{
		$collection = collect(self::getDailyAvg($dataType, $dateFrom, $dateTo));

		return $collection->median('average');
	}

	/*
	 * Hourly average helpers
	 */
	public static function getLastHour(SensorDataType $dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHour());
	}

	public static function getLastSixHours(SensorDataType $dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(6));
	}

	public static function getLastTwelveHours(SensorDataType $dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(12));
	}

	public static function getLastTwentyFourHours(SensorDataType $dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(24));
	}

	public static function getLastFortyEightHours(SensorDataType $dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(48));
	}

	public static function getLastSeventyTwoHours(SensorDataType $dataType): array
	{
		return self::getHourlyAvg($dataType, now(), now()->subHours(72));
	}

	/*
	 * Daily average helpers
	 */
	public static function getLastDay(SensorDataType $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subDay());
	}

	public static function getLastThreeDays(SensorDataType $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subDays(3));
	}

	public static function getLastWeek(SensorDataType $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subWeek());
	}

	public static function getLastTwoWeeks(SensorDataType $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subWeeks(2));
	}

	public static function getLastMonth(SensorDataType $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subMonth());
	}

	public static function getLastQuarter(SensorDataType $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subMonths(3));
	}

	public static function getLastSemester(SensorDataType $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subMonths(6));
	}

	public static function getLastYear(SensorDataType $dataType): array
	{
		return self::getDailyAvg($dataType, now(), now()->subYear());
	}
}
