<?php

namespace Illuminate\Auth;

//use Illuminate\Support\Str;
//use Illuminate\Contracts\Auth\UserProvider;
//use Illuminate\Database\ConnectionInterface;
//use Illuminate\Contracts\Hashing\Hasher as HasherContract;
//use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class DatabaseUserProvider implements UserProvider
{
  /**
  * The active database connection.
  *
  * @var \Illuminate\Database\ConnectionInterface
  */
  protected $conn;

  /**
  * The hasher implementation.
  *
  * @var \Illuminate\Contracts\Hashing\Hasher
  */
  protected $hasher;

  /**
  * The table containing the users.
  *
  * @var string
  */
  protected $table;

  /**
  * Create a new database user provider.
  *
  * @param  \Illuminate\Database\ConnectionInterface  $conn
  * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
  * @param  string  $table
  * @return void
  */
  public function __construct(ConnectionInterface $conn, HasherContract $hasher, $table)
  {
    $this->conn = $conn;
    $this->table = $table;
    $this->hasher = $hasher;
  }

  /**
  * Retrieve a user by their unique identifier.
  *
  * @param  mixed  $identifier
  * @return \Illuminate\Contracts\Auth\Authenticatable|null
  */

  public function retrieveById($identifier)
  {
    $contenido = file_get_contents("http://localhost/apiRest/public/user/". $identifier);

    $json = json_encode($user);
    if($json->status ==='ok'){
      return $this->getGenericUser($json->data[0]);
    }

    /**
    * Retrieve a user by their unique identifier and "remember me" token.
    *
    * @param  mixed  $identifier
    * @param  string  $token
    * @return \Illuminate\Contracts\Auth\Authenticatable|null
    */
    public function retrieveByToken($identifier, $token)
    {

      $contenido = file_get_contents("http://localhost/apiRest/public/user/". $identifier."/".$token);

      $json = json_encode($contenido);
      if($json->status ==='ok'){
        return $this->getGenericUser($json->data[0]);
      }

    }

    /**
    * Update the "remember me" token for the given user in storage.
    *
    * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
    * @param  string  $token
    * @return void
    */
    public function updateRememberToken(UserContract $user, $token)
    {
      $url = "http://localhost/apiRest/public/user/". $user->getAuthIdentifier() ."/".$token;
      //$data = array('key1' => 'value1', 'key2' => 'value2');

      // use key 'http' even if you send the request to https://...
      $options = array(
        'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($data)
        )
      );
      $context  = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      if ($result === FALSE) { /* Handle error */
        echo "error";
      }else{
        $json = json_encode($result);
        if($json->status ==='ok'){
          return $this->getGenericUser($json->data[0]);
        }
      }
    }

    /**
    * Retrieve a user by the given credentials.
    *
    * @param  array  $credentials
    * @return \Illuminate\Contracts\Auth\Authenticatable|null
    */
    public function retrieveByCredentials(array $credentials){
      $url = "http://localhost/apiRest/public/user/credentials";
      //$data = array('key1' => 'value1', 'key2' => 'value2');

      // use key 'http' even if you send the request to https://...
      $options = array(
        'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($credentials)
        )
      );
      $context  = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      if ($result === FALSE) { /* Handle error */
        echo "error";
      }else{
        $json = json_encode($result);
        if($json->status ==='ok'){
          return $this->getGenericUser($json->data[0]);
        }
      }


      // Now we are ready to execute the query to see if we have an user matching
      // the given credentials. If not, we will just return nulls and indicate
      // that there are no matching users for these given credential arrays.
      $user = $query->first();

      return $this->getGenericUser($user);
    }

    /**
    * Get the generic user.
    *
    * @param  mixed  $user
    * @return \Illuminate\Auth\GenericUser|null
    */
    protected function getGenericUser($user)
    {
      if ($user !== null) {
        return new GenericUser((array) $user);
      }
    }

    /**
    * Validate a user against the given credentials.
    *
    * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
    * @param  array  $credentials
    * @return bool
    */
    public function validateCredentials(UserContract $user, array $credentials)
    {
      $plain = $credentials['password'];

      return $this->hasher->check($plain, $user->getAuthPassword());
    }
  }
