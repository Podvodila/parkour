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
use App\Rules\NoVideo;

class ProfileController extends Controller
{

	public function showEditPage()
    {
    	return view('profileEdit', ['user' => Auth::user(), 'allTricks' => Trick::all(), 'videos' => User::find(Auth::id())->videos()->get()]);
    }

    public function addAvatar(Request $request)
    {
    	$this->validate($request, [
    		'avatar' => 'required|image|max:2048',
    	]);

    	$avatar = $request->file('avatar');
    	$filename = 'users/' . Auth::id() . '/' . 'avatar.jpg';
    	if($avatar) {
    		Storage::disk('local')->put($filename, File::get($avatar));
    	}

    	return redirect()->route('site.profileEdit');
    }

    public function removeAvatar()
    {
    	$filename = 'users/' . Auth::id() . '/avatar.jpg';
    	if(Storage::disk('local')->has($filename)) {
    		Storage::disk('local')->delete($filename);
    	}

    	return redirect()->route('site.profileEdit');
    }

    public function addMove(Request $request)
    {
    	$user = User::find(Auth::id());
    	foreach ($user->tricks as $trick) {
    		if($trick->id == $request->input('move')) {
    			return redirect()->back();
    		}
    	}
    	$user->tricks()->attach($request->input('move'));
    	return redirect()->back();
    }

    public function removeMove(Request $request)
    {
    	$this->validate($request, [
    		'move' => new NoVideo,
    	]);
    	$user = User::find(Auth::id());
    	$user->tricks()->detach($request->input('move'));
    	return redirect()->back();
    }

    public function addMoveVideo(Request $request)
    {
    	$this->validate($request, [
    		'video' => 'mimes:flv,mp4,mpeg,mov,avi,wmv | max:20000',
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

    	return redirect()->back();
    }

    public function removeMoveVideo(Request $request)
    {
    	$video = $request->input('video');
    	$video = json_decode($video);
    	if($video->user_id == Auth::id()) {
    		Video::find($video->id)->delete();
    		Storage::disk('local')->delete($video->path);
    	}

    	return redirect()->back();
    }

    public function addTrainingVideo() // from youtube
    {
    	
    }

    public function removeTrainingVideo()
    {
    	
    }

    // SHOW

    public function showPage($user)
    {
    	return view('profile', ['user' => $this->getUser($user), 'videos' => $this->getUserVideos($user), 'tricks' => $this->getUserTricks($user), 'avatar' => $this->getAvatar($user)]);
    }


    public function getAvatar($user_id) 
    {
    	$avatar = Storage::disk('local')->url('users/' . $user_id . '/avatar.jpg');
    	return $avatar;
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
