<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use GuzzleHttp\Client;
class indexController extends Controller
{
  protected function index(){
    try{
      $view = null;

      $url = env('API_URL', true);

      $error = false;
      $client = new Client(['base_uri' => $url,
      'exceptions'=>false
    ]);
    // Send a request to https://foo.com/api/test
    $response1 = $client->request('GET', 'history');
    $response2 = $client->request('GET', 'post/last/3');
    $code1 = $response1->getStatusCode(); // 200
    $code2 = $response2->getStatusCode(); // 200

    if($code1==200 && $code2 ==200){
      $story = json_decode($response1->getBody());
      $news = json_decode($response2->getBody());
      $data = [
        'story' => $story->data,
        'news' => $news->data,
      ];
    }else {
      //echo "NOPE";
      $view = view('errors.503');
    }
    $view =  view('welcome')->with('data',$data);


  }  catch(Exception $e){
    //  echo $e;
    $view =  view('errors.503');
  }
  return $view;
}
public function nobbdd() {
  return view('welcomeno');
}
}
