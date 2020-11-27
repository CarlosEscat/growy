<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\User_collection; 
use App\User; 
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Auth;
use Config;
use Helpers;


class CollectionController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
		if(!Auth::guard('user')->check()) {
			return redirect('user/login');
		}
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(!Auth::guard('user')->check()) {
			return redirect('/');
		}
		$user_id = Auth::guard('user')->user()->id;
		$collections = User_collection::where('user_id',$user_id)->get();
		$countries = Config::get('countries');
		
		return view('collections.index',[
			'countries' => $countries,
			'collections' => $collections
		]);
	}
	
	
}