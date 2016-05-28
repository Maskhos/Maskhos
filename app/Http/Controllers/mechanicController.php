<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use GuzzleHttp\Client;
class mechanicController extends Controller
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
    $response1 = $client->request('GET', 'mechanic');

    $code1 = $response1->getStatusCode(); // 200
    // Implicitly cast the body to a string and echo it
    if($code1 ==200){
      $mechanics = json_decode($response1->getBody());

      $data = [
        'mechanics' => $mechanics->data,
      ];
    }else {
      $view =  view('errors.404');
    }
    $view =  view('mechanics.index')->with('data',$data);
  }catch(Exception $e){
    $view = view('errors.503');
  }
  return $view ;
}

public function nobbdd() {
  return view('mechanics.nobbdd');
}
}
