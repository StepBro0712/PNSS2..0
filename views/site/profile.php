<?php

use Src\Auth\Auth;

?>
<div class="Info">

    <div>

        <p>Добро пожаловать, <?= app()->auth::user()->full_name ?> </p>
        <?php if (Auth::user()->role === 'Админ'): ?>
            <p class="cn">Выполни свои прямые обязанности!!! Внеси новых пользователей с систему</p>
            <a class="btm1" href="<?= app()->route->getUrl('/signup') ?>">Создать пользователя</a>
        <?php endif; ?>
        <?php if (Auth::user()->role === 'Методист'): ?>
            <p class="cn">Выполни свои прямые обязанности!!! Напиши уже новую методичку</p>
            <a class="btm1" href="<?= app()->route->getUrl('/createDoc') ?>">Создать документ</a>
        <?php endif; ?>

    </div>
    <img src="../../../mvc/public/assets/image/книги.jpg" alt="Книги">
</div>
<div class="doc">
    <p>Документы</p>
    <div>

        <form method="post" class="search">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

            <?php if (Auth::user()->role === 'Методист'): ?>
                <a href="<?= app()->route->getUrl('/profile') ?>">Мои</a>
            <?php else: ?>

                <a href="<?= app()->route->getUrl('/profile') ?>">Все</a>
            <?php endif; ?>
            <?php if (Auth::user()->role !== 'Преподаватель'):?>
                <label for="status">Статус: </label>
                <select name="filters[status]">
                    <option value="default"> </option>
                    <option value="Новый">Новый</option>
                    <option value="Одобрено">Одобрено</option>
                    <option value="Неодобрено">Неодобрено</option>
                </select>
            <?php endif; ?>

            <label for="discription">Описание: </label>
            <select id="discription" name="filters[discription]">
                <option value="default"> </option>
                <option value="Лекция">Лекция</option>
                <option value="Практика">Практика</option>
                <option value="Презентация">Презентация</option>
            </select>

            <label for="subdivision">Подразделение: </label>
            <select name="filters[subdivision]">
                <option value="default"> </option>
                <?php foreach ($subdivisions as $subdivision) { ?>
                    <option value="<?= $subdivision->title ?>"><?= $subdivision->title ?></option>
                <?php } ?>
            </select>

            <label for="discipline">Дисциплина: </label>
            <select name="filters[discipline]">
                <option value="default"> </option>
                <?php foreach ($disciplines as $discipline) { ?>
                    <option value="<?= $discipline->title ?>"><?= $discipline->title ?></option>
                <?php } ?>
            </select>
            <button>Поиск</button>
        </form>
    </div>

    <div class="list">
        <ol>
            <?php if (Auth::user()->role === 'Методист'):
                foreach ($documents as $document){
                    if (app()->auth::user()->full_name === $document->author)
                        echo '<a href=' . app()->route->getUrl('/viewDoc') . '?id=' . $document->id . '>' . '<li>' . $document->title . '</li>'.'</a>';
                }
            endif;?>
            <?php if (Auth::user()->role === 'Админ'):
                foreach ($documents as $document){
                    echo '<a href=' . app()->route->getUrl('/viewDoc') . '?id=' . $document->id . '>' . '<li>' . $document->title . '</li>'.'</a>';
                }
            endif;?>
            <?php if (Auth::user()->role === 'Преподаватель'):
                foreach ($documents as $document){
                    if ($document->status === 'Одобрено')
                        echo '<a href=' . app()->route->getUrl('/viewDoc') . '?id=' . $document->id . '>' . '<li>' . $document->title . '</li>'.'</a>';
                }
            endif;?>
        </ol>
    </div>
