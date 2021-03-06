<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\User;
use App\Trick;
use App\Video;
use App\Spot;
use App\Rules\NoVideo;
use Intervention\Image\Facades\Image as ImageInt;

class ProfileController extends Controller
{

	public function showEditPage()
    {
        $user = Auth::user();
    	return view('profileEdit', [
            'user' => $user, 
            'allTricks' => Trick::all(), 
            'videos' => $this->getUserVideos($user->id), 
            'tricks' => $this->getUserTricks($user->id), 
            'avatar' => $this->getAvatar($user->id),
            'spots' => Spot::all(),
        ]);
    }

    public function addAvatar(Request $request)
    {
    	$this->validate($request, [
    		'avatar' => 'required|image|max:2048',
    	]);

        $user_id = Auth::id();

        if(!Storage::disk('local')->exists('users/' . $user_id . '/avatar/')) {
            Storage::disk('local')->makeDirectory('users/' . $user_id . '/avatar/');
        }
        $path = public_path(Storage::disk('local')->url('users/' . $user_id . '/avatar/'));
        $pathForModel = Storage::disk('local')->url('users/' . $user_id . '/avatar/');
    	$avatar = $request->file('avatar');
    	if($avatar) {
            $fullsizeName = 'full.jpg';
            $smallsizeName = 'small.jpg';
    		ImageInt::make($avatar)->resize(1920,1080, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($path . $fullsizeName);
            ImageInt::make($avatar)->fit(60,60)->save($path . $smallsizeName, 100);
            $user = User::find($user_id);
            $user->avatar = $pathForModel . $fullsizeName;
            $user->thumbnail = $pathForModel . $smallsizeName;
            $user->save();
    	}

    	return response()->json($this->getAvatar(Auth::id()));
    }

    public function removeAvatar()
    {
        $user_id = Auth::id();
    	$full = 'users/' . $user_id . '/avatar/full.jpg';
        $small = 'users/' . $user_id . '/avatar/small.jpg';
    	if(Storage::disk('local')->has($full)) {
    		Storage::disk('local')->delete([$full, $small]);
            $user = User::find(Auth::id());
            $user->avatar = null;
            $user->thumbnail = null;
            $user->save();
    	}

    	return response()->json('delete success');
    }

    public function addMove(Request $request)
    {
    	$user = User::find(Auth::id());
    	foreach ($user->tricks as $trick) {
    		if($trick->id == $request->input('move')) {
    			return response()->json('Move already added');
    		}
    	}
    	$user->tricks()->attach($request->input('move'));
    	return response()->json('successfully added');
    }

    public function removeMove(Request $request)
    {
    	$this->validate($request, [
    		'move' => new NoVideo,
    	]);
    	$user = User::find(Auth::id());
    	$user->tricks()->detach($request->input('move'));
    	return response()->json($this->getUserTricks(Auth::id()));
    }

    public function addMoveVideo(Request $request)
    {
    	$this->validate($request, [
    		'video' => 'mimes:flv,mp4,mpeg,mov,avi,wmv,bin,3gp | max:30000',
    		'move' => 'integer',
    	]);
    	$video = $request->file('video');
    	$filename = 'users/' . Auth::id() . '/video/moves/' . $request->input('move') . '/' . time() . '.mp4';
    	if($video) {
    		Storage::disk('local')->put($filename, File::get($video));
    		Video::create([
    			'user_id' => Auth::id(),
    			'trick_id' => $request->input('move'),
    			'path' => Storage::disk('local')->url($filename),
    		]);
    	}

    	return response()->json($this->getUserVideos(Auth::id()));
    }

    public function removeMoveVideo(Request $request)
    {
    	$video = $request->input('video');
    	$video = json_decode($video);
    	if($video->user_id == Auth::id()) {
    		Video::find($video->id)->delete();
    		Storage::disk('local')->delete(str_replace('/storage', '', $video->path));
    	}

    	return response()->json($this->getUserVideos(Auth::id()));
    }

    public function setSocial(Request $request)
    {
        $this->validate($request, [
            'facebook' => 'string|max:190',
            'instagram' => 'string|max:190',
        ]);

        $user = User::findOrFail(Auth::id());

        if($request->input('facebook')) {
            $input = $request->input('facebook');
            $facebook = 'https://facebook.com/' . $input;
            $response = 'Saved';
            if($input == 'remove') {
                $facebook = '';
                $response = 'removed';
            }
            $user->facebook = $facebook;
            $user->save();
        }

        if($request->input('instagram')) {
            $input = $request->input('instagram');
            $instagram = 'https://instagram.com/' . $input;
            $response = 'Saved';
            if($input == 'remove') {
                $instagram = '';
                $response = 'removed';
            }
            $user->instagram = $instagram;
            $user->save();
        }

        return response()->json($response);
    }

    public function addSpotToVideo(Request $request)
    {
        $this->validate($request, [
            'video_id' => 'integer',
            'spot_id' => 'integer',
        ]);
        $video = Video::findOrFail($request->input('video_id'));
        $video->spot_id = $request->input('spot_id');
        $video->save();
        $spot = Spot::findOrFail($request->input('spot_id'));
        if(!count($spot->tricks()->where('id', $video->trick_id)->get())) {
            $spot->tricks()->attach($video->trick_id);
        }
        
        return response()->json($this->getUserVideos(Auth::id()));
    }

    public function removeSpotFromVideo(Request $request)
    {
        $video = Video::findOrFail($request->input('video_id'));
        if($video->user_id != Auth::id()) abort(403);
        $video->spot_id = null;
        $video->save();

        return response()->json($this->getUserVideos(Auth::id()));
    }

    // SHOW

    public function showPage($user)
    {
    	return view('profile', ['user' => $this->getUser($user), 'videos' => $this->getUserVideos($user), 'tricks' => $this->getUserTricks($user), 'avatar' => $this->getAvatar($user)]);
    }


    public function getAvatar($user_id) 
    {
        $exist = Storage::disk('local')->exists('users/' . $user_id . '/avatar/full.jpg');
    	return ['url' => User::find($user_id)->avatar, 'exist' => $exist];
    }

    public function getUser($user_id)
    {
        // return response()->json(User::find($user_id));
        return User::find($user_id);
    }

    public function getUserTricks($user_id)
    {
        return User::find($user_id)->tricks()->latest()->get();
    }

    public function getUserVideos($user_id)
    {
        return User::findOrFail($user_id)->videos()->latest()->get();
    }
}
