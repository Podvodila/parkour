<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.tag_code') }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', '{{ config('services.google_analytics.tag_code') }}');
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')"/>

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