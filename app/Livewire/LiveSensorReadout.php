<?php

namespace App\Livewire;

use App\Enums\SensorDataType;
use Livewire\Component;

class LiveSensorReadout extends Component
{
	public SensorDataType $dataType;
	public $statusColor;

	public function mount(SensorDataType $dataType): void
	{
		$this->dataType = $dataType;

		$value = $this->dataType->getLatest();
		$limits =  $this->dataType->getLighthouseValues();

		if($value == '?') {
			$this->statusColor = 'bg-gray-500';
		}
		else if($value <= $limits['limit_high'] && $value >= $limits['limit_low']) {
			$this->statusColor = 'bg-green-500';
		}
		else {
			$this->statusColor = 'bg-red-500';
		}

		// If within 10% of min or max, make it yellow, else when
	}

    public function render()
    {
        return view('livewire.live-sensor-readout');
    }
}
