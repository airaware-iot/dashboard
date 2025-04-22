<?php

namespace App\Exceptions;

use Exception;

class InvalidValueException extends Exception
{
    public function __construct(string $value)
	{
		parent::__construct($value);
	}
}
