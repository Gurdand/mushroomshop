<?php

require_once 'db/db.php';

if (isset($_GET['product'])) {
    $currentProduct = $_GET['product'];
    $product = $connect->query("SELECT * FROM products WHERE title='$currentProduct'");
    $product = $product->fetch(PDO::FETCH_ASSOC);
    
    if (!$product) {
        header('Location: /index.php');
    }

}

require_once 'parts/header.php';

?>

<div class="product-card">
    <a href="index.php">Вернуться на главную</a>

    <h2><? echo $product['rus_name'] ?> (<? echo $product['price'] ?> рублей)</h2>
    <div class="descr"><? echo $product['description'] ?></div>
    <img width="300" src="img/<? echo $product['img'] ?>" alt="<? echo $product['rus_name'] ?>">
    <? require 'parts/add-form.php' ?>
</div>
