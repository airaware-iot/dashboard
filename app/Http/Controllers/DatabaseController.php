<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function view() {
		$data = Data::simplePaginate(50);


		return view('app.database', compact('data'));
	}
}
