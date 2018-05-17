@extends('layouts.app')

@section('content')
	<div>
		<img src="{{ Storage::disk('local')->url($user->id . '/avatar.jpg') }}" alt="avatar" id="avatar">
		<div>{{ $user->first_name . ' ' . $user->last_name }}</div>
	</div>
	<div>
		<h3>Move list</h3>
		@foreach ($user->tricks as $trick)
			<h5>{{ $trick->name }}</h5>
	        @foreach ($videos->where('trick_id', $trick->id)->sortByDesc('created_at') as $video)
	        	<h6>Video of your move</h6>
	            <video src="{{ Storage::disk('local')->url($video->path) }}" controls width="300px"></video>
	        @endforeach
		@endforeach
	</div>
@endsection

<style>
    #avatar {
        max-width: 400px;
    }
</style>