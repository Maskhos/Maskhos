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

class AuthController extends Controller
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
  public function __construct()
  {
    $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
      'usname' => 'required|max:255',
      'usdesc' => 'max:255',
      'usbirthDate' => 'required',
      'email' => 'required|email|max:255|unique:users',
      'password' => 'required|min:8|confirmed',
    ]);
  }

  /**
  * Create a new user instance after a valid registration.
  *
  * @param  array  $data
  * @return User
  */
  // protected function create(array $data)
  // {
  // return User::create([
  // 'usname' => $data['usname'],
  // 'email' => $data['email'],
  // 'usbirthDate' => $data['usbirthDate'],
  // 'faction_id' => $data['faction'],
  // 'country_id' => $data['country'],
  // 'usdesc' => $data['usdesc'],
  // 'password' => bcrypt($data['password']),
  // ]);
  // }

  /**
  * Create a new user instance after a valid registration.
  *
  * @param  array  $data
  * @return User
  */
  protected function create(array $data)
  {
    $url = env('API_URL', true).'/user';
    $client = new Client([
      'base_uri' => $url,
      // You can set any number of default request options.
      'timeout'  => 10.0]);
      $data_user = array('usbirthDate'=> $data['usbirthDate'], 'usname' => $data['usname'], 'email' => $data['email'],'password' => bcrypt($data['password']), 'faction_id' => $data['faction'], 'country_id' => $data['country'], 'usdesc' => $data['usdesc']);
      $response = $client->request('POST', $url, [
        'form_params' => $data_user
      ]);
      $code = $response->getStatusCode(); // 200
      $reason = $response->getReasonPhrase(); // OK
      // echo $code;
      // Implicitly cast the body to a string and echo it
      // var_dump($contenido);
      if($code==201)
      {
        $contenido = json_decode($response->getBody())->data;
        var_dump($contenido);
        $user = new User();
        $user->usname = $contenido->usname;
        $user->email = $contenido->email;
        $user->id = $contenido->id;
        $user->password = $contenido->password;
        $user->faction_id = $contenido->faction_id;
        $user->country_id = $contenido->country_id;
        $user->usbirthDate = $contenido->usbirthDate;
        $user->usdesc = $contenido->usdesc;
        return $user;
      }else{
        $user = new User();
        $user->usname= "";
        $user->email = "";
        $user->id = "";
        $user->password = "";
        $user->faction_id = "";
        $user->country_id = "";
        $user->usbirthDate = "";
        $user->usdesc = "";
        return $user ;
      }
    }
    public function getRegister()
    {
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
    $code1 = $response1->getStatusCode(); // 200
    $code2 = $response2->getStatusCode(); // 200
    // Implicitly cast the body to a string and echo it
    if($code1 ==200 && $code2 ==200 ){
      $factions = json_decode($response1->getBody());
      $countrys = json_decode($response2->getBody());
      $data = [
        'factions' => $factions->data,
        'countrys' => $countrys->data,
      ];
      $view =  view('auth.register')->with('data',$data);
    } else {
      //echo $code1;
      $view =  view ('errors.503');
    }
    return $view;

  }


}
