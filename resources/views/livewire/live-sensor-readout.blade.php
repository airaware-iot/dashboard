<div class="bg-turquoise-foreground backdrop-blur-sm p-6 rounded-lg" wire:poll.{{config('app.default_values.polling_rate_fast')}}="update">
    <div class="flex flex-col w-full">
        <div class="flex gap-2 items-center">
            <p class="text-gray-body">{{$dataType->getLabel()}}</p>
            <div class="size-3 {{$statusColor}} rounded-full"></div>
        </div>
        <p class="text-4xl text-white font-medium block w-full">{{$dataType->getLatest()}}{{$dataType->getUnit()}}</p>
    </div>
</div>
