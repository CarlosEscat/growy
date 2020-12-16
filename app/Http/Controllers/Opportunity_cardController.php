<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Config;
use App\Category; 
use App\User_collection; 
use App\Product; 
use App\Skill; 
use App\User;  
use App\Opportunity_card_field; 
use Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Opportunity_card;
use App\User_collection_item;
use App\Opentowork_card;

class Opportunity_cardController extends Controller
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
    public function get($card_id)
    {
		$opc  = Opportunity_card::find($card_id);

		if($opc === null) {
			abort(404);
		}
		$third_person = true;
		if(Auth::guard('user')->user() && Auth::guard('user')->user()->id){
			$logged_in_user_id = Auth::guard('user')->user()->id;
			if($logged_in_user_id == $opc->user_id) $third_person = false;
		}
		
		 
		$user_id = Auth::guard('user')->user()->id;
		$countries = Config::get('countries');
		$opc_fields_json = $opc->fields;
		$opc_fields = [];
		
		if (trim($opc_fields_json) != '') {
			$opc_fields = json_decode($opc_fields_json,true);
		}
		
		$meta_title = $opc->company.' '.$opc->title;
		
		//checking the card is in the collections
		$user_collections = User_collection::where('user_id',$user_id)->get();
		
		$checked_value = [];
		foreach($user_collections as $uc) {
			$itemList = User_collection_item::where('collection_id',$uc->id)->where('opportunity_card_id',$card_id)->pluck('opportunity_card_id')->toArray();
			
			if(count($itemList) > 0){
				array_push($checked_value, $uc->id);
			}
		}

		return view('opportunity_card',[
			'countries' => $countries,
			'opc_fields' => $opc_fields,
			'meta_title' => $meta_title,
			'opc' => $opc,
			'checked_value' => $checked_value,
			'third_person'=> $third_person,
			'opportunity_card_page' => true
		]);
	}

    public function create()
    {

		$countries = Config::get('countries');
		$opc_fields = Opportunity_card_field::orderBy('name','asc')->pluck('name')->toArray();
		$opc = [];
		return view('opportunity_create',[
			'countries' => $countries,
			'opc_fields' => $opc_fields,
			'opc' => $opc,
			'opportunity_card_page' => true
		]);
	}

    public function update($card_id)
    {
		$opc  = Opportunity_card::find($card_id);
		
		if($opc === null) {
			abort(404);
		}
		
		$countries = Config::get('countries');
		$opc_fields_json = $opc->fields;
		$opc_fields = [];
		
		if (trim($opc_fields_json) != '') {
			$opc_fields = json_decode($opc_fields_json,true);
		}
		
		$meta_title = $opc->company.' '.$opc->title;
		$opc_fields_all = Opportunity_card_field::orderBy('name','asc')->pluck('name')->toArray();

		return view('opportunity_create',[
			'countries' => $countries,
			'opc_fields' => $opc_fields_all,
			'opc_fields_db' => $opc_fields,
			'meta_title' => $meta_title,
			'opc' => $opc,
			'id' => $card_id,
			'opportunity_card_page' => true
		]);
	}	
    public function referCreate($card_id)
    {
		$opc  = Opentowork_card::find($card_id);
		
		if($opc === null) {
			abort(404);
		}
		
		$countries = Config::get('countries');
		$opc_fields_json = $opc->fields;
		$opc_fields = [];
		
		if (trim($opc_fields_json) != '') {
			$opc_fields = json_decode($opc_fields_json,true);
		}
		
		$meta_title = $opc->company.' '.$opc->title;
		$opc_fields_all = Opportunity_card_field::orderBy('name','asc')->pluck('name')->toArray();
		$opc->title = '';
		$opc->description = '';
		return view('opportunity_create',[
			'countries' => $countries,
			'opc_fields' => $opc_fields_all,
			'opc_fields_db' => $opc_fields,
			'meta_title' => $meta_title,
			'opc' => $opc,
			'refer' => 1,
			'opportunity_card_page' => true
		]);
	}	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
    */
}