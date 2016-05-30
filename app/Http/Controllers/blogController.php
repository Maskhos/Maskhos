<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use GuzzleHttp\Client;
use Auth;
class blogController extends Controller
{

  protected function index(){
    $url = env('API_URL', true);
    try{
      $error = false;
      $view = null;
      $client = new Client(['base_uri' => $url,
      'exceptions'=>false
    ]);
    // Send a request to https://foo.com/api/test
    $response1 = $client->request('GET', 'post');
    $response2 =  $client->request('GET', 'user');
    $code1 = $response1->getStatusCode(); // 200
    $code2 = $response2->getStatusCode(); // 200
    // Implicitly cast the body to a string and echo it
    if($code1 ==200 && $code2 ==200 ){
      $posts = json_decode($response1->getBody());
      $user = json_decode($response2->getBody());

      $data = [
        'post' => $posts->data,
        'user' => $user->data,
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
protected function bycategory(Request $request, $id){
  try{
    $view = null;
    $url = env('API_URL', true);
    $error = false;
    $client = new Client(['base_uri' => $url,
    'exceptions'=>false
  ]);
  // Send a request to https://foo.com/api/test
  $response1 = $client->request('GET', 'post/category/'.$id);
  $code1 = $response1->getStatusCode(); // 200

  if($code1==200){
    $posts = json_decode($response1->getBody());
    $data = [
      'post' => $posts->data,
    ];
  }else {
    return view('errors.503');
  }
  return view('blog.index')->with('data',$data);
}catch(Exception $e){
  return view('errors.503');
}

}
protected function storeComment(Request $request){
  $view = null;
  try{
    $this->authorize('isLogged', Auth::user());

    $url = env('API_URL', true) . "comment";
    $client = new Client([
      'base_uri' => $url,
      // You can set any number of default request options.
      'timeout'  => 2.0]);
      //  var_dump($client);
      /*  $client->get( $url = env('API_URL', true). 'auth', [
      'auth' => ['aaaaaa@aaaa.com', '123456']
    ]);*/
    $response = $client->request('POST', $url,
    [
      //'auth' => [Auth::user()->email, bcrypt(Auth::user()->password)],
      'form_params' => [
        'comcontent' => $request->comcontent,
        'post_id' =>$request->session()->get("postShowing"),
        'user_id' =>Auth::id(),
      ],

    ]);
    //  var_dump($request->comcontent);
    if($response->getStatusCode() == 201){
      $view =  redirect('/blog'."/".$request->session()->get("postShowing"));
    }else{
      $view = view('errors.404');
    }
  }catch(\Exception $e){
    //echo $e;
    $view = view('errors.503');

  }
  return $view;

}
/**
* Get a validator for an incoming registration request.
*
* @param  array  $data
* @return \Illuminate\Contracts\Validation\Validator
*/
protected function validator(array $data)
{
  return Validator::make($data, [
    'comcontent' => 'required|max:255',
  ]);
}
protected function storeEditComment(Request $request){
  $view = null;
  try{
    $this->authorize('isLogged', Auth::user());
    $url = env('API_URL', true) . "comment/" . $request->session()->get("commentEdit");
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
        $view =  redirect('/blog'."/".$request->session()->get("postShowing"));
      }else{
        $view = view('errors.404');
      }
    }catch(\Exception $e){
      echo $e;
    //  $view = view('errors.503');
    }
    return $view;
  }
  protected function editComment(Request $request, $id, $comment){

    //$this->authorize('update', Auth::user());
    $url = env('API_URL', true);
    try{

      $request->session()->put('commentEdit', $comment);
      $error = false;
      $view = null;
      $client = new Client(['base_uri' => $url,
      'exceptions'=>false
    ]);
    // Send a request to https://foo.com/api/test
    $response1 = $client->request('GET', 'comment/'.$comment);
    $code1 = $response1->getStatusCode(); // 200
    // Implicitly cast the body to a string and echo it
    if($code1 ==200 ){
      $url = env('API_URL', true);
      $comments = json_decode($response1->getBody());
      if($comments->data[0]->user_id == Auth::id()){
        $data = [
          'comments' => $comments->data[0],
        ];
        $view =  view('blog.editComment')->with('data',$data);
      }else{
        $view =  view('errors.100');
      }
    }else {
      $view =  view('errors.503');
    }


  }catch(Exception $e){
    $view =  view('errors.503');
  }
  return $view;
}
protected function show(Request $request , $id){
  $url = env('API_URL', true);
  try{
    $request->session()->put("postShowing", $id);
    $error = false;
    $view = null;
    $client = new Client(['base_uri' => $url,
    'exceptions'=>false
  ]);
  // Send a request to https://foo.com/api/test
  $response1 = $client->request('GET', 'post/'.$id);
  $code1 = $response1->getStatusCode(); // 200
  $response2 = $client->request('GET', 'comment/show/'.$id);
  $code2 = $response1->getStatusCode(); // 200

  $response3 = $client->request('GET', 'user');
  $code3 = $response1->getStatusCode(); // 200
  // Implicitly cast the body to a string and echo it
  if($code1 ==200  && $code2 ==200 && $code3 ==200){
    $post= json_decode($response1->getBody());
    $comments = json_decode($response2->getBody());
    $users = json_decode($response3->getBody());
    if(count($comments)>0)
    {
      if($post->status == 'ok') {
        $data = [
          'id' => $id,
          'post' => $post->data[0],
        ];
      }else {
        $view =  view('errors.503');
      }
    }else{
      $data = [
        'id' => $id,
        'post' => $post->data[0],
        'comments' => $comments->data,
        'users' => $users->data
      ];
    }
    $view =  view('blog.show')->with('data',$data);
  }else{
    $view =  view('errors.404');
  }
}catch(\Exception $e){
  // echo $e;
  $view =  view('errors.503');
}
return $view;
}
}
