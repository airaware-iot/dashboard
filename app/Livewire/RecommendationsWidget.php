<?php

namespace App\Livewire;

use App\Enums\SensorDataType;
use Livewire\Component;

class RecommendationsWidget extends Component
{
	public array $recommendations;
	public int $recommendationsWithoutNoDataMessages;
	public string $airQualityRating;

	public function mount(): void
	{
		$this->update();
	}

	public function update(): void
	{
		$this->setRecommendations();
		$this->setRating();
	}

    public function render()
    {
        return view('livewire.recommendations-widget');
    }

	protected function setRecommendations(): void
	{
		$recommendations = [];

		foreach(SensorDataType::cases() as $dataType) {
			$value = $dataType->getLatest();
			$limits = $dataType->getSpecsAsSimpleArray();

			if(! $limits) {
				continue;
			}
			else if($value == '? ') { // No recent data found
				$recommendations[] =
					'<span class="text-complementary">Žádná aktuální data pro <b class="font-semibold">'
					. strtolower($dataType->getLabel()) . '</b></span>. Zkuste chvíli počkat nebo zkontrolujte, 
					zda není zapotřebí vyměnit baterie u senzoru.';

			}
			else if($value > $limits['limit_high'] && isset($dataType->getRecommendationMessage()['max'])) {
				$msg = $dataType->getRecommendationMessage()['max'];
				$recommendations[] = str_replace('SETDATA', "$value{$dataType->getUnit()}", $msg);
			}
			else if($value < $limits['limit_low'] && isset($dataType->getRecommendationMessage()['min'])) {
				$msg = $dataType->getRecommendationMessage()['min'];
				$recommendations[] = str_replace('SETDATA', "$value{$dataType->getUnit()}", $msg);
			}
		}

		$this->recommendations = $recommendations;
	}

	protected function setRating(): void
	{
		$recommendationsWithoutNoDataMessages = array_filter($this->recommendations, function ($recommendation) {
			return ! str_contains($recommendation, 'Žádná aktuální data');
		});

		$this->recommendationsWithoutNoDataMessages = count($recommendationsWithoutNoDataMessages);

		$this->airQualityRating = match(count($recommendationsWithoutNoDataMessages)) {
			0 => 'perfektní',
			1 => 'skvělý',
			2 => 'dobrý',
			3 => 'průměrný',
			4 => 'špatný',
			5 => 'zdraví nebezpečný',
			default => 'neznámý'
		};
	}

}
