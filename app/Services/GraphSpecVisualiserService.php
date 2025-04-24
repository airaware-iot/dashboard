<?php

namespace App\Services;

use App\Enums\SensorDataType;
use App\Enums\SpecificationType;
use Maantje\Charts\Annotations\YAxis\YAxisLineAnnotation;
use Maantje\Charts\Annotations\YAxis\YAxisRangeAnnotation;

class GraphSpecVisualiserService
{
	public function __construct(
		public SensorDataType $type
	) {}
	protected function minmax()
	{
		return [new YAxisRangeAnnotation (
			y1: $this->type->getSpecs()['min'],
			y2: $this->type->getSpecs()['max'],
			color: $this->type->getColor(),
			label: $this->type->getSpecLabel(),


		)];
	}

	protected function many()
	{
		$entries = $this->type->getSpecs()['entries'];
		$lines = [];

		foreach($entries as $key => $value) {
			$lines[] = new YAxisLineAnnotation(
				y: $value,
				color: $this->type->getColor(),
				size: 3,
//				dash: '20,20',
				label: $this->type->getSpecLabel() . $key,
//				textLeftMargin: 3
			);
		}
		return $lines;
	}
	public function getYAxisAnnotations(): array
	{
		return match($this->type->getSpecs()['type']) {
		 	SpecificationType::MINMAX 	=> $this->minmax(),
			SpecificationType::MANY 	=> $this->many(),
			SpecificationType::NULL 	=> [],
		};
	}
}