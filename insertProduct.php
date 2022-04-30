<?php
require_once 'dbconnect.php';

if (isset($_POST['save'])) {
    echo $_POST['name'];
    echo $_POST['price'];
    echo $_POST['description'];
    echo $_POST['category'];


    $save = $db->prepare("INSERT into products set 
    name=:name,
    price=:price,
    description=:description,
    categoryId=:categoryId
    ");

    try {
        $insert = $save->execute(array(
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'categoryId' => $_POST['category']
        ));
        Header("Location:index.php?insert=ok");
        exit;
    } catch (Exception $e) {
        Header("Location:index.php?insert=no");
        exit;
    }
}
