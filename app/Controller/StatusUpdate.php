<?php
namespace Controller;

use Model\Document;
use Src\Request;
use Src\View;
use Src\Validator\Validator;

class StatusUpdate{
    public function statusUpdate(Request $request): string
    {
        if ($request->method === 'GET') {
            $docs = Document::where('id', $request->id)->first();
        }
        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'status'=> ['required'],
            ], [
                'required' => 'Поле :field пусто',
            ]);
            if ($validator->fails()) {
                return new View('site.statusUpdate',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }
            $payload = $request->all();
//            var_dump($payload);
            $docs = Document::where('id', $request->id)->update($payload);
            app()->route->redirect('/viewDoc?id='.$request->id);
        }

        return (new View())->render('site.statusUpdate', ['docs' => $docs]);
    }
}