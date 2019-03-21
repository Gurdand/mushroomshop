<?php

    session_start();

    require_once 'db/db.php';

    $categories = $connect->query("SELECT * FROM categories");
    $categories = $categories->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // var_dump($categories);
    // echo "<pre>";

?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <ul>
        <li><a href="index.php">Главная</a></li>

        <? foreach ($categories as $catgory) { ?>

        <li><a href="index.php?category=<? echo $catgory['name']?>"><? echo $catgory['rus_name'] ?></a></li>

        <? } ?>

        <li><a href="cart.php">Корзина (Товаров: <? echo $_SESSION['totalQuantity'] ?> на сумму <? echo $_SESSION['totalPrice'] ?> руб)</a></li>
    </ul>
</nav>
<hr>