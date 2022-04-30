<?php
try {
    $db = new PDO("mysql:host=localhost;port=8111;dbname=test;charset=utf8", 'root', '');
    // print "Veritabanı bağlantısı başarılı";
} catch (PDOException $e) {
    print "Hata!: " . $e->getMessage() . "<br/>";
    die();
}
