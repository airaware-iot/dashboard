<?php

namespace App\Services;

class ChartWidthService
{
	/**
	 * Tailwind defined breakpoints
	 * @var array|int[]
	 */
	protected array $breakpoints = [
		'sm' => 640,
		'md' => 768,
		'lg' => 1024,
		'xl' => 1280,
		'2xl' => 1536,
	];

	/**
	 * Outermost margin of the app
	 * @var array|int[]
	 */
	protected array $appMargin = [
		'default' => 8,
		'md' => 48
	];

	/**
	 * The grid container's gap when multiple columns are present
	 * @var array|int[]
	 */
	protected array $widgetGap = [
		'default' => 0,
		'md' => 24,
	];

	/**
	 * Padding for the chart widget itself
	 * @var array|int[]
	 */
	protected array $widgetPadding = [
		'default' => 24
	];

	/**
	 * How many columns the grid has
	 * @var array|string[]
	 */
	protected array $columnCount = [
		'md' => 2,
		'default' => 1,
	];

	/**
	 * Additional content taking up width, such as the recommendations widget
	 * @var array
	 */
	protected array $otherContent = [
		'md' => 300,
		'default' => 0,
	];

	public function __construct(
		public int $windowWidth,
	) {}

	public function getWidth(): int
	{
		return 0; //finish
	}
}