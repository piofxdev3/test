<?php
namespace App\Policies\User;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

     /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

     /**
     * Create a new policy instance.
     *
     * @return void
     */
     public function viewAny(User $user)
    {

        return $user->checkRole(['superadmin','superdeveloper','supermoderator','supermanager','agencyadmin','agencydeveloper','agencymoderator','agencymanager','clientadmin','clientdeveloper', 'clientmanager', 'clientmoderator','user']);
  
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
     public function view(User $user)
    {
        return $user->checkRole(['superadmin','superdeveloper','supermoderator','supermanager','agencyadmin','agencymoderator','agencymanager','agencydeveloper','clientadmin','clientdeveloper', 'clientmanager', 'clientmoderator','user']);

    }

    public function create(User $user)
    { 
        
        return $user->checkRole(['superadmin','superdeveloper','supermoderator','supermanager','agencyadmin','agencymoderator','agencymanager','agencydeveloper','clientadmin','clientdeveloper', 'clientmanager', 'clientmoderator']);
      

        return false;
    }

    /**
     * Determine if the given post can be created by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function edit(User $user,User $u2)
    {   
        
        if($user->id == $u2->id)
        {
            return true;
        }
        elseif($user->agency_id == $u2->agency_id && $user->checkRole(['agencyadmin']))
        {
            return true;
        }
        elseif($user->client_id == $u2->client_id  && $user->checkRole(['clientadmin','agencyadmin']))
        {
            return true;
        }
    
        
        return false;
    }

    /**
     * Determine if the given post can be updated by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return bool
     */
    public function update(User $user,User $u2)
    { 

        if($user->id == $u2->id)
        {
            return true;
        }
        elseif($user->agency_id == $u2->agency_id && $user->checkRole(['agencyadmin']))
        {
            return true;
        }
        elseif($user->client_id == $u2->client_id  && $user->checkRole(['clientadmin','agencyadmin']))
        {
            return true;
        }
    
      

        return false;
    }

    public function destroy(User $user,User $u2)
    { 

        if($user->id == $u2->id)
        {
            return true;
        }
        elseif($user->agency_id == $u2->agency_id && $user->checkRole(['agencyadmin']))
        {
            return true;
        }
        elseif($user->client_id == $u2->client_id  && $user->checkRole(['clientadmin','agencyadmin']))
        {
            return true;
        }
    
    }



    public function before(User $user, $ability)
    {
        if($user->isRole('superadmin'))
            return true;
    }
}
