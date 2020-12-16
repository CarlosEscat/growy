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
use App\Opportunity_card;
use App\Opportunity_card_field; 
use App\roles; 
use Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Opentowork_card;
use App\Endorse_list;


class OpentoworkController extends Controller
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
		$opc  = Opentowork_card::find($card_id);

		if($opc === null) {
			abort(404);
		}
		$third_person = true;
		if(Auth::guard('user')->user() && Auth::guard('user')->user()->id){
			$logged_in_user_id = Auth::guard('user')->user()->id;
			if($logged_in_user_id == $opc->user_id) $third_person = false;
		}
	
		$countries = Config::get('countries');

		$opc_fields_json = $opc->fields;
		$opc_fields = [];
		
		if (trim($opc_fields_json) != '') {
			$opc_fields = json_decode($opc_fields_json,true);
		}

		$opc_roles_json = $opc->roles;
		$opc_roles = [];
		
		if (trim($opc_roles_json) != '') {
			$opc_roles = json_decode($opc_roles_json,true);
		}
		$meta_title = $opc->title;

		//skill vs endorse
		$endorsed_users = [];
		foreach($opc_fields as $skill){
			$opSkill = Opportunity_card_field::where('name',$skill)->first();
			$itemList = Endorse_list::where('received_user_id', $opc->user_id)->where('skill_id', $opSkill->id)->pluck('given_user_id')->toArray();
			$endorsed_users[$skill] = $itemList;
		}



		return view('opentowork_card',[
			'countries' => $countries,
			'opc_fields' => $opc_fields,
			'opc_roles' => $opc_roles,
			'opc_endorse' => $endorsed_users,
			'meta_title' => $meta_title,
			'opc' => $opc,
			'logged_in_user_id'=> $logged_in_user_id,
			'third_person'=> $third_person,
			'opentowork_card_page' => true
		]);
	}

    public function create()
    {

		$countries = Config::get('countries');
		$opc_fields = Opportunity_card_field::orderBy('name','asc')->pluck('name')->toArray();
		$opc_roles = Roles::orderBy('name','asc')->pluck('name')->toArray();
		$opc = [];
		return view('opentowork_create',[
			'countries' => $countries,
			'opc_fields' => $opc_fields,
			'opc_roles' => $opc_roles,
			'opc' => $opc,
			'opentowork_card_page' => true
		]);
	}

    public function update($card_id)
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
		$opc_roles_all = Roles::orderBy('name','asc')->pluck('name')->toArray();

		$opc_roles_json = $opc->roles;
		$opc_roles = [];
		
		if (trim($opc_roles_json) != '') {
			$opc_roles = json_decode($opc_roles_json,true);
		}
		return view('opentowork_create',[
			'countries' => $countries,
			'opc_fields' => $opc_fields_all,
			'opc_fields_db' => $opc_fields,
			'meta_title' => $meta_title,
			'opc' => $opc,
			'id' => $card_id,
			'opc_roles' => $opc_roles_all,
			'opc_roles_db' => $opc_roles,
			'opentowork_card_page' => true
		]);
	}	
    public function referCreate($oppid)
    {
		$opc  = Opportunity_card::find($oppid);
		
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
		$opc_roles_all = Roles::orderBy('name','asc')->pluck('name')->toArray();

		$opc_roles_json = $opc->title;
		$opc_roles = [];
		
		if (trim($opc_roles_json) != '') {
			$opc_roles = json_decode($opc_roles_json,true);
		}
		$opc->description = '';
		return view('opentowork_create',[
			'countries' => $countries,
			'opc_fields' => $opc_fields_all,
			'opc_fields_db' => $opc_fields,
			'meta_title' => $meta_title,
			'opc' => $opc,
			'opc_roles' => $opc_roles_all,
			'opc_roles_db' => $opc_roles,
			'refer' => 1,
			'opentowork_card_page' => true
		]);
	}	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
    */
}