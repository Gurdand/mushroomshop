<?php

require_once 'parts/header.php';

if (isset($_GET['category'])) {
    $currentCategory = $_GET['category'];
    $products = $connect->query("SELECT * FROM products WHERE category='$currentCategory'");
    $products = $products->fetchAll(PDO::FETCH_ASSOC);

    if (empty($products)) {
        $products = $connect->query("SELECT * FROM products");
        $products = $products->fetchAll(PDO::FETCH_ASSOC);
    }
    
} else {

    $products = $connect->query("SELECT * FROM products");
    $products = $products->fetchAll(PDO::FETCH_ASSOC);
}
?>

<div class="main">

    <? foreach ($products as $product) { ?>
    <div class="card">
        <a href="product.php?product=<? echo $product['title'] ?>">
            <img src="img/<? echo $product['img'] ?>" alt="<? echo $product['rus_name'] ?>">
        </a>
        <div class="label"><? echo $product['rus_name'] ?> (<? echo $product['price'] ?> рублей)</div>
        <form action="actions/add.php" method="POST">
            <input type="hidden" name="id" value="<? echo $product['id'] ?>">
            <input type="submit" value="Добавить в корзину">
        </form>
    </div>
    <? } ?>

</div>

</body>
</html>

