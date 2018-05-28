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
	public function show($id)
	{
		return view('spot', ['spot' => Spot::find($id), 'tricks' => Trick::all()]);
	}

    public function add()
    {
    	return view('spotAdd', ['tricks' => Trick::all()]);
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
    		'user_id' => Auth::id(),
    		'lat' => $this->getLat($location),
    		'lng' => $this->getLng($location),
    		'description' => $request->input('description'),
    	]);

    	$this->customAddMoves($request, $spot);
    	$this->customAddImages($request, $spot->id);

    	return redirect()->route('site.spot', ['id' => $spot->id]);
    }

    public function edit($id)
    {
    	return view('spotEdit', ['spot' => Spot::find($id), 'tricks' => Trick::all()]);
    }

    public function remove($id)
    {
    	$spot = Spot::find($id);
    	$spot->delete();

    	Storage::disk('local')->deleteDirectory('spots/' . $id);

    	return redirect()->route('site.index');
    }

    public function removeImage($id, Request $request)
    {
    	$filename = $request->input('path');
    	$checkName = explode('/', $filename);
    	if($checkName[1] != $id) {
    		abort(403);
    	}

    	if(Storage::disk('local')->has($filename)) {
    		Storage::disk('local')->delete($filename);
    	}

    	return redirect()->route('site.spotEdit', ['id' => $id]);
    }

    public function addImages($id, Request $request)
    {
    	$this->customAddImages($request, $id);

    	return redirect()->back();
    }

    public function editLocation($id, Request $request)
    {
    	$this->validate($request, [
    		'location' => 'required|string',
    	]);
    	$spot = Spot::find($id);
    	$latLng = $request->input('location');
    	$spot->lat = $this->getLat($latLng);
    	$spot->lng = $this->getLng($latLng);
    	$spot->save();

    	return redirect()->back();
    }

    public function editDescription($id, Request $request)
    {
    	$this->validate($request, [
    		'description' => 'required|string',
    	]);

    	$spot = Spot::find($id);
    	$spot->description = $request->input('description');
    	$spot->save();

    	return redirect()->back();
    }

    public function removeMove($spot_id, Request $request)
    {
    	$spot = Spot::find($spot_id);
    	$spot->tricks()->detach($request->input('move'));
    	return redirect()->back();
    }

    public function addMove($spot_id, Request $request)
    {
    	$this->customAddMoves($request, Spot::find($spot_id));
    	return redirect()->back();
    }

    private function customAddImages($request, $spot_id) 
    {
    	if ($request->hasFile('image')) {
    		$time = time();
    		foreach ($request->file('image') as $image) {
	    		$filename = 'spots/' . $spot_id . '/images/' . $time++ . '.jpg';
	    		Storage::disk('local')->put($filename, File::get($image));
	    	}
    	}
    }

    private function customAddMoves($request, $spot) 
    {
    	if($request->has('move')) {
    		foreach ($request->input('move') as $move) {
    			foreach ($spot->tricks as $trick) {
		    		if($trick->id == $move) {
		    			continue 2;
		    		}
		    	}
    			$spot->tricks()->attach($move);
    		}
    	}
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
