<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    

    <!-- Fonts -->

    <!-- Styles -->
    
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
	<!-- <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('css/custom.app.css') }}" rel="stylesheet">
    <script>
    	window.Laravel = {
    		csrf: '{{ csrf_token() }}'
    	}
    </script>
</head>
<body>
    <!-- <nav class="main-nav-container">
    	<div class="main-nav">
			<h1 class="nav-logo">parkour</h1>
	    	<ul class="custom-navbar">
	            @guest
	                <li><a class="nav-link" href="{{ route('login') }}">@lang('login.login')</a></li>
	            @else
	                <li>
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            @lang('login.logout')
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
	                </li>
	            @endguest
	        </ul>
        </div>
    </nav> -->
    <main class="main-content">
        @yield('content')
    </main>
    <footer>
    	
    </footer>
    @yield('scripts')
</body>
</html>

<style>
    html {
        overflow-x: hidden;
        margin-right: calc(-1 * (100vw - 100%));
    }

    .main-content {
        max-width: 1265px;
        padding: 0px 45px 0px 20px;
        margin: 0px auto;
    }

    a[href="http://leafletjs.com"] {
        display: none;
    }
    
    video::-webkit-media-controls {
      display: none !important;
    }

    video::-webkit-media-controls-enclosure {
      display: none !important;
    }

    video::-webkit-media-controls-overlay-enclosure {
      display: none !important;
    }

    video:-webkit-full-screen {
        z-index: 1 !important;
    }
</style>