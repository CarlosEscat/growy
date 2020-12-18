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
		if(count($collections) == 0){
			$initial = ["Users", "Opportunities", "Open-to-work Cards"];		
			
			foreach($initial as $key){
				$Newcollection = new User_collection;
				$Newcollection->name = $key;
				$Newcollection->user_id = $user_id;
				$Newcollection->save();
			}
			$collections = User_collection::where('user_id',$user_id)->get();
						
		}
		$userLists = User::where('id',$user_id)->first();
		return view('collections.index',[
			'countries' => $countries,
			'collections' => $collections,
			'username' => $userLists->full_name
		]);
	}
    public function create()
    {
		if(!Auth::guard('user')->check()) {
			return redirect('/');
		}


		return view('collections.create',[
			'opc' => [],
		]);
	}
    public function update($id)
    {
		if(!Auth::guard('user')->check()) {
			return redirect('/');
		}
		$user_id = Auth::guard('user')->user()->id;

		$collections = User_collection::where('id',$id)->where('user_id',$user_id)->first();

		return view('collections.create',[
			'opc' => $collections,
			'id' => $id
		]);
	}
	
	
}