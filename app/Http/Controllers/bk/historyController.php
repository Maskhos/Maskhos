<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class historyController extends Controller
{
    public function index(){

    	$url = env('API_URL', true);
		
		try{
			$content = file_get_contents($url.'/history');
			$history = json_decode($content);
			$content = file_get_contents($url.'/faction');
			$factions = json_decode($content);
			
			if($history->status == 'ok' && $factions->status == 'ok') {
				$data = [
					'history' => $history->data,
					'factions' => $factions->data,
				];
			}else {
				return view('errors.503');
			}
		return view('historys.index')->with('data',$data);
		}catch(Exception $e){
			return view('errors.503');
		}
		
		
    }
	
	public function nobbdd() {
		return view('historys.story_static');
	}
	
}
