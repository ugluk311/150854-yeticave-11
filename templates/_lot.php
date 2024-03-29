<li class="lots__item lot">
    <div class="lot__image">
        <img src="<?= $val['url_image'] ?>" width="350" height="260" alt="">
    </div>
    <div class="lot__info">
        <span class="lot__category"><?= htmlspecialchars($val['category']) ?></span>
        <h3 class="lot__title"><a class="text-link" href="/lot.php?id=<?=$val['id'] ?>"><?= htmlspecialchars($val['title']) ?></a>
        </h3>
        <div class="lot__state">
            <div class="lot__rate">
                <span class="lot__amount">Стартовая цена</span>
                <span class="lot__cost"><?= format_sum($val['first_price']) ?></span>
            </div>
            <div class="lot__timer timer <?php $date_finish = get_time_left($val['date_finish']);
            if ($date_finish[0] < 1) {
                print('timer--finishing');
            } ?>">
                <?= implode(' : ', $date_finish) ?>
            </div>
        </div>
    </div>
</li>