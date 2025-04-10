<?php

namespace App\Services;

use App\AggregationOptions;
use App\Exceptions\AggregationException;
use App\Models\Data;
use App\SensorDataTypes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class DataAggregationService
{
	protected static string $timeFormat = 'Y-m-d H:i:s';

	/**
	 * Aggregates data based its type, time window and aggregation option. If no data is found, returns an empty array.
	 * @param  SensorDataTypes  $dataType
	 * @param  AggregationOptions  $aggregationType
	 * @param  Carbon  $timeLater
	 * @param  Carbon  $timeEarlier
	 * @return array<int, array{timestamp: string, average: float}>
	 */
	public static function aggregateData(
		SensorDataTypes $dataType,
		AggregationOptions $aggregationType,
		Carbon $timeLater,
		Carbon $timeEarlier
	): array
	{
		$interval = $aggregationType->getInterval();

		try {
			$values = self::getValues($dataType->value, $timeEarlier, $timeLater);
			if(! $values) return [];
		}
		catch(AggregationException) {
			return []; // Invalid timespan
		}

		$dataPointsCount = self::getDataPointsCount($aggregationType, $timeLater, $timeEarlier);

		$aggregatedValues = [];
		$currentIntervalStart = $timeEarlier->copy();
		$nextIntervalStart = $timeEarlier->copy()->addSeconds($interval);

		for($i = 0; $i < $dataPointsCount; $i++) {
			$currentInterval = $values->whereBetween('timestamp', [$currentIntervalStart, $nextIntervalStart])->all();
			$currentInterval = array_values($currentInterval); // Re-indexes keys from 0

			$aggregatedValues[] = [
				'timestamp' => $currentIntervalStart,
				'value' => count($currentInterval) != 0
					? self::getAggregatedValues($currentInterval, $currentIntervalStart, $nextIntervalStart)
					: 0
			];

			$currentIntervalStart->addSeconds($interval);
			$nextIntervalStart->addSeconds($interval);
		}

		return $aggregatedValues;
	}

	protected static function getAggregatedValues(array $currentInterval, $currentIntervalStart, $nextIntervalStart): float
	{
		$currentIntervalCount = count($currentInterval);
		$weightedSum = 0;
		$totalWeight = 0;

		for($j = 0; $j < $currentIntervalCount; $j++) {
			$currentData = $currentInterval[$j];
			switch($j) {
				case 0: // First element
					$weight = $currentIntervalStart->diffInSeconds($currentData['timestamp']);
					break;
				case $currentIntervalCount - 1: // Last element
					$weight = $currentData['timestamp']->diffInSeconds($nextIntervalStart);
					break;
				default: // The rest
					$nextData = $currentInterval[$j+1];
					$weight = $currentData['timestamp']->diffInSeconds($nextData['timestamp']);
					break;
			}
			$weightedSum += $currentData['data'] * $weight;
			$totalWeight += $weight;
		}

		return round($weightedSum / $totalWeight, 2);
	}

	protected static function getDataPointsCount(AggregationOptions $option, Carbon $timeTo, Carbon $timeFrom): int
	{
		$value = ceil($timeFrom->diffInSeconds($timeTo) / $option->getInterval());

		return max($value, 0);
	}

	/**
	 * @throws AggregationException
	 */
	protected static function getValues(string $dataType, Carbon $timeEarlier, Carbon $timeLater): ?Collection
	{
		if($timeEarlier >= $timeLater) throw new AggregationException('The date range is invalid.', 500);

		$data = Data::whereType($dataType)
			->whereBetween('timestamp', [$timeEarlier, $timeLater])
			->orderBy('timestamp','asc')
			->get(['data','timestamp']);

		return $data->isNotEmpty() ? $data : null;
	}
}