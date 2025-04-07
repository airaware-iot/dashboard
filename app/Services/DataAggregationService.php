<?php

namespace App\Services;

use App\AggregationOptions;
use App\SensorDataTypes;
use App\Exceptions\AggregationException;
use App\Models\Data;
use Carbon\Carbon;
use Exception;
use App\TimeConstants;

class DataAggregationService
{
	protected static string $timeFormat = 'Y-m-d H:i:s';

	/**
	 * Aggregates data based its type, time window and aggregation option
	 * @param  SensorDataTypes  $dataType
	 * @param  AggregationOptions  $type
	 * @param  Carbon  $timeLater
	 * @param  Carbon  $timeEarlier
	 * @return array<int, array{timestamp: string, average: float}>
	 */
	public static function aggregateData(
		SensorDataTypes $dataType,
		AggregationOptions $type,
		Carbon $timeLater,
		Carbon $timeEarlier
	): array
	{
		$coefficient = match($type) {
			AggregationOptions::HOURLY 	=> TimeConstants::SECONDS_IN_HOUR->value,
			AggregationOptions::DAILY 	=> TimeConstants::SECONDS_IN_DAY->value,
		};

		try {
			$values = self::getWeightedValues($dataType->value, $timeEarlier, $timeLater);
		}
		catch(AggregationException) {
			\Log::info("Invalid datetime range: {$timeEarlier->format(self::$timeFormat)} - {$timeLater->format(self::$timeFormat)}");
			return [];
		}

		$aggregatedValues = [];
		$currentPeriodStart = null;
		$totalWeight = 0;
		$sum = 0;

		foreach($values as $value)
		{
			$currentPeriodStart ??= $value['timestamp'];
//			echo "Sum: $sum, Value: {$value['data']}, Weight: {$value['weight']}, Date: {$value['timestamp']} <br>";

			if($currentPeriodStart->diffInSeconds($value['timestamp']) <= $coefficient)
			{
				$totalWeight += $value['weight'];
				$sum += $value['data'] * $value['weight'];
			}
			else
			{
				$aggregatedValues[] = [
					'timestamp' => $currentPeriodStart->format(self::$timeFormat),
					'average' => round(num: $sum / $totalWeight, precision: 2),
				];

				$currentPeriodStart->addSeconds($coefficient);
				$totalWeight = $sum = 0;
			}
		}

		// Addresses the remaining data which may not add up to exactly one hour from last aggregation
		$aggregatedValues[] = [
			'timestamp' => $currentPeriodStart->format(self::$timeFormat),
			'average' => round(num: $sum / $totalWeight, precision: 2),
		];

		return $aggregatedValues;
	}


	/**
	 * @throws AggregationException
	 */
	protected static function getWeightedValues(string $dataType, Carbon $timeEarlier, Carbon $timeLater): array
	{
		if($timeEarlier >= $timeLater) throw new AggregationException('The date range is invalid.', 500);

		$data = Data::whereType($dataType)
			->whereBetween('timestamp', [$timeEarlier, $timeLater])
			->orderBy('timestamp','asc')
			->get();
		$data->pluck(['timestamp', 'data']);

		$values = [];

		for($i = 0; $i < count($data) - 1; $i++) {
			$curr_data = $data[$i];
			$next_data = $data[$i + 1];

			$weight = $curr_data->timestamp->diffInSeconds($next_data->timestamp);

			$values[] = [
				'timestamp' => $curr_data->timestamp,
				'data' 		=> $curr_data->data,
				'weight' 	=> $weight,
			];
		}

		return $values;
	}
}