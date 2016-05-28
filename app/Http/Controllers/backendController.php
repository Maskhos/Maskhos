<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
class backendController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Registration & Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users, as well as the
  | authentication of existing users. By default, this controller uses
  | a simple trait to add these behaviors. Why don't you explore it?
  |
  */

  use AuthenticatesAndRegistersUsers, ThrottlesLogins;
  /**
  * Where to redirect users after login / registration.
  *
  * @var string
  */
  protected $redirectTo = '/';

  /**
  * Create a new authentication controller instance.
  *
  * @return void
  */
  public function index(){
    try{
      $view = null;
      $this->authorize('update', Auth::user());
      $url = env('API_URL', true);

      $response1= null;
      $response2=null;
      $client = new Client(['base_uri' => $url,
      'exceptions'=>false
    ]);
    // Send a request to https://foo.com/api/test
    $response1 = $client->request('GET', 'post');
    $response2 = $client->request('GET', 'user');
    $code1 = $response1->getStatusCode(); // 200
    $code2 = $response2->getStatusCode(); // 200
    // Implicitly cast the body to a string and echo it
    if($code1 ==200 && $code2 == 200){

      $posts = json_decode($response1->getBody());
      $users = json_decode($response2->getBody());
      $data = [
        'post' => $posts->data,
        'user' => $users->data,
      ];
      $view =  view('backend.index')->with('data',$data);
    }else{
      $view =view('errors.404');
    }
  }catch(\Illuminate\Auth\Access\AuthorizationException $e){
    $view =view('errors.100');
  }catch(\Exception $e){
    echo $e;
    $view =view('errors.503');
  }
  return $view;

}
protected function deletepost( $id){

  try{
    $error = false;
    $view = null;
    $this->authorize('update', Auth::user());
    $url = env('API_URL', true);
    $client = new Client([
      'exceptions'=>false
    ]);

    $borrar =  $url .'post/'.$id;
    $response = $client->request('DELETE', $borrar);
    $code = $response->getStatusCode();
    if($code == 204){
      $view =  redirect('/backend');
    }
  }catch(\Illuminate\Auth\Access\AuthorizationException $e){
    $view = view ('errors.100');
  }catch(\Exception $e){
    echo $e;
    $view = view('errors.503');
  }
  return $view;
}
public function editpostview(Request $request,$id){

  try{
    $error = false;
    $view = null;
    $this->authorize('update', Auth::user());
    $request->session()->put("editingpost",$id);
    $url = env('API_URL', true);

    $response1= null;
    $response2=null;
    $client = new Client(['base_uri' => $url,
    'exceptions'=>false
  ]);
  // Send a request to https://foo.com/api/test
  $response1 = $client->request('GET', 'category');
  $response2 =  $client->request('GET', 'post/'.$id);
  $code1 = $response1->getStatusCode(); // 200
  $code2 = $response2->getStatusCode(); // 200
  // Implicitly cast the body to a string and echo it
  if($code1 ==200 && $code2 ==200 ){
    $category = json_decode($response1->getBody());

    $post = json_decode($response2->getBody());
    if($post->data[0]->user_id == Auth::id() || Auth::user()->ussuperadmin){
      $data = [
        'categorys' => $category->data,
        'post' => $post->data[0],
      ];
      $view =  view('backend.editpost')->with('data',$data);
    }else{
      $error = true;
    }
  }
}catch(\Illuminate\Auth\Access\AuthorizationException $e){
  $view = view ('errors.100');
}catch(\Exception $e){
  $error = true;
}

if($error ||$view == null){
  $view = view('errors.503');
  //  echo $error;
}
return $view;
}

public function createpostview (){
  try{
    $error = false;
    $view = null;
    $this->authorize('create', Auth::user());
    $url = env('API_URL', true);


    $content = file_get_contents($url.'/category');
    $category = json_decode($content);


    if($category->status == 'ok' ) {
      $data = [
        'categorys' => $category->data,


      ];
    }else {
      $error;
    }
    $view =  view('backend.createpost')->with('data',$data);

  }catch(\Illuminate\Auth\Access\AuthorizationException $e){
    $view = view ('errors.100');
  }catch (\Exception $e){
    echo $e;
    $error=true;
    //echo $e;
  }
  if($error){
    $view = view ('errors.503');
  }
  return $view;
}

