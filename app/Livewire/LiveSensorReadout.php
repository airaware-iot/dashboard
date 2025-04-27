<?php

namespace App\Livewire;

use App\Enums\SensorDataType;
use Livewire\Component;

class LiveSensorReadout extends Component
{
	public SensorDataType $dataType;
	public string $statusColor;
	public int|float|string $value;

	public function mount(SensorDataType $dataType): void
	{
		$this->dataType = $dataType;
		$this->update();
	}

	public function update(): void
	{
		$this->updateValue();
		$this->updateColor();
	}
	protected function updateColor(): void
	{
		$value = $this->value;
		$limits =  $this->dataType->getSpecsAsSimpleArray();

		if($value == '? ') { // No recent data found
			$this->statusColor = 'bg-gray-500';
		}
		else if($value <= $limits['limit_high'] && $value >= $limits['limit_low']) { // Is within limits
			$this->statusColor = 'bg-green-500';
		}
		else { // Outside of limits
			$this->statusColor = 'bg-red-500';
		}
	}
	protected function updateValue(): void
	{
		$this->value = $this->dataType->getLatest();
	}

    public function render()
    {
        return view('livewire.live-sensor-readout');
    }
}
