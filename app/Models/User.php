<?php
namespace App\Models;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'client_id',
        'role',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isRole($role){
        if ($this->role == $role)
            return 1;
        else
            return 0;
    }

    public function checkRole($roles){
        $user = $this;
        
        foreach($roles as $r){
            if($r == $user->role){
                return true;
            }
        }
        return false;
    }

    public function isAdmin(){
        if(\Auth::user())
        {
            if(\Auth::user()->role == 'superadmin' )
                return true;
            else if(\Auth::user()->role == 'agencyadmin' )
                return true;
            else if(\Auth::user()->role == 'clientadmin' )
                return true;

            return false;
        }
        
        return false;
    }

    public function getRecord($id){
        return $this->where("id", $id)->first();
    }
    
    public $sortable = [
        'name',
        ];
    
}
