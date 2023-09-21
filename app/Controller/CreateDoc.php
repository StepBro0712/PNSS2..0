<?php

namespace Controller;

use Model\Discipline;
use Model\Document;
use Src\Request;

use Model\Subdivision;
use Src\View;
use Model\User;
use Src\Validator\Validator;

class CreateDoc
{
    public function createDoc(Request $request): string
    {

        $authors = User::where('role', 'Методист')->get();
        $disciplines = Discipline::all();
        $subdivisions = Subdivision::all();
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'title' => ['required', 'cyrillic'],
                'discription' => ['required'],
                'status' => ['required'],
                'date_of_creation' => ['required'],
                'subdivision' => ['required'],
                'author' => ['required'],
                'discipline' => ['required'],
                'file' => ['required'],
            ], [
                'required' => 'Поле :field пусто',
                'cyrillic' => 'Поле :field должно состоять из кирилици',

            ]);

            if ($validator->fails()) {
                return new View('site.createDoc',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE), 'subdivisions' => $subdivisions, 'disciplines' => $disciplines, 'authors' => $authors]);
            }
            $path = '../public/assets/files/';
            $storage = new \Upload\Storage\FileSystem($path);
            $file = new \Upload\File('file', $storage);

            $new_filename = uniqid();
            $file->setName($new_filename);
            $file_name = $file->getNameWithExtension($file);
            try {
                // Success!
                $file->upload();
            } catch (\Exception $e) {
                // Fail!
                $errors = $file->getErrors();
            }

            if (Document::create([
                'title'=>$request->title,
                'discription'=>$request->discription,
                'status'=>$request->status,
                'date_of_creation'=>$request->date_of_creation,
                'author'=>$request->author,
                'subdivision'=>$request->subdivision,
                'discipline'=>$request->discipline,
                'file'=>$path.$file_name,
            ])) {
                app()->route->redirect('/profile');
            }
        }
        return new View('site.createDoc', ['subdivisions' => $subdivisions, 'disciplines' => $disciplines, 'authors' => $authors]);
    }
}
