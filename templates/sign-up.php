<nav class="nav">
    <ul class="nav__list container">
        <?php foreach ($product_category as $item): ?>
            <?= include_template('_nav.php', ['item' => $item]) ?>
        <?php endforeach; ?>
    </ul>
</nav>
<form class="form container  <?php $classname = isset($errors) ? "form--invalid" : ""; ?><?=$classname?>" action="sign-up.php" method="post" autocomplete="off" enctype="multipart/form-data"> <!-- form
    --invalid -->
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item <?php $classname = isset($errors['email']) ? "form__item--invalid" : ""; ?><?=$classname?>"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=getPostVal('email'); ?>">
        <span class="form__error">Введите e-mail</span>
    </div>
    <div class="form__item <?php $classname = isset($errors['password']) ? "form__item--invalid" : ""; ?><?=$classname?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?=getPostVal('password'); ?>">
        <span class="form__error">Введите пароль</span>
    </div>
    <div class="form__item <?php $classname = isset($errors['name']) ? "form__item--invalid" : ""; ?><?=$classname?>">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" type="text" name="name" placeholder="Введите имя" value="<?=getPostVal('name'); ?>">
        <span class="form__error">Введите имя</span>
    </div>
    <div class="form__item <?php $classname = isset($errors['contact']) ? "form__item--invalid" : ""; ?><?=$classname?>">
        <label for="message">Контактные данные <sup>*</sup></label>
        <textarea id="contact" name="contact" placeholder="Напишите как с вами связаться" ><?=getPostVal('contact'); ?></textarea>
        <span class="form__error">Напишите как с вами связаться</span>
    </div>
    <?php if (isset($errors)): ?>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="#">Уже есть аккаунт</a>
</form>
