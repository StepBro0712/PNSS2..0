<h3 class="error"><?= $message ?? ''; ?></h3>
<?php
//var_dump($authors);
//?>
<form class="sign" method="post"  enctype="multipart/form-data">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label for="title">Название </br></label>
    <input type="text" name="title">


    <label for="discription">Описание</br></label>
    <select id="discription" name="discription">
        <option value="Лекция">Лекция</option>
        <option value="Практика">Практика</option>
        <option value="Презентация">Презентация</option>
    </select>


    <label for="status">Статус</br></label>
    <select id="status" name="status">
        <option value="Новый">Новый</option>
    </select>

    <label for="date_of_creation">Дата создания </br></label>
    <input type="date" name="date_of_creation">


    <label for="author">Автор</br></label>
    <select name="author">
        <?php foreach ($authors as $author) { ?>
            <option value="<?= $author->full_name ?>"><?= $author->full_name ?></option>
        <?php } ?>
    </select>


    <label for="subdivision">Подразделение</br></label>
    <select name="subdivision">
        <?php foreach ($subdivisions as $subdivision) { ?>
            <option value="<?= $subdivision->title ?>"><?= $subdivision->title ?></option>
        <?php } ?>
    </select>

    <label for="discipline">Дисциплина</br></label>
    <select name="discipline">
        <?php foreach ($disciplines as $discipline) { ?>

            <option value="<?= $discipline->title ?>"><?= $discipline->title ?></option>
        <?php } ?>
    </select>
    <label  for="file"> Документ </br></label>
    <input type="file" name="file">


    <button>Создать</button>
</form>

