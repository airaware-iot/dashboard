@php
    use App\Enums\TimeInterval;
	use App\Services\GraphSpecVisualiserService;
	use Maantje\Charts\Chart;
	use Maantje\Charts\Formatter;
	use Maantje\Charts\Line\Line;
	use Maantje\Charts\Line\Lines;
	use Maantje\Charts\Line\Point;
	use Maantje\Charts\XAxis;
	use Maantje\Charts\YAxis;
@endphp
{{--<script>--}}
{{--    console.log(window.innerWidth)--}}
{{--</script>--}}
<div class="p-6 bg-turquoise-foreground rounded-2xl" wire:poll.{{config('app.default_values.polling_rate_slow')}}="update">
    <div class="mb-4">
        <h2 class="font-semibold text-xl text-white">{{$chartYAxisTitle}}</h2>
        <select wire:change="updateTimeInterval($event.target.value)" class="text-gray-body">
            @foreach(TimeInterval::cases() as $option)
                <option
                    value="{{$option->value}}"
                    {{$selectedTimeInterval->value == $option->value ? 'selected' : ''}}
                >
                    <p>{{$option->value}}</p>
                </option>
            @endforeach
        </select>
        @if(! $chartData)
            <p class="py-1 px-3 bg-turquoise-main text-white rounded-lg inline-block mb-6">Žádná data pro daný interval</p>
        @endif
    </div>
    <div>
        @php
            
            $pointArray = [];
            
            foreach ($chartData as $point)
            {
                static $counter = 0;
            
                $pointArray[] = new Point(x: $counter * $chartXOffset, y: $point['value']);
            
                $counter++;
            }
            
            $chart = new Chart(
                width: 777,
				background: 'var(--color-turquoise-foreground)',
				fontFamily: 'var(--font-sans)',
				grid: $compact
				    ? new \Maantje\Charts\Grid(lineColor: 'var(--color-turquoise-foreground)')
				    : new \Maantje\Charts\Grid(lineColor: 'var(--color-gray-body)', opacity: 0.3),
				yAxis: [
					new YAxis(
						name: strtolower($chartYAxisTitle),
						title: $chartYAxisTitle,
						minValue: $chartMinValue,
						maxValue: $chartMaxValue,
						color: 'var(--color-gray-body)',
						annotations: (new GraphSpecVisualiserService($selectedDataType))
							->getYAxisAnnotations(),
						fontSize: $compact ? 0 : 14,
						labelMargin: $compact ? 0 : 30,
						formatter: Formatter::template(":value $chartYAxisUnit"),
					),
				],
				xAxis: new XAxis(
					title: $compact ? '' : $chartXAxisTitle,
					color: $compact ? 'var(--color-turquoise-foreground)' : 'var(--color-gray-body)',
					fontSize: 14,
					formatter: function () use ($chartData, $chartXAxisUnit) {
						static $xAxisCounter = $chartData
							? count($chartData)
							: 0;

						$label = "-$xAxisCounter"."  $chartXAxisUnit";
						$xAxisCounter--;

						return $label;
					},
				),
				series: [
					new Lines(
						lines: [
							new Line(
								points: $pointArray,
								size: 4,
								yAxis: strtolower($chartYAxisTitle),
								color: $chartColor,
								curve: null
							),
						]
					),
				],
            );
        @endphp
        {!! $chart->render() !!}
    </div>
</div>
