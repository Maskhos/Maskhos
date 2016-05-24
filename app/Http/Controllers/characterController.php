<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class characterController extends Controller
{
    public function index(){

    	$url = env('API_URL', true);
    	try {
			$content = file_get_contents($url.'/character');
			$character = json_decode($content);
			if ($character->status=="ok"){
				$data = [
					'character' => $character->data,
						
				];
				return view('characters.index')->with('data',$data);
			}
			else {
				return view("errors.503");
			}
		} catch (Exception $e){
				return view("errors.503");
		}
    }
	
	public function show($id) {
		$url = env('API_URL', true);
    	try {
			$content = file_get_contents($url.'/character/'.$id);
			$character = json_decode($content);
			
			$content = file_get_contents($url.'/faction/'.$character->data[0]->faction_id);
			$faction = json_decode($content);
			
			if ($character->status=="ok"){
				$data = [
					'character' => $character->data,
					'faction' => $faction->data,			
				];
				return view('characters.show')->with('data', $data);
			}
			else {
				return view("errors.503");
			}
		} catch (Exception $e){
				return view("errors.503");
		}
	}
	
	//estas funciones son para mostrar contenido estático cuando no se disponía de servidor para sacar datos
	public function manual() {
		return view("characters.nobbdd");
	}
	
	public function manualshow() {
		return view("characters.showno");
	}
}

