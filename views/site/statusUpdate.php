<h3 class="error"><?= $message ?? ''; ?></h3>
<form class="update" method="post">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <label for="status">Статус: </label>
    <select name="status">
        <option value="Новый">Новый</option>
        <option value="Одобрено">Одобрено</option>
        <option value="Неодобрено">Неодобрено</option>
    </select>
    <button>Изменить</button>
</form>
