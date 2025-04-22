<?php

namespace App\Exceptions;

use Exception;

class InvalidTopicException extends Exception
{
    public function __construct(string $topic)
	{
		parent::__construct($topic);
	}
}
