<?php

namespace Controller;


use Model\Discipline;
use Model\Document;
use Model\Subdivision;
use Model\User;
use Src\Request;
use Src\View;

class Profile
{
    public function profile(Request $request): string
    {
        $disciplines = Discipline::all();
        $subdivisions = Subdivision::all();
        if ($request->method === "POST") {
            $filters = $request->filters;
            $filters = array_filter($filters, function ($item) {
                return $item!=='default';
            });
            $documents = Document::where($filters)->get();
        } else {
            $documents = Document::all();
        }

        $users = User::all();
        return (new View())->render('site.profile', ['users' => $users, 'documents' => $documents, 'disciplines' => $disciplines, 'subdivisions' => $subdivisions]);
    }
}