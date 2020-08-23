<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;
use Validator;
use RoleUser;
use App\Role;
use DB;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [      
        'first_name','email', 'last_name','type','password','referral_by','phone','status','profile_picture','otp','api_token','referral_code','country'
    ];   
 
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
     return $this->belongsTo(Role::class,'role_id');
    } 

    public function wallet()
    {
     return $this->hasOne('App\Wallet');
    }       
      
    public function review()
    {
        return $this->hasMany('App\Review','review_to');  
    }
               
    public function vendorBooking()
    {
        return $this->hasMany('App\VendorBooking','vendor_id');          
    }
      
    public function document()
    {
        return $this->hasMany('App\Documents');  
    }
    
     public function address()
    {
        return $this->hasMany('App\Address');   
    }
    
      public function card()
    {
        return $this->hasMany('App\Card');        
    }
    
       public function bankAccount()
    { 
        return $this->hasMany('App\BankAccount');        
    }   
    
    public static function grouproles()
    {
     return Role::where(['status'=>0,'is_deleted'=>0])->where('name','!=','customer')->get();
    } 
  
    public static function getRoleById($roleId){

    }


    public function isMaster()
    {

        return (int)($this->type == 'superadmin');
    }

    public function isAdmin()
    {

        return (int)($this->type == 'admin');
    }

    public function isTechnician()
    {

        return (int)($this->type == 'technician');
    }

    public function getTechnicians()
    {

            return DB::table('users')->where(['type' =>  'technician', 'is_deleted' => 0,'status'=>0])->get();
      
    }


        /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles)
    {
    if (is_array($roles)) {
        return $this->hasAnyRole($roles) || 
                abort(401, 'This action is unauthorized.');
    }
    return $this->hasRole($roles) || 
            abort(401, 'This action is unauthorized.');
    }
    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles) 
    {
    return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
    return null !== $this->roles()->where('name', $role)->first();
    }

    protected function EditDataValidator(array $data, $id)
    {
        return Validator::make($data, [
            'email'             => 'required|email|max:255|unique:users,email,'.$id,
            'phone' => 'unique:users,phone,' . $id,
        ]);          
    }

        /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    } 

}
