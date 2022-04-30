<?php require_once 'dbconnect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD İşlemleri</title>

</head>

<body>
    <?php

    $productsQuery = $db->prepare("SELECT * from products WHERE id=:id");
    $productsQuery->execute(['id' => $_GET['id']]);
    $product = $productsQuery->fetch(PDO::FETCH_ASSOC);


    ?>
    <h1>PDO düzenleme işlemleri</h1>
    <hr>
    <form action="<?php echo "updateProduct.php?id=" . $_GET['id'] ?>" method="POST">
        Ürün İsmi: <input type="text" name="name" value="<?php echo $product['name'] ?>"><br>
        Ürün Açıklaması: <input type="text" name="description" value="<?php echo $product['description'] ?>"><br>
        Ürün Fiyatı: <input type="number" name="price" min="0" step=".01" value="<?php echo $product['price'] ?>"><br>
        Ürünün Kategorisi
        <select name="category" id="category">
            <?php
            $categoriesQuery = $db->prepare("SELECT * from categories");
            $categoriesQuery->execute();
            while ($category = $categoriesQuery->fetch(PDO::FETCH_ASSOC)) {
                if ($category['id'] == $product['categoryId'])
                    echo "<option selected value='" . $category['id'] . "' name='category'>" . $category['name'] . "</option>";
                else
                    echo "<option value='" . $category['id'] . "' name='category'>" . $category['name'] . "</option>";;
            }
            ?>
        </select><br>
        <button type="submit" name="update">Kaydet</button>
    </form>


</body>

</html>