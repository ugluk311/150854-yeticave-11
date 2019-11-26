<?php
date_default_timezone_set("Europe/Moscow");
require_once('helpers.php');
require_once('functions.php');
require_once('init.php');

if (!$con_db) {
    $error = mysqli_connect_error();
    $page_content = include_template('error.php', ['error' => $error]);
} else {
    $sql = 'SELECT `id`, `category`, `character_code` FROM categories';
    $result = mysqli_query($con_db, $sql);
    if ($result) {
        $product_category = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con_db);
        $page_content = include_template('error.php', ['error' => $error]);
    }
}

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT l.id, title, description, first_price, url_image, date_finish, c.category FROM lots l JOIN categories c ON l.category_id = c.id WHERE l.id = ? ";
    $result = mysqli_prepare($con_db, $sql);
    $statement = db_get_prepare_stmt($con_db, $sql, [$id]);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $lot_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $page_content = include_template('lot.php', [
        'product_category' => $product_category,
        'lot_info' => $lot_info,
    ]);
} else {
    http_response_code(404);
    $page_content = include_template('error.php', ['error' => $error]);
}


$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'product_category' => $product_category,
    'title' => 'Yeticave - Главная страница',
    'is_auth' => $is_auth,
    'user_name' => $user_name,

]);
print ($layout_content);