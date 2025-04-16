<?php

namespace App\Livewire;

use App\SensorDataType;
use App\TimeInterval;
use Livewire\Component;

class ChartWidget extends Component
{
	/*
	 * TODO LIST
	 *
	 * - finish sensor "scoping"
	 * - create chart annotations for hygienically recommended values
	 * - fix DataAggregationService always provide the right amount of values (e.g. 24h = 24x) - just iterate remainder
	 * - fix the broken X axis - should show date(time) =
	 * probably a custom method that creates short human readable version (like -1d or -1h or something like that)
	 */

	// public Sensors $sensors; TODO
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


	public static int $chartWidth = 1200;

	public function mount(SensorDataType $dataType, string $title = 'Chart', string $color = 'red'): void
	{
		// Attributes
		$this->selectedDataType = $dataType;
		$this->chartTitle = $title;
		$this->chartColor = $color;

		// Default values
		$this->selectedTimeInterval ??= TimeInterval::LAST_TWENTY_FOUR_HOURS;

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

		$this->chartMinValue = floor($data->min('value'));
		$this->chartMaxValue = ceil($data->max('value'));
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
