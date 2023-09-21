<?php

namespace Controller;

use Src\Request;
use Model\Role;
use Model\Subdivision;
use Src\View;
use Model\User;
use Src\Validator\Validator;

class SignUp
{
    public function signup(Request $request): string
    {
        $roles = Role::all();
        $subdivisions = Subdivision::all();
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'full_name' => ['required', 'cyrillic'],
                'sex' => ['required'],
                'date_of_birth' => ['required'],
                'address' => ['required', 'cyrillic'],
                'role' => ['required'],
                'subdivision' => ['required'],
                'login' => ['required', 'unique:users,login', 'latin'],
                'password' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально',
                'cyrillic' => 'Поле :field должно состоять из кирилици',
                'latin' => 'Поле :field должго состоять из латиници'
            ]);

            if ($validator->fails()) {
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE), 'roles' => $roles, 'subdivisions' => $subdivisions]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }
        }
        return new View('site.signup', ['roles' => $roles, 'subdivisions' => $subdivisions]);
    }
}
