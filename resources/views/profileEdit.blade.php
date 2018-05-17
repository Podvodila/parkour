@extends('layouts.app')

@section('content')
<div>kek {{ $user->id }}</div>
<div>
    <span>
        @if (Storage::disk('local')->has('users/' . $user->id . '/avatar.jpg'))
            EDIT IMAGE
        @else
            ADD IMAGE
        @endif
    </span> 
    <form action="{{ route('profile.uploadImg') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="avatar">
        <input type="submit" value="send">
    </form>
    @if (Storage::disk('local')->has('users/' . $user->id . '/avatar.jpg'))
        <img src="{{ Storage::disk('local')->url('users/' . $user->id . '/avatar.jpg') }}" alt="avatar" id="avatar">
        <form action="{{ route('profile.removeImg') }}" method="POST">
            {{ csrf_field() }}
            <input type="submit" value="remove it">
        </form>
    @endif
</div>
<div>
    <span>YOUR MOVE LIST</span>
    @foreach ($user->tricks as $trick)
        <div>{{ $trick->name }}</div>
        <form action="{{ route('profile.removeMove') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $trick->id }}" name="move">
            <input type="submit" value="remove move">
            @if ($errors)
                @foreach ($errors->get('move') as $message)
                    <p>{{ $message }}</p>
                @endforeach
            @endif
        </form>
        <h3>Video of your move</h3>
        @foreach ($videos->where('trick_id', $trick->id)->sortByDesc('created_at') as $video)
            <video src="{{ Storage::disk('local')->url($video->path) }}" controls width="300px"></video>
            <form action="{{ route('profile.removeMoveVideo') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="video" value="{{ $video }}">
                <input type="submit" value="remove video">
            </form>
        @endforeach
        <form action="{{ route('profile.addMoveVideo') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <h6>Add move</h6>
            <input type="hidden" value="{{ $trick->id }}" name="move">
            <input type="file" name="video">
            @if ($errors)
                @foreach ($errors->get('video') as $message)
                    <p>{{ $message }}</p>
                @endforeach
            @endif
            <input type="submit" value="send">
        </form>
    @endforeach
    <form action="{{ route('profile.addMove') }}" method="POST">
        {{ csrf_field() }}
        <select name="move" id="move">
            @foreach ($allTricks as $trick)
                <option value="{{ $trick->id }}">{{ $trick->name }}</option>
            @endforeach
        </select>
        <input type="submit" value="add move">
    </form>
</div>
@endsection


<style>
    #avatar {
        max-width: 300px;
    }
</style>