@extends('main')

@php
  $routesHeader = [
      'login' => route('login'), 
      'logout' => route('logout'), 
      'profile' => route('site.profileEdit'), 
      'find' => route('site.mapFind'),
      'changeLocale' => route('site.changeLocale'),
      'spotAdd' => route('site.spotAdd'),
      'home' => route('site.index'),
    ];
@endphp

@section('content')
<div id="app">
    <HeaderApp :routes="{{json_encode($routesHeader)}}" auth="{{auth()->guard()->check()}}" :src_local="{{ json_encode(__('header')) }}"></HeaderApp>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('reset.Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('reset.E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('reset.Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<style>
    * {
        font-family: 'Nunito', 'Arial';
    }

    .container {
        margin-top: 84px;
    }

    .card-body {
        padding: 1.25rem;
    }

    .btn-primary {
        white-space: normal;
    }
</style>
<script src="{{ asset('js/app.js') }}" defer></script>

@endsection
