<div class="h-full grid-cols-auto">
    <div class="sm:p-6 px-4 py-6 bg-turquoise-foreground rounded-2xl h-full" wire:poll.{{config('app.default_values.polling_rate_fast')}}="update">
        <div class="mb-6">
            <div class="flex gap-2 items-center">
                <h2 class="font-semibold text-xl text-white">Doporučení</h2>
                @if($recommendationsWithoutNoDataMessages != 0)
                    <div class="flex items-center justify-center bg-red-500 rounded-full size-5 text-xs">
                        <p class="text-white font-semibold ml-[-0.125rem]"> {{$recommendationsWithoutNoDataMessages}} </p>
                    </div>
                @endif
            </div>
            <p class="text-gray-body">Stav ovzduší: <strong class="font-semibold">{{$airQualityRating}}</strong></p>
        </div>
        <ul class="flex flex-col gap-3">
            @foreach($recommendations as $recommendation)
                <li class="list-none block bg-turquoise-background sm:p-5 px-4 py-5 [&>p]:text-gray-body rounded-lg">
                    <p>{!! $recommendation !!}</p>
                </li>
            @endforeach
            
        </ul>
    
    </div>
</div>
