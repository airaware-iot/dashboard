<?php

namespace App\Http\Controllers;

use App\Exceptions\DataStoringException;
use App\Exceptions\InvalidTopicException;
use App\Exceptions\InvalidValueException;
use App\Services\DataStorageService;
use Illuminate\Http\Request;

class DataController extends Controller
{
	public function __invoke(Request $request)
	{
		try {
			DataStorageService::store($request);
		}
		catch (InvalidTopicException $topic) {
			return response("Invalid topic: {$topic->getMessage()}", 400)
				->header('Content-Type', 'text/plain');
		}
		catch (InvalidValueException $value) {
			return response("Invalid value: {$value->getMessage()}", 400)
				->header('Content-Type', 'text/plain');
		}
		catch (DataStoringException) {
			return response('There was an issue trying to store the request', 400)
				->header('Content-Type', 'text/plain');
		}

		return response('Successfully stored data in database')
			->header('Content-Type','text/plain');

	}
}
