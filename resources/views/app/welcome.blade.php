<x-layout.layout title="Hi mom">
    <div class="w-full grid grid-cols-5 gap-6 mb-8">
        <livewire:live-sensor-readout :data-type="\App\SensorDataType::TEMPERATURE"/>
        <livewire:live-sensor-readout :data-type="\App\SensorDataType::PRESSURE"/>
        <livewire:live-sensor-readout :data-type="\App\SensorDataType::HUMIDITY"/>
        <livewire:live-sensor-readout :data-type="\App\SensorDataType::CO2"/>
        <livewire:live-sensor-readout :data-type="\App\SensorDataType::LIGHTLEVEL"/>
    </div>
    <div class="w-full grid grid-cols-2 grid-rows-2 gap-6 mb-8">
        <livewire:chart-widget
            :data-type="App\SensorDataType::TEMPERATURE"
        />
        <livewire:chart-widget
            :data-type="App\SensorDataType::LIGHTLEVEL"
        />
        <livewire:chart-widget
            :data-type="App\SensorDataType::PRESSURE"
        />
        <livewire:chart-widget
            :data-type="App\SensorDataType::CO2"
        />
        <livewire:chart-widget
            :data-type="App\SensorDataType::HUMIDITY"
        />
    </div>
   
    
</x-layout.layout>