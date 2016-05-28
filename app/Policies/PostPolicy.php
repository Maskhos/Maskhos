<?php

namespace App\Policies;

use App\User;
use Auth();
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
  use HandlesAuthorization;


  /**
  * Determine if the given user can delete the given task.
  *
  * @param  User  $user
  * @param  Task  $task
  * @return bool
  */

  public function destroy(User $user)
  {
    return $user->usadmin;
  }

  public function create(User $user){
    return $user->usadmin;
  }

  public function update(User $user){
    return $user->usadmin;
  }
  public function checkPostPropietary(User $user ,  $post){
    return $user->id == $post->user_id;
  }
  public function isLogged(User $user){
    return $user != null;
  }

}
?>
