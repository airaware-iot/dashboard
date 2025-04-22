<?php

namespace App\Services;

use App\Exceptions\DataStoringException;
use App\Exceptions\InvalidTopicException;
use App\Exceptions\InvalidValueException;
use App\Models\Data;
use App\SensorDataType;
use Illuminate\Http\Request;
use Log;
use Throwable;

class DataStorageService
{
	/**
	 * @throws InvalidTopicException
	 * @throws InvalidValueException
	 * @throws DataStoringException
	 */
	public static function store(Request $request): void
	{
		if(! $request->getContent()) {
			throw new DataStoringException();
		}

		$data = json_decode($request->getContent(), true);

		$topic = last(explode('/', $data['topic']));
		$value = base64_decode($data['value']);

		Log::info("Received message from topic $topic, value = $value");


		if(! in_array($topic, SensorDataType::getValuesArray())) {
			Log::info("Did not store invalid topic $topic");
			throw new InvalidTopicException($topic);
		}

		if(! is_numeric($value)) {
			Log::info("Did not store invalid value $value");
			throw new InvalidValueException($value);
		}

		try {
			\DB::transaction(function () use ($topic, $value) {
				Data::create([
					'type' => $topic,
					'data' => $value,
					'timestamp' => now()
				]);
			});
		}
		catch (Throwable) {
			Log::error("Failed to store $topic: $value into database - is the database working properly?");
			throw new DataStoringException();
		}

		Log::info('Successfully stored topic ' . $topic . ' of id: ' . Data::latest()->first()->id);
	}
}