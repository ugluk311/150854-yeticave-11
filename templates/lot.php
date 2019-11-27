<nav class="nav">
    <ul class="nav__list container">
        <?php foreach ($product_category as $item): ?>
            <?= include_template('_nav.php', ['item' => $item]) ?>
        <?php endforeach; ?>
    </ul>
</nav>
<section class="lot-item container">
    <?php $lot = $lot_info[0];?>
    <h2><?= $lot['title']; ?> </h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?= $lot['url_image']; ?>" width="730" height="548" alt="Сноуборд">
            </div>
            <p class="lot-item__category">Категория: <span><?= $lot['category']; ?></span></p>
            <p class="lot-item__description"><?= $lot['description']; ?></p>
        </div>
    </div>
</section>