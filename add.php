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
};


$sql = 'SELECT `id`, `category` FROM categories';
$result = mysqli_query($con_db, $sql);
$categories_id = [];
if ($result) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $categories_id = array_column($categories, 'id');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $required = ['title', 'category_id', 'description', 'first_price', 'bet_step', 'date_finish',];
    $errors = [];
    $rules = [
        'category_id' => function ($value) use ($categories_id) {
            return validateCategory($value, $categories_id);
        },
        'title' => function ($value) {
            return validateLength($value, 10, 200);
        },
        'description' => function ($value) {
            return validateLength($value, 10, 3000);
        },
        'first_price' => function ($value) {
            return validateInt($value);
        },
        'bet_step' => function ($value) {
            return validateInt($value);
        },
        'date_finish' => function ($value) {
            return validateDate($value);
        },
    ];
    $lot = filter_input_array(INPUT_POST, [
        'title' => FILTER_DEFAULT,
        'description' => FILTER_DEFAULT,
        'category_id' => FILTER_DEFAULT,
        'first_price' => FILTER_DEFAULT,
        'bet_step' => FILTER_DEFAULT,
        'date_finish' => FILTER_DEFAULT,
    ], true);
    foreach ($lot as $key => $value) {
        if (isset($rules[$key])) {
            $rule = $rules[$key];
            $errors[$key] = $rule($value);
        }

        if (in_array($key, $required) && empty($value)) {
            $errors[$key] = "Поле $key надо заполнить";
        }
    }
    $errors = array_filter($errors);

    if (!empty($_FILES['url_image']['name'])) {
        $tmp_name = $_FILES['url_image']['tmp_name'];
        $url_img = $_FILES['url_image']['name'];
        $filename = uniqid() . '.jpg';

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type !== "image/jpeg") {
            $errors['file'] = 'Загрузите картинку в формате JPG';
        } else {
            move_uploaded_file($tmp_name, 'uploads/' . $filename);
            $lot['url_image'] = 'uploads/' . $filename;
        }
    } else {
        $errors['file'] = 'Вы не загрузили файл';
    }
    if (count($errors)) {
        $page_content = include_template('add.php',
            ['lot' => $lot, 'errors' => $errors, 'product_category' => $product_category]);
    } else {
        $sql = 'INSERT INTO lots (date_add, title, description, category_id, first_price, bet_step, date_finish, url_image, user_id) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, 1)';

        $statement = db_get_prepare_stmt($con_db, $sql, $lot);
        $result = mysqli_stmt_execute($statement);
        if ($result) {
            $lot_id = mysqli_insert_id($con_db);

            header("Location: lot.php?id=" . $lot_id);
            die();
        } else {
            $error = mysqli_error($con_db);
            $page_content = include_template('error.php', ['error' => $error]);
        }
    }

} else {
    $page_content = include_template('add.php', ['product_category' => $product_category]);
}


$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'product_category' => $product_category,
    'title' => 'Yeticave - Добавить лот',
    'is_auth' => $is_auth,
    'user_name' => $user_name,

]);
print ($layout_content);