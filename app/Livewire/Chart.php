<?php

namespace App\Livewire;

use App\Models\Data;
use App\SensorDataType;
use Livewire\Component;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;

class Chart extends Component
{
	protected static int $screenWidth = 1200;

	public \Maantje\Charts\Chart $chart;

	public function __invoke(): void
	{
		$this->chart = $this->generateChart();
	}

	public function render()
    {
        return view('livewire.chart');
    }

	// IDEA: make an enum for data helper options and populate a dropdown with it, also add data type and sensor later
	protected function generateChart(): \Maantje\Charts\Chart
	{
		$data = Data::getLastTwentyFourHours(SensorDataType::TEMPERATURE);

		$xOffset = self::$screenWidth / count($data);
		$pointArray = [];

		foreach($data as $point) {
			static $counter = 0;

			$pointArray[] = new Point(x: $counter * $xOffset, y: $point['value']);

			$counter++;
		}

		$chart = new \Maantje\Charts\Chart(
			series: [
				new Lines(
					lines: [
						new Line(
							points: $pointArray,
							color: 'red',
							curve: 8
						)
					]
				)
			]
		);

		dd($chart);

		return $chart;

//			$chart = new \Maantje\Charts\Chart(
//				series: [
//					new Lines(
//						lines: [
//							new Line(
//								points: [
//									new Point(0,0)
//								],
//								color: 'red',
//								curve: 8
//							)
//						]
//					)
//				]
//			);
	}
}
