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

<div class="p-4 border-red-500">
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
    {{$selectedTimeInterval->value}}
    
    <div>
@php
if (! $chartData) echo 'no data'; // TODO: handle this correctly

$pointArray = [];

foreach ($chartData as $point)
{
    static $counter = 0;

    $pointArray[] = new Point(x: $counter * $chartXOffset, y: $point['value']);

    $counter++;
}

bg-red
$chart = new Chart(
    width: \App\Livewire\ChartWidget::$chartWidth,
    yAxis: [
        new YAxis(
            name: strtolower($chartYAxisTitle),
            title: $chartYAxisTitle,
            minValue: $chartMinValue,
            maxValue: $chartMaxValue,
            color: $chartColor,
            annotations: (new GraphSpecVisualiserService($selectedDataType))
                ->getYAxisAnnotations(),
            labelMargin: 10,
            formatter: Formatter::template(":value $chartYAxisUnit"),
        ),
    ],
    xAxis: new XAxis(
        title: $chartXAxisTitle,
        formatter: function () use ($chartData) {
			static $xAxisCounter = $chartData
			    ? count($chartData)
			    : 0;
			
			$label = "-$xAxisCounter d";
			$xAxisCounter--;
			
			return $label;
        },
    ),
    series: [
        new Lines(
            lines: [
                new Line(
                    points: $pointArray,
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
</div>
