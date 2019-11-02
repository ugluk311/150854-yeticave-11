<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');


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