<?php

session_start();

require_once 'parts/header.php';


foreach ($_SESSION['cart'] as $product) {
?>

<div class="cart">
    <img src="img/<? echo $product['img'] ?>" alt="<? echo $product['rus_name'] ?>">
    <div class="cart-descr">
    <? echo $product['rus_name'] ?> в количестве <? echo $product['quantity'] ?> шт на сумму <? echo $product['quantity'] * $product['price'] ?> рублей
    </div>
    <button type="submit">Удалить</button>
</div>

<?php } ?>
<hr>

</body>
</html>

