<?php
date_default_timezone_set("Europe/Moscow");
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

$tpl_data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;
    $errors = [];

    $req_fields = ['email', 'password', 'name', 'contact'];

    foreach ($req_fields as $field) {
        if (empty($form[$field])) {
            $errors[$field] = "Не заполнено поле " . $field;
        }
    }

    $email_val = filter_var($form['email'], FILTER_VALIDATE_EMAIL);
    if (!$email_val){
       $errors['email'] = "Введите корректный email";
    }


    if (empty($errors)) {
        $email = mysqli_real_escape_string($con_db, $form['email']);
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $res = mysqli_query($con_db, $sql);

        if (mysqli_num_rows($res) > 0) {
            $errors[] = 'Пользователь с этим email уже зарегистрирован';
        }
        else {
            $password = password_hash($form['password'], PASSWORD_DEFAULT);

            $sql = 'INSERT INTO users (date_registration, email, name, password,  contact) VALUES (NOW(), ?, ?, ?, ?)';
            $stmt = db_get_prepare_stmt($con_db, $sql, [$form['email'], $form['name'], $password, $form['contact'],  ]);
            $res = mysqli_stmt_execute($stmt);
        }

        if ($res && empty($errors)) {
            header("Location: /enter.php");
            exit();
        }

    }
    $tpl_data['errors'] = $errors;
    $tpl_data['values'] = $form;
    $tpl_data['product_category'] = $product_category;
    $tpl_data['form'] = $form;
    $page_content = include_template('sign-up.php', $tpl_data);

}else {
    $error = mysqli_error($con_db);
    $page_content = include_template('error.php', ['error' => $error]);
}







$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'product_category' => $product_category,
    'title' => 'Yeticave - Добавить лот',
    'is_auth' => $is_auth,
    'user_name' => $user_name,

]);
print ($layout_content);