<h3 class="error"><?= $message ?? ''; ?></h3>
<form class="login" method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label for="login">Логин </br></label>
    <input type="text" name="login">
    <label for="password">Пароль </br></label>
    <input type="password" name="password">
    <button>Войти</button>
</form>
