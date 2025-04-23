<x-layout.layout title="Hi mom">
    <h1>Test lol</h1>
    <livewire:live-sensor-readout :data-type="\App\SensorDataType::TEMPERATURE"/>
    <livewire:chart-widget
        :data-type="App\SensorDataType::TEMPERATURE"
    />
    <livewire:chart-widget
        :data-type="App\SensorDataType::LIGHTLEVEL"
    />
    <livewire:chart-widget
        :data-type="App\SensorDataType::EVENT_COUNT"
    />
    
</x-layout.layout>