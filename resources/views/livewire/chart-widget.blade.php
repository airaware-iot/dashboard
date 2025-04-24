@php
    use App\Overrides\CustomFormatter;
	use App\TimeInterval;
	use Maantje\Charts\Chart;
	use Maantje\Charts\Line\Line;
	use Maantje\Charts\Line\Lines;
	use Maantje\Charts\Line\Point;
	use Maantje\Charts\Annotations\PointAnnotation;
    use Maantje\Charts\Annotations\XAxis\XAxisLineAnnotation;
    use Maantje\Charts\Annotations\XAxis\XAxisRangeAnnotation;
    use Maantje\Charts\Annotations\YAxis\YAxisLineAnnotation;
    use Maantje\Charts\Annotations\YAxis\YAxisRangeAnnotation;
    use Maantje\Charts\Formatter;
    use Maantje\Charts\XAxis;
    use Maantje\Charts\YAxis;
	use App\Services\GraphSpecVisualiserService;
@endphp
{{--<script>--}}
{{--    console.log(window.innerWidth)--}}
{{--</script>--}}
<div class="p-6 bg-white rounded-2xl" wire:poll.15s>
    <div class="mb-4">
        <h2 class="font-semibold text-xl">{{$chartYAxisTitle}}</h2>
        <select wire:change="updateTimeInterval($event.target.value)">
            @foreach(TimeInterval::cases() as $option)
                <option
                    value="{{$option->value}}"
                    {{$selectedTimeInterval->value == $option->value ? 'selected' : ''}}
                >
                    {{$option->value}}
                </option>
            @endforeach
        </select>
        @if(! $chartData)
            <p class="py-1 px-3 bg-red-200 text-red-500 rounded-lg inline-block mb-6">Žádná data pro daný interval</p>
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
    width: \App\Livewire\ChartWidget::$chartWidth,
    yAxis: [
        new YAxis(
            name: strtolower($chartYAxisTitle),
            title: $chartYAxisTitle,
            minValue: $chartMinValue,
            maxValue: $chartMaxValue,
            annotations: (new GraphSpecVisualiserService($selectedDataType))
                ->getYAxisAnnotations(),
            labelMargin: 30,
            formatter: Formatter::template(":value $chartYAxisUnit"),
        ),
    ],
    xAxis: new XAxis(
        title: $chartXAxisTitle,
        formatter: function () use ($chartData) {
			static $xAxisCounter = $chartData
			    ? count($chartData)
			    : 0;
			
			$label = "-$xAxisCounter h";
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
                ),
            ]
        ),
    ],
);
@endphp
        
        {!! $chart->render() !!}
    </div>
    
    <script>
        console.log(window.innerWidth)
    
    </script>
</div>
