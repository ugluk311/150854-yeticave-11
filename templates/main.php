<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и
        горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($product_category as $item): ?>
            <?= include_template('_promo-item.php', ['item' => $item]) ?>
        <?php endforeach; ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($product_info as $key => $val): ?>
            <?= include_template('_lot.php', ['val' => $val]) ?>
        <?php endforeach; ?>
    </ul>
</section>