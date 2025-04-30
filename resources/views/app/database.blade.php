<x-layout.layout title="Databáze">
    <div class="w-full grid md:grid-cols-2 grid-cols-1 md:items-center md:mb-8 mb-6 gap-4">
        <div class="max-md:row-start-2 ">
            <h1 class="text-white text-3xl font-medium mb-1">Databáze</h1>
            <p class="text-gray-body">Historie zaznamenaných hodnot a statistické údaje.</p>
        </div>
        <div>
            <x-logo-full class="h-8 max-md:hidden md:ml-auto"/>
            <x-logo-symbol class="h-16 md:hidden"/>
        </div>
    </div>
{{--    <div class="w-full grid xl:grid-cols-5 sm:grid-cols-2 grid-cols-1 gap-6 mb-8">--}}
{{--        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::TEMPERATURE"/>--}}
{{--        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::PRESSURE"/>--}}
{{--        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::HUMIDITY"/>--}}
{{--        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::CO2"/>--}}
{{--        <livewire:live-sensor-readout :data-type="\App\Enums\SensorDataType::LIGHTLEVEL"/>--}}
{{--    </div>--}}
{{--    <div class="w-full grid xl:grid-cols-[2fr_3fr] gap-6 mb-24 max-sm:mb-32">--}}
        <div class="p-6 rounded-xl bg-turquoise-foreground pb-40">
            <h2  class="font-semibold text-xl text-white">Databáze</h2>
            <p class="text-gray-body mb-6">Nejnovější údaje ze senzorů</p>
            <div class="overflow-x-auto {{-- max-w-screen-xl --}} ">
                <table class="rounded-xl overflow-clip w-full">
                    <tbody>
                    <tr class="p-3 bg-turquoise-main">
                        <th class="px-5 py-4 text-white text-left font-medium">Typ hodnoty</th>
                        <th class="px-3 py-4 text-white text-left font-medium">Hodnota</th>
                        <th class="px-5 py-4 text-white text-left font-medium">Čas</th>
                    </tr>
                    @foreach($data as $entry)
                        @php
                            $color = "color: {$entry->type->getColor()}"
                        @endphp
                        <tr class="">
                            <td class="border-b border-gray-body/50 text-white/90 body px-3 py-2">
                                <p class="inline-block px-3 py-2" style="{{$color}}">{{$entry->type->getLabel()}}</p>
                            </td>
                            <td class="border-b border-gray-body/50 text-white/90 body">
                                <p class="inline-block px-3 py-2"><strong class="font-semibold">{{$entry->data}}</strong> {{$entry->type->getUnit()}}</p>
                            </td>
                            <td class="border-b border-gray-body/50 text-white/90 body px-3 py-2">
                                <p class="inline-block px-3 py-2">{{$entry->timestamp->format('d.m.Y H:i:s')}}</p>
                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
                <div class="mt-6 p-6 bg-turquoise-background rounded-xl">
                    {{$data->links()}}
                </div>
            </div>
        </div>
        
{{--        <livewire:statistical-data-widget/>--}}
{{--    </div>--}}
</x-layout.layout>