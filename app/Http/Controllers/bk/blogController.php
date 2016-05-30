<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client;
use Auth;
class blogController extends Controller
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
    $response1 = $client->request('GET', 'post');
    $code1 = $response1->getStatusCode(); // 200

    if($code1==200){
      $data = [
        'post' => $posts->data,
      ];
    }else {
      $view =  view('errors.503');
    }
    $view =  view('blog.index')->with('data',$data);
  }catch(Exception $e){
    $view =  view('errors.503');
  }
  return $view;
}

protected function storeComment(Request $request){
  $url = env('API_URL', true) . "/comment";
  $client = new Client([
    'base_uri' => $url,
    // You can set any number of default request options.
    'timeout'  => 2.0]);

    $response = $client->request('POST', $url, [
      'form_params' => [
        'comcontent' => $request->comcontent,
        'post_id' =>$request->session()->get("postShowing"),
        'user_id' =>Auth::id(),
      ]

    ]);
    //  var_dump($request->comcontent);
    if($response->getStatusCode() == 201){
      return redirect('/blog'."/".$request->session()->get("postShowing"));
    }

  }
  protected function storeEditComment(Request $request){
    $url = env('API_URL', true) . "/comment/" . $request->session()->get("commentEdit");
    $client = new Client([
      'base_uri' => $url,
      // You can set any number of default request options.
      'timeout'  => 2.0]);
      $response = $client->request('PATCH', $url, [
        'form_params' => [
          'comcontent' => $request->comcontent,
        ]
      ]);
      echo $response->getStatusCode();
      if($response->getStatusCode() == 200){
        return redirect('/blog'."/".$request->session()->get("postShowing"));

      }else{

      }
    }
    protected function editComment(Request $request, $id, $comment){
      try{
        $url = env('API_URL', true);
        $request->session()->put('commentEdit', $comment);
        $content = file_get_contents($url.'/comment/'.$comment);
        $comments = json_decode($content);

        if($comments->status == 'ok') {
          $data = [

            'comments' => $comments->data[0],

          ];
        }else {
          return view('errors.503');
        }
        return view('blog.editComment')->with('data',$data);
      }catch(Exception $e){
        return view('errors.503');
      }

    }
    protected function show(Request $request , $id){
      $url = env('API_URL', true);

      try{
        $request->session()->put("postShowing", $id);
        $content = file_get_contents($url.'/post/'.$id);
        $post = json_decode($content);
        $content = file_get_contents($url.'/comment/show/'.$id);
        $comments = json_decode($content);


        $content = file_get_contents($url.'/user');
        $users = json_decode($content);

        if($post->status == 'ok') {
          $data = [
            'id' => $id,
            'post' => $post->data[0],
            'comments' => $comments->data,
            'users' => $users->data
          ];

        }else {
          return view('errors.503');
        }
        return view('blog.show')->with('data',$data);
      }catch(Exception $e){
        return view('errors.503');
      }

    }
  }
