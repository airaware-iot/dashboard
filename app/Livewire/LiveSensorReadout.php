<?php

namespace App\Livewire;

use App\Enums\SensorDataType;
use Livewire\Component;

class LiveSensorReadout extends Component
{
	public SensorDataType $dataType;

	public function mount(SensorDataType $dataType): void
	{
		$this->dataType = $dataType;
	}

    public function render()
    {
        return view('livewire.live-sensor-readout');
    }
}
