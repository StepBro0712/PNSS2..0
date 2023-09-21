
<h3 class="error"><?= $message ?? ''; ?></h3>

<form class="sign" method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label for="full_name">ФИО </br></label>
    <input type="text" name="full_name">

    <label for="sex">Пол</br></label>
    <select id="sex" name="sex">
        <option value="Мужской">Мужской</option>
        <option value="Женский">Женский</option>
    </select>

    <label for="date_of_birth">Дата рождения </br></label>
    <input type="date" name="date_of_birth">

    <label for="address">Адрес регистрации </br></label>
    <input type="text" name="address">

    <label for="role">Роль</br></label>
    <select name="role">
        <?php foreach ($roles as $role) { ?>
            <option value="<?= $role->title ?>"><?= $role->title ?></option>
        <?php } ?>
    </select>
    <label for="subdivision">Подразделение</br></label>
    <select name="subdivision">
        <?php foreach ($subdivisions as $subdivision) { ?>
            <option value="<?= $subdivision->title ?>"><?= $subdivision->title ?></option>
        <?php } ?>
    </select>

    <label for="login">Логин </br></label>
    <input type="text" name="login">

    <label for="password">Пароль </br></label>
    <input type="password" name="password">

    <button>Создать</button>
</form>
