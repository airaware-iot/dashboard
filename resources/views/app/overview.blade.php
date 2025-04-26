<x-layout.layout title="Hi mom">
    <div class="w-full grid grid-cols-5 gap-6 mb-8">
        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::TEMPERATURE"/>
        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::PRESSURE"/>
        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::HUMIDITY"/>
        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::CO2"/>
        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::LIGHTLEVEL"/>
    </div>
    <div class="w-full grid grid-cols-2 grid-rows-2 gap-6 mb-8">
        <livewire:chart-widget
            :data-type="\App\Enums\SensorDataType::TEMPERATURE"
        />
        <livewire:chart-widget
            :data-type="\App\Enums\SensorDataType::LIGHTLEVEL"
        />
        <livewire:chart-widget
            :data-type="\App\Enums\SensorDataType::PRESSURE"
        />
        <livewire:chart-widget
            :data-type="\App\Enums\SensorDataType::CO2"
        />
        <livewire:chart-widget
            :data-type="\App\Enums\SensorDataType::HUMIDITY"
        />
    </div>


</x-layout.layout>