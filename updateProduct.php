<?php
require_once 'dbconnect.php';

if (isset($_POST['update'])) {
    echo $_POST['name'];
    echo $_POST['price'];
    echo $_POST['description'];
    echo $_PUT['category'];
    echo $_GET['id'];


    $update = $db->prepare("UPDATE products SET
    name=:name,
    price=:price,
    description=:description,
    categoryId=:categoryId
    WHERE id=:id
    ");

    try {
        $result = $update->execute(array(
            'id' => $_GET['id'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'categoryId' => $_POST['category']
        ));
        echo $result;
        Header("Location:index.php?update=ok");
        exit;
    } catch (Exception $e) {
        Header("Location:index.php?update=false");
        exit;
    }
}
