<?php

require_once 'parts/header.php';

if (isset($_GET['product'])) {
    $currentProduct = $_GET['product'];
    $product = $connect->query("SELECT * FROM products WHERE title='$currentProduct'");
    $product = $product->fetch(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // var_dump($product);
    // echo "<pre>";
}

?>

<div class="product-card">
    <a href="index.html">Вернуться на главную</a>

    <h2><? echo $product['rus_name'] ?> (<? echo $product['price'] ?> рублей)</h2>
    <div class="descr"><? echo $product['description'] ?></div>
    <img width="300" src="img/<? echo $product['img'] ?>" alt="<? echo $product['rus_name'] ?>">
    <button type="submit">Добавить в корзину</button>
</div>