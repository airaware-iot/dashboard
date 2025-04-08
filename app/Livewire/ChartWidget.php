<?php

namespace App\Livewire;

use App\SensorDataTypes;
use App\TimeIntervals;
use Livewire\Component;

class ChartWidget extends Component
{
	// public Sensors $sensors; TODO: finish
	public SensorDataTypes $selectedDataType;
	public TimeIntervals $selectedTimeInterval;

	public string $chartTitle;
	public string $chartColor;
	public string $chartXAxisTitle = 'time';
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


	protected int $screenWidth = 1200;

	public function mount(SensorDataTypes $dataType, string $title = 'Chart', string $color = 'red'): void
	{
		// Attributes
		$this->selectedDataType = $dataType;
		$this->chartTitle = $title;
		$this->chartColor = $color;

		// Default values
		$this->selectedTimeInterval ??= TimeIntervals::LAST_TWENTY_FOUR_HOURS;

		// Setup chart data
		$this->setAllChartData();
	}

	public function render()
	{
		return view('livewire.chart-widget');
	}

	public function updateTimeInterval($interval): void
	{
		$this->selectedTimeInterval = TimeIntervals::from($interval);
		$this->setAllChartData();
	}

	protected function setAllChartData(): void
	{
		$this->setChartData();
		$this->setChartMinMaxValues();
		$this->setChartYAxisTitle();
		$this->setChartYAxisUnit();
		$this->setXOffset();
	}

	protected function setChartData(): void
	{
		$this->chartData = $this->selectedTimeInterval->getData($this->selectedDataType);
	}

	protected function setChartMinMaxValues(): void
	{
		$data = collect($this->chartData);

		$this->chartMinValue = floor($data->min('value') - 2);
		$this->chartMaxValue = ceil($data->max('value') + 2);
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
		$this->chartXOffset = $this->screenWidth / count($this->chartData);
	}
}
