<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client;
use Auth;
class characterController extends Controller
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
    $response1 = $client->request('GET', 'character');
    $code1 = $response1->getStatusCode(); // 200
    // Implicitly cast the body to a string and echo it
    if($code1 ==200 ){
      $character = json_decode($response1->getBody());
      $data = [
        'character' => $character->data,
      ];
      $view =  view('characters.index')->with('data',$data);
    }else {
      $view =  view("errors.404");
    }


  } catch (Exception $e){
    $view = view("errors.503");
  }
  return $view;
}

public function show($id) {
  $url = env('API_URL', true);
  try {
    $error = false;
    $view = null;
    $client = new Client(['base_uri' => $url,
    'exceptions'=>false
  ]);
  // Send a request to https://foo.com/api/test
  $response1 = $client->request('GET', 'character/'.$id);
  $code1 = $response1->getStatusCode(); // 200
  $response2 = $client->request('GET', 'character');
  $code2 = $response1->getStatusCode(); // 200
  // Implicitly cast the body to a string and echo it
  if($code1 ==200 && $code2 == 200 ){
    $character = json_decode($response1->getBody());
    $all = json_decode($response2->getBody());
    $response3 = $client->request('GET', 'faction/'.$character->data[0]->faction_id);
    $code3 = $response3->getStatusCode(); // 200
    if($code3 ==200){

      $faction = json_decode($response3->getBody());
      $data = [
        'character' => $character->data,
        'faction' => $faction->data,
        'all' => $all->data,
      ];
      $view =  view('characters.show')->with('data', $data);

    }else {
      $view =  view("errors.404");
    }
  }else{
    $view =  view("errors.404");
  }
} catch (Exception $e){
  $view =  view("errors.503");
}

return $view;
}

//estas funciones son para mostrar contenido estático cuando no se disponía de servidor para sacar datos
public function manual() {
  return view("characters.nobbdd");
}

public function manualshow() {
  return view("characters.showno");
}
}
