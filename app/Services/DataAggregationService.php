<?php

namespace App\Services;

use App\Models\Data;
use Carbon\Carbon;

class DataAggregationService
{
	public static function getHourlyAvg(string $dataType, Carbon $timeTo, Carbon $timeFrom): array
	{
		$timeFrom->subHour();

		$values = self::getWeightedValues($dataType, $timeFrom, $timeTo);
		$aggregated_values = [];

		foreach($values as $value)
		{
			static $current_hour = $value['timestamp'];
			static $count = 0;
			static $sum = 0;


			if($current_hour->diffInSeconds($value['timestamp']) <= 3600)
			{
				$count++;
				$sum += $value['data'] * $value['weight'];
			}
			else
			{
				$aggregated_values[] = [
					'timestamp' => $current_hour->format('Y-m-d H:m:s'),
					'average' => round(num: $sum / 3600, precision: 2),
				];

				$current_hour->addHour();
				$count = 0;
				$sum = 0;
			}
		}

		return $aggregated_values;
	}

	public static function getDailyAvg()
	{
		// TODO: finish
	}

	protected static function getWeightedValues($dataType, $timeFrom, $timeTo): array
	{
		$data = Data::whereType($dataType)
			->whereBetween('timestamp', [$timeFrom, $timeTo])
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