@php
    use App\TimeIntervals;
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
@endphp

<div>
    <select wire:change="updateTimeInterval($event.target.value)">
        @foreach(TimeIntervals::cases() as $option)
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
            $pointArray = [];
    
            if (! $chartData) echo 'no data'; // TODO: handle this correctly
    
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
//						color: $chartColor,
						annotations: [
//                        new YAxisLineAnnotation(
//                            y: 48,
//                            color: 'red',
//                            size: 3,
//                            dash: '20,20',
//                            label: 'Critical Hot',
//                            textLeftMargin: 3
//                        ),
//                        new YAxisRangeAnnotation(
//                            y1: 39,
//                            y2: 48,
//                            color: 'red',
//                            label: 'Too hot',
//                        ),
						],
						labelMargin: 10,
						formatter: Formatter::template(":value $chartYAxisUnit"),
					),
//					new YAxis(
//						name: 'elevation',
//						title: 'Elevation',
//						minValue: 0,
//						maxValue: 3000,
//						annotations: [
//							new PointAnnotation(
//								x: 1725331334 + 3600,
//								y: 2000,
//								markerSize: 10,
//								markerBackgroundColor: 'white',
//								markerBorderColor: 'red',
//								markerBorderWidth: 4,
//								label: 'Point annotation',
//							),
//						],
//						labelMargin: 10,
//						formatter: Formatter::template(':value m')

//					),
				],
//				xAxis: new XAxis(
//					title: $chartXAxisTitle,
////					annotations: [
////						new XAxisLineAnnotation(
////							x: 1725331334 + 3600 + 1800,
////							color: 'green',
////							label: 'Halfway',
////							textLeftMargin: -2
////						),
////						new XAxisRangeAnnotation(
////							x1: 1725331334 + 3600 + 3600,
////							x2: 1725331334 + 3600 + 3600 + 3600,
////							color: 'blue',
////							label: 'Last hour',
////						),
////					],
//					formatter: Formatter::timestamp(),
//				),
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
    
    {{--    @dd(App\Models\Data::getLastTwentyFourHours(App\SensorDataTypes::TEMPERATURE))--}}
</div>
