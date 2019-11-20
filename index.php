<?php
date_default_timezone_set("Europe/Moscow");
require_once('helpers.php');
require_once('functions.php');
require_once 'init.php';

if (!$con_db) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => $error]);
} else {
    $sql = <<<SQL
SELECT title, first_price, url_image, date_finish, c.category,
IFNULL((SELECT price FROM bets WHERE lot_id = l.id ORDER BY date_post DESC LIMIT 1), l.first_price) AS last_price
FROM lots l
JOIN categories c ON l.category_id = c.id
WHERE date_finish > NOW()
ORDER BY date_add DESC;
SQL;
    $result = mysqli_query($con_db, $sql);

    if ($result) {
        $product_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con_db);
        $content = include_template('error.php', ['error' => $error]);
    }
}

$sql = 'SELECT `id`, `category`, `character_code` FROM categories';
$result = mysqli_query($con_db, $sql);
if ($result) {
    $product_category = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $error = mysqli_error($con_db);
    $content = include_template('error.php', ['error' => $error]);
}


$page_content = include_template('main.php', [
    'product_category' => $product_category,
    'product_info' => $product_info,

]);
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'product_category' => $product_category,
    'title' => 'Yeticave - Главная страница',
    'is_auth' => $is_auth,
    'user_name' => $user_name,

]);
print ($layout_content);