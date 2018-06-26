<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Trick;
use App\Spot;
use App\Image;
use App\Video;
use App\Comment;
use Intervention\Image\Facades\Image as ImageInt;

class SpotController extends Controller
{
	public function show($id)
	{
        $spot = Spot::find($id);
        $user = Auth::id();
		return view('spot', [
            'spot' => $spot, 
            'videos' => $this->getSpotVideos($id), 
            'images' => $this->getImages($id), 
            'user' => $user,
            'new_tricks' => $this->getNewTricks($id),
            'comments' => $this->getComments($id),
        ]);
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
        $image = Image::findOrFail($request->input('image_id'));
    	$filename = $image->path;
    	$checkName = explode('/', $filename);
    	if($checkName[3] != $id) {
    		abort(403);
    	}

        $shortName = "";

        for($i = 2; $i < count($checkName); $i++) {
            if($i != 2) {
                $shortName .= "/";
            }
            $shortName .= $checkName[$i];
        }
        

    	if(Storage::disk('local')->has($shortName)) {
    		Storage::disk('local')->delete($shortName);
            Image::where('path', $filename)->delete();
    	}

    	return response()->json($this->getImages($id));
    }

    public function addImages($id, Request $request)
    {
        $this->validate($request, [
            'image.*' => 'image|max:2048',
        ]);
    	$this->customAddImages($request);
        return response()->json($this->getImages($request->input('spot_id')));
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
    		'description' => 'string|max:750|nullable',
    	]);

    	$spot = Spot::find($id);
    	$spot->description = $request->input('description');
    	$spot->save();

    	return response()->json($spot->description);
    }

    public function removeMove($spot_id, Request $request)
    {
    	$spot = Spot::find($spot_id);
    	$spot->tricks()->detach($request->input('move'));
    	return response()->json(['attached_tricks' => $spot->tricks, 'new_tricks' => $this->getNewTricks($spot_id)]);
    }

    public function addMove($spot_id, Request $request)
    {
    	$this->customAddMoves($request, Spot::find($spot_id));
    	return response()->json(['attached_tricks' => Spot::find($spot_id)->tricks, 'new_tricks' => $this->getNewTricks($spot_id)]);
    }

    public function removeSpotFromVideo($id, Request $request)
    {
        $video = Video::findOrFail($request->input('video_id'));
        if($video->user_id != Auth::id()) abort(403);
        $video->spot_id = null;
        $video->save();

        return response()->json($this->getSpotVideos($id));
    }

    public function addComment($spot_id, Request $request)
    {
        $this->validate($request, [
            'text' => 'required|string',
        ]);

        Comment::create([
            'description' => $request->input('text'),
            'spot_id' => $spot_id,
            'user_id' => Auth::id(),
        ]);

        return response()->json($this->getComments($spot_id));
    }

    public function removeComment($spot_id, Request $request)
    {
        $comment_id = $request->input('comment_id');
        $comment = Comment::findOrFail($comment_id);
        if($comment->user_id != Auth::id()) abort(403);
        $comment->delete();

        return response()->json($this->getComments($spot_id));
    }

    private function getComments($spot_id)
    {
        $comments =  Comment::where('spot_id', $spot_id)->latest()->get();
        $commentsWithUsers = $comments->map(function ($item) {
            return $item->show();
        });

        return $commentsWithUsers;
    }

    private function customAddImages($request, $custom_spot_id = null) 
    {
        $spot_id = $request->input('spot_id') ? $request->input('spot_id') : $custom_spot_id;
    	if ($request->hasFile('image')) {
    		$time = time();
            if(!Storage::disk('local')->exists('spots/' . $spot_id . '/images/')) {
                Storage::disk('local')->makeDirectory('spots/' . $spot_id . '/images/');
            }
    		foreach ($request->file('image') as $image) {
                $key = $time++;
                $path = public_path(Storage::disk('local')->url('spots/' . $spot_id . '/images/'));
	    		$filename = $key . '.jpg';
	    		$img = ImageInt::make($image);
                $img->resize(1920,1080, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($path . $filename);
                Image::create([
                    'path' => Storage::disk('local')->url('spots/' . $spot_id . '/images/' . $key . '.jpg'),
                    'spot_id' => $spot_id,
                    'user_id' => Auth::id(),
                ]);
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

    public function getSpotVideos($spot_id)
    {
        return Spot::findOrFail($spot_id)->videos()->latest()->get();
    }

    private function getImages($spot_id)
    {
        return Image::where('spot_id', $spot_id)->get();
    }

    private function getNewTricks($spot_id)
    {
        $attachedTricks = [];
        $tricks = Spot::findOrFail($spot_id)->tricks;
        foreach ($tricks as $trick) {
            array_push($attachedTricks, $trick->id);
        }
        return Trick::whereNotIn('id', $attachedTricks)->get();
    }
}
