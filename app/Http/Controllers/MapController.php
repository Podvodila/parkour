<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;

class MapController extends Controller
{
    public function find()
    {
    	return view('find', ['spots' => Spot::all()]);
    }
}
