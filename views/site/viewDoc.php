<?php

use Src\Auth\Auth;

?>
<div class="Info">

    <div>


        <p><?php
            foreach ($viewdocs as $viewdoc) {
                echo $viewdoc->title;
            }
            ?>
        </p>
        <p><?php
            foreach ($viewdocs as $viewdoc) {
                echo '<p class="stat">Описание: ' . $viewdoc->discription . '</p>';
                echo '<p class="stat">Статус: ' . $viewdoc->status . '</p>';
                echo '<p class="stat">Дата создания: ' . $viewdoc->date_of_creation . '</p>';
                echo '<p class="stat">Автор: ' . $viewdoc->author . '</p>';
                echo '<p class="stat">Подразделение: ' . $viewdoc->subdivision . '</p>';
                echo '<p class="stat">Дисциплина: ' . $viewdoc->discipline . '</p>';
            }
            ?>


    </div>
    <img src="../../../mvc/public/assets/image/книги.jpg" alt="Книги">
</div>
<div class="ttt">
    <?php
    foreach ($viewdocs as $viewdoc) {
        echo '<a target="_blank" href=mvc/'. $viewdoc->file . '> Скачать </a>';
    }
    ?>
    <?php if (Auth::user()->role === 'Админ'):
        foreach ($viewdocs as $viewdoc) {
            echo '<a href=' . app()->route->getUrl('/statusUpdate') . '?id=' . $viewdoc->id . '>'. 'Изменить статус' .'</a>';}?>
    <?php endif; ?>
    <?php if (Auth::user()->role === 'Методист'):
        foreach ($viewdocs as $viewdoc) {
            echo '<a href=' . app()->route->getUrl('/updateDoc') . '?id=' . $viewdoc->id . '>'. 'Изменить документ' .'</a>';}?>
    <?php endif; ?>

</div>
