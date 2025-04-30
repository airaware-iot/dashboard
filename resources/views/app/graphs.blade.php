<x-layout.layout title="Grafy">
    <div class="w-full grid md:grid-cols-2 grid-cols-1 md:items-center md:mb-8 mb-6 gap-4">
        <div class="max-md:row-start-2 ">
            <h1 class="text-white text-3xl font-medium mb-1">Grafy</h1>
            <p class="text-gray-body">Podrobnější grafy a přehled dat z senzorů AirAware.</p>
        </div>
        <div>
            <x-logo-full class="h-8 max-md:hidden md:ml-auto"/>
            <x-logo-symbol class="h-16 md:hidden"/>
        </div>
    </div>
    <div class="w-full grid xl:grid-cols-2 grid-cols-1 gap-6 mb-24 max-sm:mb-32">
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
            <livewire:chart-widget
                :data-type="\App\Enums\SensorDataType::ALTITUDE"
            />
        </div>br
    </div>rbro
</x-layout.layout>