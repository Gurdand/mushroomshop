<?php

session_start();

require_once '../db/db.php';

if (isset($_POST['order'])) {

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);

    //$connect->query("INSERT INTO `order` (username, email, phone) VALUES ('$username', '$email', '$phone')");

    //Подготовленный запрос

    $stmt = $connect->prepare("INSERT INTO `order` (username, email, phone) VALUES (:username, :email, :phone)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->execute();


    $lastId = $connect->query("SELECT MAX(id) FROM `order` WHERE email='$email'");
    $lastId = $lastId->fetch(PDO::FETCH_ASSOC);

    $message = "<h2>Здравствуйте, $username! Ваш заказ под номером {$lastId['MAX(id)']} принят</h2>";
    $message .= "<h3>Состав заказа:</h3>";
    foreach ($_SESSION['cart'] as $product) {
        $message .= "<div>{$product['rus_name']} в количестве {$product['quantity']} шт.</div>";
    }

    $message .= "<p>Сумма заказа: {$_SESSION['totalPrice']} рублей.</p>";

    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    $subject = "Ваш заказ принят!";


    mail($email, $subject, $message, $headers);

    //Письмо администратору

    $adminEmail = 'admin@mushroomshop.com';
    $subject = "Новый заказ под номером {$lastId['MAX(id)']}";
    $message = "<h2>Заказ №{$lastId['MAX(id)']} от клиента $username!</h2>";
    $message .= "<h3>Состав заказа:</h3>";
    foreach ($_SESSION['cart'] as $product) {
        $message .= "<div>{$product['rus_name']} в количестве {$product['quantity']} шт.</div>";
    }
    $message .= "<p>Телефон: $phone Email: $email</p>";

    mail($adminEmail, $subject, $message, $headers);

    unset($_SESSION['totalPrice']);
    unset($_SESSION['totalQuantity']);
    unset($_SESSION['cart']);

    $_SESSION['order'] = $lastId;
}

header("Location: $_SERVER[HTTP_REFERER]");