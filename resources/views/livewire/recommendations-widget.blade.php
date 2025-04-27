<div>
    <div class="p-6 bg-turquoise-foreground rounded-2xl" wire:poll.{{config('app.default_values.polling_rate_fast')}}="update">
        <div class="mb-6">
            <h2 class="font-semibold text-xl text-white">Doporučení</h2>
            <p class="text-gray-body">Stav ovzduší: {{$airQualityRating}}</p>
        </div>
        <ul class="flex flex-col gap-3">
            @foreach($recommendations as $recommendation)
                <li class="list-none block bg-turquoise-background p-5 [&>p]:text-gray-body rounded-lg">
                    <p>{!! $recommendation !!}</p>
                </li>
            @endforeach
            
        </ul>
    
    </div>
</div>
