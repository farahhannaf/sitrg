<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class UserModel extends Model
{
    protected $fillable = ['name', 'email', 'password','kode_wil'];
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function setPasswordAttribute($value)
    {
        $this->attributes['password']=sha1($value);
    }
}