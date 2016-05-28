<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use GuzzleHttp\Client;
use Auth;

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
class userController extends Controller
{

  public function show(Request $request, $id){
    try{

      $error = false;
      $url = env('API_URL', true);
      $view = null;
      $response1= null;
      $response2=null;
      $client = new Client(['base_uri' => $url,
      'exceptions'=>false
    ]);
    // Send a request to https://foo.com/api/test
    $response1 = $client->request('GET', 'faction');
    $response2 =  $client->request('GET', 'country');
    $response3 =  $client->request('GET', 'user/'.$id);
    $code1 = $response1->getStatusCode(); // 200
    $reason = $response1->getReasonPhrase();
    $code2 = $response2->getStatusCode(); // 200
    $code3 = $response2->getStatusCode(); // 200

    if ($code1 ==  200 &&  $code2 ==200 && $code3 == 200) {

      $factions = json_decode($response1->getBody());
      $countrys = json_decode($response2->getBody());
      $user = json_decode($response3->getBody());
      //echo $user->status;
      $data = [
        'factions' => $factions->data,
        'user' => $user->data[0],
        'countrys' => $countrys->data,
      ];
      $view =  view('auth.show')->with('data',$data);
    }else{
      $error = true;
    }


  }catch (\Exception $e){
    $error=true;
  }
  if($error){
    //echo $reason;
    $view = view ('errors.503');
  }
  return $view;
}
public function editUser()
{
  $error = false;
  try{

    $this->authorize('update', Auth::user());

    $url = env('API_URL', true);
    $view = null;
    $response1= null;
    $response2=null;
    $client = new Client(['base_uri' => $url,
    'exceptions'=>false
  ]);
  // Send a request to https://foo.com/api/test
  $response1 = $client->request('GET', 'faction');
  $response2 =  $client->request('GET', 'country');
  $response3 =  $client->request('GET', 'user/'.Auth::id());
  $code1 = $response1->getStatusCode(); // 200
  $reason = $response1->getReasonPhrase();
  $code2 = $response2->getStatusCode(); // 200
  $code3 = $response2->getStatusCode(); // 200

  if ($code1 ==  200 &&  $code2 ==200 && $code3 == 200) {

    $factions = json_decode($response1->getBody());
    $countrys = json_decode($response2->getBody());
    $user = json_decode($response3->getBody());
    //echo $user->status;
    $data = [
      'factions' => $factions->data,
      'user' => $user->data[0],
      'countrys' => $countrys->data,
    ];
    $view = view('auth.edit')->with('data',$data);
  }else{
    $error = true;
  }
}catch(\Illuminate\Auth\Access\AuthorizationException $e){
  $view = view ('errors.100');
}catch (\Exception $e){
  echo $e;
  $error=true;
  //echo $e;
}
if($error){
  //echo $reason;
  $view = view ('errors.503');
}
return $view;

}


protected function updateUser(Request $request)
{
  //$this->authorize('update', Auth::user());
  $view = null;
  $img = null;
  try{
    $this->authorize('isLogged', Auth::user());
    $url = env('API_URL', true) . "/user/" . Auth::id() ."/PATCH";
    $client = new Client([
      'base_uri' => $url,
      // You can set any number of default request options.
      'timeout'  => 10.0]);
      if($request->file("uspicture")){
        $img = Image::make($request->file("uspicture"));
        $img->encode("jpeg");
      }
      if($img !=null){


        $response = $client->request('POST', $url, [
          "multipart"=> [
            [
              'name'     => 'usname',
              'contents' => $request->usname
            ],
            [
              'name'     => 'uspicture',
              'filename' => 'uspicture',
              'contents' =>$img ,
            ],
            [
              'name'     => 'email',
              'contents' => $request->email
            ],
            [
              'name'     => 'usbirthDate',
              'contents' => $request->usbirthDate
            ],
            [
              'name'     => 'country_id',
              'contents' => $request->country
            ],
            [
              'name'     => 'usdesc',
              'contents' => $request->usdesc
            ],
            [
              'name'     => 'faction_id',
              'contents' => $request->faction
            ],
            [
              'name'     => 'ustwitter',
              'contents' => $request->ustwitter
            ],
            [
              'name'     => 'usfacebook',
              'contents' => $request->usfacebook
            ],
            [
              'name'     => 'usinstagram',
              'contents' => $request->usinstagram
            ],
            [
              'name'     => 'ustumblr',
              'contents' => $request->ustumblr
            ],

          ]
        ]);
        if($response->getStatusCode() == 200){
          $view = redirect("/");
        }else{
          $view = view('errors.404');
        }}else{
          $response = $client->request('POST', $url, [
            "multipart"=> [
              [
                'name'     => 'usname',
                'contents' => $request->usname
              ],

              [
                'name'     => 'email',
                'contents' => $request->email
              ],
              [
                'name'     => 'usbirthDate',
                'contents' => $request->usbirthDate
              ],
              [
                'name'     => 'country_id',
                'contents' => $request->country
              ],
              [
                'name'     => 'usdesc',
                'contents' => $request->usdesc
              ],
              [
                'name'     => 'faction_id',
                'contents' => $request->faction
              ],
              [
                'name'     => 'ustwitter',
                'contents' => $request->ustwitter
              ],
              [
                'name'     => 'usfacebook',
                'contents' => $request->usfacebook
              ],
              [
                'name'     => 'usinstagram',
                'contents' => $request->usinstagram
              ],
              [
                'name'     => 'ustumblr',
                'contents' => $request->ustumblr
              ],

            ]
          ]);
          if($response->getStatusCode() == 200){
            $view = redirect("/");
          }else{
            $view = view('errors.404');
          }
        }
      }catch(\Exception $e){
        echo $e;
        //$view = view('errors.503');
      }
      return $view;
    }
  }
