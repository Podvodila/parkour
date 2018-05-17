<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Trick;
use App\Spot;

class SpotController extends Controller
{
    public function add()
    {
    	return view('spot', ['tricks' => Trick::all()]);
    }

    public function addPost(Request $request)
    {
    	$this->validate($request, [
    		'location' => 'required|string',
    		'image' => 'required_without_all:description',
    		'image.*' => 'image|max:2048',
    		'description' => 'required_without_all:image',
    		'move.*' => 'integer',
    	]);

    	$location = $request->input('location');
    	$spot = Spot::create([
    		'lat' => $this->getLat($location),
    		'lng' => $this->getLng($location),
    		'description' => $request->input('description'),
    	]);

    	if($request->has('move')) {
    		foreach ($request->input('move') as $move) {
    			$spot->tricks()->attach($move);
    		}
    	}

    	if ($request->hasFile('image')) {
    		$time = time();
    		foreach ($request->file('image') as $image) {
	    		$filename = 'spots/' . $spot->id . '/' . $time++ . '.jpg';

	    		Storage::disk('local')->put($filename, File::get($image));
	    	}
    	}

    	return redirect()->back();
    }

    private function getLat($location)
    {
    	return explode(' ', $location)[0];
    }

    private function getLng($location)
    {
    	return explode(' ', $location)[1];
    }
}
