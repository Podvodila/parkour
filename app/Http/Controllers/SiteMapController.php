<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Spot;

class SiteMapController extends Controller
{
	public function index()
	{
		$users = User::all();
		$spots = Spot::all();
		return response()->view('sitemap', [
			'users' => $users,
			'spots' => $spots,
		])->header('Content-Type', 'text/xml');
	}
}