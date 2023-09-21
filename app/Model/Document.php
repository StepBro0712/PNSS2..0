<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class Document extends Model //implements IdentityInterface

{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title',
        'discription',
        'status',
        'date_of_creation',
        'author',
        'subdivision',
        'discipline',
        'file'
    ];

    protected static function booted()
    {
        static::created(function ($document) {
            $document->save();
        });
    }
    //Выборка пользователя по первичному ключу
//    public function findIdentity(int $id)
//    {
//        return self::where('id', $id)->first();
//    }

    //Возврат первичного ключа
    public function getId(): int
    {
        return $this->id;
    }

//    //Возврат аутентифицированного пользователя
//    public function attemptIdentity(array $credentials)
//    {
//        return self::where(['login' => $credentials['login'],
//            'password' => md5($credentials['password'])])->first();
//    }
//
}