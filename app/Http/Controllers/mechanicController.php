<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class mechanicController extends Controller
{
    public function index(){

    	$url = env('API_URL', true);
		
		try{
			$content = file_get_contents($url.'/mechanic');
			$mechanics = json_decode($content);
			
			if($mechanics->status == 'ok') {
				$data = [
					'mechanics' => $mechanics->data,
				];
			}else {
				return view('errors.503');
			}
		return view('mechanics.index')->with('data',$data);
		}catch(Exception $e){
			return view('errors.503');
		}
		
		
    }
	
	public function nobbdd() {
		return view('mechanics.nobbdd');
	}
}
