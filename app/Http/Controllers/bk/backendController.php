<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Intervention\Image\ImageManagerStatic as Image;

class backendController extends Controller
{
  public function editpostview($id){

    $url = env('API_URL', true);

    try{
      $content = file_get_contents($url.'/category');
      $category = json_decode($content);
      $content = file_get_contents($url.'/post/'.$id);
      $post = json_decode($content);


      if($category->status == 'ok'  && $post->status == 'ok') {
        $data = [
          'categorys' => $category->data,
          'post' => $post->data[0],
        ];
      }else {
        return view('errors.503');
      }
      return view('backend.editpost')->with('data',$data);

    }catch(Exception $e){
      return view('errors.503');
    }
  }
  public function createpostview (){

    $url = env('API_URL', true);

    try{
      $content = file_get_contents($url.'/category');
      $category = json_decode($content);


      if($category->status == 'ok' ) {
        $data = [
          'categorys' => $category->data,


        ];
      }else {
        return view('errors.503');
      }
      return view('backend.createpost')->with('data',$data);

    }catch(Exception $e){
      return view('errors.503');
    }

  }

  protected function createPost(Request $request)
  {
    $data = $request->all();
    $url = env('API_URL', true).'/post';
    $client = new Client([
      'base_uri' => $url,
      // You can set any number of default request options.
      'timeout'  => 10.0]);

      // SE HA PONER OTRA VEZ D.
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
            'contents' => $data['user_id']
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
        return view("errors.index");
      }
    }




  }
