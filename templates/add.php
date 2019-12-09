<nav class="nav">
    <ul class="nav__list container">
        <nav class="nav">
            <ul class="nav__list container">
                <?php foreach ($product_category as $item): ?>
                    <?= include_template('_nav.php', ['item' => $item]) ?>
                <?php endforeach; ?>
            </ul>
        </nav>
    </ul>
</nav>


<form class="form form--add-lot container  <?php $classname = isset($errors) ? "form--invalid" : ""; ?><?=$classname?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <div class="form__item <?php $classname = isset($errors['title']) ? "form__item--invalid" : ""; ?><?=$classname?>"> <!-- form__item--invalid -->
            <label for="title">Наименование <sup>*</sup></label>
            <input id="title" type="text" name="title" placeholder="Введите наименование лота " value="<?=getPostVal('title'); ?>">
            <span class="form__error">Введите наименование лота</span>
        </div>
        <div class="form__item <?php $classname = isset($errors['category_id']) ? "form__item--invalid" : ""; ?><?=$classname?>">
            <label for="category_id">Категория <sup>*</sup></label>

            <select id="category_id" name="category_id">
                <option>Выберите категорию</option>
                <?php foreach ($product_category as $item): ?>
                    <option value="<?= $item['id']?>"  <?php if ($item['id'] == getPostVal('category_id')): ?>selected<?php endif; ?>><?=$item['category'] ?></option>
                <?php endforeach; ?>
            </select>
            <span class="form__error">Выберите категорию</span>
        </div>
    </div>
    <div class="form__item form__item--wide <?php $classname = isset($errors['description']) ? "form__item--invalid" : ""; ?><?=$classname?>">
        <label for="description">Описание <sup>*</sup></label>
        <textarea id="description" name="description" placeholder="Напишите описание лота"><?=getPostVal('description'); ?></textarea>
        <span class="form__error">Напишите описание лота</span>
    </div>
    <div class="form__item form__item--file <?php $classname = isset($errors['url_image']) ? "form__item--invalid" : ""; ?><?=$classname?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="url_image" name="url_image" value="">
            <label for="url_image">
                Добавить
            </label>
        </div>
    </div>
    <div class="form__container-three">
        <div class="form__item form__item--small <?php $classname = isset($errors['first_price']) ? "form__item--invalid" : ""; ?><?=$classname?>">
            <label for="first_price">Начальная цена <sup>*</sup></label>
            <input id="first_price" type="text" name="first_price" placeholder="0" value="<?=getPostVal('first_price'); ?>">
            <span class="form__error">Введите начальную цену</span>
        </div>
        <div class="form__item form__item--small <?php $classname = isset($errors['bet_step']) ? "form__item--invalid" : ""; ?><?=$classname?>">
            <label for="bet_step">Шаг ставки <sup>*</sup></label>
            <input id="bet_step" type="text" name="bet_step" placeholder="0" value="<?=getPostVal('bet_step'); ?>">
            <span class="form__error">Введите шаг ставки</span>
        </div>
        <div class="form__item <?php $classname = isset($errors['bet_step']) ? "form__item--invalid" : ""; ?><?=$classname?>">
            <label for="date_finish">Дата окончания торгов <sup>*</sup></label>
            <input class="form__input-date" id="date_finish" type="text" name="date_finish" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?=getPostVal('date_finish'); ?>">
            <span class="form__error">Введите дату завершения торгов</span>
        </div>
    </div>
    <?php if (isset($errors)): ?>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <ul>
        <?php foreach ($errors as $val): ?>
            <li><strong><?= $val; ?>:</strong></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <button type="submit" class="button">Добавить лот</button>
</form>