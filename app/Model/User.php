<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'full_name',
        'sex',
        'date_of_birth',
        'address',
        'role',
        'subdivision',
        'login',
        'password',
        'token'
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $user->password = md5($user->password);
            $user->save();
        });
    }

    //Выборка пользователя по первичному ключу
    public function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }

    //Возврат первичного ключа
    public function getId(): int
    {
        return $this->id;
    }
    //Возврат аутентифицированного пользователя
    public function attemptIdentity(array $credentials)
    {
        return self::where(['login' => $credentials['login'],
            'password' =>md5($credentials['password'])])->first();
    }
    public function role(){
        return $this->belongsTo(Role::class, 'role', 'title' );

    }
    public function hasRole($roles): bool{
        return in_array($this->role, $roles);
    }
    public function getToken()
    {
        if(app()->auth::user()->token){
            $token = app()->auth::user()->token;
        }else{
            $token = null;
        }
        return $token;
    }
}
