<x-layout.layout title="Přehled">
    <div class="w-full grid md:grid-cols-2 grid-cols-1 md:items-center md:mb-8 mb-6 gap-4">
        <div class="max-md:row-start-2 ">
            <h1 class="text-white text-3xl font-medium mb-1">{{\App\Services\GreetingService::getGreeting()}}</h1>
            <p class="text-gray-body">Zde je váš komplexní přehled ovzduší od <b class="font-semibold">AirAware</b>.</p>
        </div>
        <div>
            <x-logo-full class="h-8 max-md:hidden md:ml-auto"/>
            <x-logo-symbol class="h-16 md:hidden"/>
        </div>
    </div>
    <div class="w-full grid xl:grid-cols-5 sm:grid-cols-2 grid-cols-1 gap-6 mb-8">
        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::TEMPERATURE"/>
        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::PRESSURE"/>
        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::HUMIDITY"/>
        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::CO2"/>
        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::LIGHTLEVEL"/>
    </div>
    <div class="w-full grid grid-cols-[2fr_3fr] grid-rows-2 gap-6 mb-8">
        <div>
            <livewire:recommendations-widget/>
        </div>
        <div class="grid grid-cols-2 gap-6">
            <livewire:chart-widget
                compact
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
        
    </div>
</x-layout.layout>