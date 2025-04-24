<?php

namespace App\Livewire;

use App\Enums\SensorDataType;
use App\Enums\TimeInterval;
use Livewire\Component;

class ChartWidget extends Component
{
	public SensorDataType $selectedDataType;
	public TimeInterval $selectedTimeInterval;

	public string $chartTitle;
	public string $chartColor;
	public string $chartXAxisTitle = 'Doba';
	public string $chartXAxisUnit = '';
	public string $chartXOffset;
	public string $chartYAxisTitle;
	public string $chartYAxisUnit;
	public int $chartMinValue;
	public int $chartMaxValue;

	/**
	 * @var array Array of data points for the chart
	 */
	public array $chartData;

	/**
	 * @var array Sections of the chart, such as optimal value, too high, too low, etc.
	 */
	public array $chartAnnotations = []; // TODO: finish with hygienically recommended values

	public static int $chartWidth = 800;

	public function mount(SensorDataType $dataType, string $title = 'Chart', ?string $color = null): void
	{
		// Attributes
		$this->selectedDataType = $dataType;
		$this->chartTitle = $title;

		if(! $color) $this->chartColor = $dataType->getColor();
		else $this->chartColor = $color;

		// Default values
		$this->selectedTimeInterval ??= TimeInterval::LAST_TWELVE_HOURS;

		// Setup chart data
		$this->setChartData();
		$this->setChartMinMaxValues();
		$this->setChartYAxisTitle();
		$this->setChartYAxisUnit();
		$this->setXOffset();
	}

	public function render()
	{
		return view('livewire.chart-widget');
	}

	public function updateTimeInterval($interval): void
	{
		$this->selectedTimeInterval = TimeInterval::from($interval);
		$this->setChartData();
		$this->setChartMinMaxValues();
		$this->setXOffset();
	}

	protected function setChartData(): void
	{
		$this->chartData = $this->selectedTimeInterval->getData($this->selectedDataType);
	}

	protected function setChartMinMaxValues(): void
	{
		$data = collect($this->chartData);

		$this->chartMinValue = min(floor($data->min('value')), $this->selectedDataType->getSpecsMinMax()['min']);
		$this->chartMaxValue = max(ceil($data->max('value')), $this->selectedDataType->getSpecsMinMax()['max']);
	}

	protected function setChartYAxisUnit(): void
	{
		$this->chartYAxisUnit = $this->selectedDataType->getUnit();
	}

	protected function setChartYAxisTitle(): void
	{
		$this->chartYAxisTitle = $this->selectedDataType->getLabel();
	}

	protected function setXOffset(): void
	{
		$count = count($this->chartData);

		$count != 0
			? $this->chartXOffset = self::$chartWidth / $count
			: $this->chartXOffset = 0;

	}
}
