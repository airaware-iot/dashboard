<?php

namespace App\Models;

use App\DataTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    /** @use HasFactory<\Database\Factories\DataFactory> */
    use HasFactory;

	protected $fillable = ['type', 'data', 'timestamp'];

	protected $casts = [
		'type' => DataTypesEnum::class,
	];
}
