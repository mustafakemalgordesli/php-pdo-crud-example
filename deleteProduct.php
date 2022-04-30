<?php
require_once 'dbconnect.php';


if (isset($_GET['id'])) {
    $delete = $db->prepare("DELETE FROM products
    WHERE id=:id
    ");

    try {
        $result = $delete->execute(array(
            'id' => $_GET['id'],
        ));
        echo $result;
        Header("Location:index.php?delete=ok");
        exit;
    } catch (Exception $e) {
        echo $result;
        Header("Location:index.php?delete=false");
        exit;
    }
}
