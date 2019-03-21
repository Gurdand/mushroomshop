<?php

require_once 'parts/header.php';

if (isset($_SESSION['order'])) { ?>

    <p style="text-align: center;">Ваш заказ №<?php echo $_SESSION['order']['MAX(id)'] ?> принят.</p>
    <a href="index.php" class="back">Вернуться на главную</a>

    <?php
}

if (!count($_SESSION['cart']) == 0) {

foreach ($_SESSION['cart'] as $key=>$product) {
?>

<div class="cart">
    <a href="product.php?product=<? echo $product['title'] ?>">
        <img src="img/<? echo $product['img'] ?>" alt="<? echo $product['rus_name'] ?>">
    </a>
    <div class="cart-descr">
    <? echo $product['rus_name'] ?> в количестве <? echo $product['quantity'] ?> шт на сумму <? echo $product['quantity'] * $product['price'] ?> рублей
    </div>
    <form action="actions/delete.php" method="POST">
        <input type="hidden" name="delete" value="<? echo $key ?>">
        <input type="submit" value="Удалить">
    </form>
</div>

<?php } ?>

<hr/>

<form action="actions/mail.php" method="POST" class="order">
    <input type="text" name="username" required placeholder="Ваше имя">
    <input type="text" name="phone" required placeholder="Ваш телефон">
    <input type="email" name="email" required placeholder="Ваше email">
    <input type="submit" name="order" value="Отправить">
</form>

<?php } else {?>
    <p style="text-align: center;">Корзина пуста.</p>
<?php } ?>

<hr>

</body>
</html>

