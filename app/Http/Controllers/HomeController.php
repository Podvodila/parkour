<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Route;
use Cookie;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function changeLocale(Request $request)
    {
        $locale = json_decode($request->locale);
        if(!App::isLocale($locale)) {
            Route::dispatchToRoute(Request::create(url()->previous()));
            if(App::isLocale('en')) {
                App::setLocale('ru');
                Cookie::queue('locale', 'ru', 60 * 24 * 365);
            } else {
                App::setLocale('en');
                Cookie::queue('locale', 'en', 60 * 24 * 365);
            }

            $route = $this->getLocaleFileName(Route::currentRouteName());
            $response = [__('header'), __($route)];
            return response()->json($response);
        }
        return response()->json('Already setted');
    }

    private function getLocaleFileName($loc)
    {
        $locale = [
            'site.index' => 'home',
            'site.mapFind' => 'find',
            'site.spot' => 'spot',
            'site.profile' => 'profile',
            'site.spotEdit' => 'spotEdit',
            'site.spotAdd' => 'spotAdd',
            'site.profileEdit' => 'profileEdit',
            'register' => 'register',
            'login' => 'login',
            'password.request' => 'password',
        ];

        return $locale[$loc];
    }
}