protected function createPost(Request $request)
{
  $this->authorize('create', Auth::user());
  $data = $request->all();
  $url = env('API_URL', true).'/post';
  $client = new Client([
    'base_uri' => $url,
    // You can set any number of default request options.
    'timeout'  => 10.0]);
    if($request->file('posphoto') !=null){


      $img = Image::make($data['posphoto']);
      $response = $client->request('POST', $url,[
        "multipart"=> [
          [
            'name'     => 'postitle',
            'contents' => $data['postitle']
          ],
          [
            'name'     => 'posphoto',
            'filename' => $data['posphoto']->getPathName(),
            'contents' => $img->encode('jpeg')
          ],
          [
            'name'     => 'poscontent',
            'contents' => $data['poscontent']
          ],
          [
            'name'     => 'posshortdesc',
            'contents' => $data['posshortdesc']
          ],
          [
            'name'     => 'category_id',
            'contents' => $data['category']
          ],
          [
            'name'     => 'user_id',
            'contents' => Auth::id()
          ],

        ]
      ]);

      $code = $response->getStatusCode(); // 200
      $reason = $response->getReasonPhrase(); // OK
      // echo $code;
      // Implicitly cast the body to a string and echo it
      // var_dump($contenido);
      if($code==201)
      {
        // Implicitly cast the body to a string and echo it
        $contenido = json_decode($response->getBody())->data;
        return redirect('/');
      }else{
        return view("errors.404");
      }
    }else{
      return redirect('/backend/createpost');
    }
  }
  protected function editPost(Request $request)
  {
    $img = null;
    $this->authorize('isLogged', Auth::user());
    $data = $request->all();
    $url = env('API_URL', true).'/post/'.$request->session()->get("editingpost"). "/PATCH";
    $client = new Client([
      'base_uri' => $url,
      // You can set any number of default request options.
      'timeout'  => 10.0]);

      // SE HA PONER OTRA VEZ D.
      if($request->file('posphoto') !=null){
        $img = Image::make($request->file('posphoto'));
        $img->encode('jpeg');
      }
      if($img !=null){
        $response = $client->request('POST', $url,[
          "multipart"=> [
            [
              'name'     => 'postitle',
              'contents' => $data['postitle']
            ],
            [
              'name'     => 'posphoto',
              'filename' => $data['posphoto']->getPathName(),
              'contents' => $img
            ],
            [
              'name'     => 'poscontent',
              'contents' => $data['poscontent']
            ],
            [
              'name'     => 'posshortdesc',
              'contents' => $data['posshortdesc']
            ],
            [
              'name'     => 'category_id',
              'contents' => $data['category']
            ],
            [
              'name'     => 'user_id',
              'contents' =>Auth::id()
            ],
          ]
        ]);

        $code = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK
        // echo $code;
        // Implicitly cast the body to a string and echo it
        // var_dump($contenido);
        if($code==200)
        {
          // Implicitly cast the body to a string and echo it
          $contenido = json_decode($response->getBody())->data;
          return redirect('/');
        }else{
          return view("errors.index");
        }
      }else{
        $response = $client->request('POST', $url,[
          "multipart"=> [
            [
              'name'     => 'postitle',
              'contents' => $data['postitle']
            ],
            [
              'name'     => 'poscontent',
              'contents' => $data['poscontent']
            ],
            [
              'name'     => 'posshortdesc',
              'contents' => $data['posshortdesc']
            ],
            [
              'name'     => 'category_id',
              'contents' => $data['category']
            ],
            [
              'name'     => 'user_id',
              'contents' =>Auth::id()
            ],
          ]
        ]);

        $code = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK
        // echo $code;
        // Implicitly cast the body to a string and echo it
        // var_dump($contenido);
        if($code==200)
        {
          // Implicitly cast the body to a string and echo it
          $contenido = json_decode($response->getBody())->data;
          return redirect('/');
        }else{
          return view("errors.index");
        }
      }
    }



  }
