<?php
use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello']);
Route::add(['GET','POST'], '/profile', [Controller\Profile::class, 'profile'])->middleware('auth','role:Админ|Методист|Преподаватель');
Route::add(['GET', 'POST'], '/signup', [Controller\SignUp::class, 'signup'])->middleware('auth','role:Админ');
Route::add(['GET', 'POST'], '/createDoc', [Controller\CreateDoc::class, 'createDoc'])->middleware('auth','role:Методист');
Route::add(['GET', 'POST'], '/login', [Controller\Login::class, 'login']);
Route::add('GET', '/logout', [Controller\Login::class, 'logout'])->middleware('auth');
Route::add('GET', '/viewDoc', [Controller\ViewDoc::class, 'viewDoc'])->middleware('auth', 'role:Админ|Методист|Преподаватель');
Route::add(['GET', 'POST'], '/statusUpdate', [Controller\StatusUpdate::class, 'statusUpdate'])->middleware('auth','role:Админ');
Route::add(['GET', 'POST'], '/updateDoc', [Controller\UpdateDoc::class, 'updateDoc'])->middleware('auth', 'role:Методист');

