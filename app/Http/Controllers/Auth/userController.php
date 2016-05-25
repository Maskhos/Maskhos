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

  public function editUser()
  {
    $url = env('API_URL', true);
    $content = file_get_contents($url.'/user/' . Auth::id() );
    $user = json_decode($content);
    $content = file_get_contents($url.'/faction');
    $factions = json_decode($content);
    $content = file_get_contents($url.'/country');
    $countrys = json_decode($content);

    if ($factions->status == 'ok' && $countrys->status == 'ok') {
      $data = [
        'factions' => $factions->data,
        'user' => $user->data[0],
        'countrys' => $countrys->data,
      ];
      return view('auth.edit')->with('data',$data);
    } else {
      //return view ('errors.503');
    }
  }


  protected function updateUser(Request $request)
  {

    $url = env('API_URL', true) . "/user/" . Auth::id() ."/PATCH";
    $client = new Client([
      'base_uri' => $url,
      // You can set any number of default request options.
      'timeout'  => 10.0]);
      $img = Image::make($request->file("uspicture"));
      $response = $client->request('POST', $url, [
        "multipart"=> [
          [
            'name'     => 'usname',
            'contents' => $request->usname
          ],
          [
            'name'     => 'uspicture',
            'filename' => 'uspicture',
            'contents' => $img->encode("jpeg"),
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
      echo $response->getStatusCode();
      var_dump($img);
      if($response->getStatusCode() == 200){
        return redirect("/");
      }else{
          
      }

    }

  }
