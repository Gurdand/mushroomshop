<?php

session_start();

require_once 'parts/header.php';

if (isset($_SESSION['cart'])){

foreach ($_SESSION['cart'] as $product) {
?>

<div class="cart">
    <a href="product.php?product=<? echo $product['title'] ?>">
        <img src="img/<? echo $product['img'] ?>" alt="<? echo $product['rus_name'] ?>">
    </a>
    <div class="cart-descr">
    <? echo $product['rus_name'] ?> в количестве <? echo $product['quantity'] ?> шт на сумму <? echo $product['quantity'] * $product['price'] ?> рублей
    </div>
    <button type="submit">Удалить</button>
</div>

<?php } } else {?>
    <p style="text-align: center;">Корзина пуста.</p>
<?php } ?>

<hr>

</body>
</html>

