<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use GuzzleHttp\Client;
use App\Http\Requests;

class historyController extends Controller
{
  public function index(){

    $url = env('API_URL', true);
    try {
      $error = false;
      $view = null;
      $client = new Client(['base_uri' => $url,
      'exceptions'=>false
    ]);
    // Send a request to https://foo.com/api/test
    $response1 = $client->request('GET', 'history');

    $code1 = $response1->getStatusCode(); // 200
    $response2 = $client->request('GET', 'faction');

    $code2 = $response1->getStatusCode(); // 200

    // Implicitly cast the body to a string and echo it
    if($code1 ==200  && $code2 == 200){


      $history = json_decode($response1->getBody());
      $factions = json_decode($response2->getBody());

      $data = [
        'history' => $history->data,
        'factions' => $factions->data,
      ];
    }else {
      $view =  view('errors.503');
    }
    $view =  view('historys.index')->with('data',$data);
  }catch(Exception $e){
    // $view =  view('errors.503');
	echo $e;
  }
   return $view;


}
}
