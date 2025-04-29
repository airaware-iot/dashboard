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
    <div class="w-full grid xl:grid-cols-[2fr_3fr] gap-6 mb-24 max-sm:mb-32">
        <livewire:recommendations-widget/>
        <div class="grid md:grid-cols-2 grid-cols-1 gap-6">
            <livewire:chart-widget
                :data-type="\App\Enums\SensorDataType::TEMPERATURE"
                compact
            />
            <livewire:chart-widget
                :data-type="\App\Enums\SensorDataType::LIGHTLEVEL"
                compact
            />
            <livewire:chart-widget
                :data-type="\App\Enums\SensorDataType::PRESSURE"
                compact
            />
            <livewire:chart-widget
                :data-type="\App\Enums\SensorDataType::CO2"
                compact
            />
            <livewire:chart-widget
                :data-type="\App\Enums\SensorDataType::HUMIDITY"
                compact
            />
            <livewire:chart-widget
                :data-type="\App\Enums\SensorDataType::ALTITUDE"
                compact
            />
        </div>br
    </div>rbro
</x-layout.layout>