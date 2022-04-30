<?php require_once 'dbconnect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD İşlemleri</title>

    <style>
        table,
        th,
        td {
            border: 1px solid;
        }

        table {
            width: 100%;
        }

        td {
            text-align: center;
        }

        .btn {
            width: 100%;
            height: 100%;
        }
    </style>
</head>

<body>
    <h1>PDO kayıt işlemleri</h1>
    <hr>
    <form action="insertProduct.php" method="POST">
        Ürün İsmi: <input type="text" name="name"><br>
        Ürün Açıklaması: <input type="text" name="description"><br>
        Ürün Fiyatı: <input type="number" name="price" min="0" step=".01"><br>
        Ürünün Kategorisi <select name="category" id="category">
            <option value="" name="category" selected disabled hidden>Kategori</option>
            <?php
            $categoriesQuery = $db->prepare("SELECT * from categories");
            $categoriesQuery->execute();
            while ($category = $categoriesQuery->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $category['id'] . "' name='category'>" . $category['name'] . "</option>";
            }
            ?>
        </select><br>
        <button type="submit" name="save">Kaydet</button>
    </form>

    <?php
    if (isset($_GET['insert'])) {
        if ($_GET['insert'] == 'ok') {
            echo "Ürün eklendi";
        } else if ($_GET['durum']) {
            echo "Ürün eklenemedi";
        }
    }
    ?>

    <hr>


    <h4>Kayıtların Listelenmesi</h4>
    <table>
        <tr>
            <th>Name:</th>
            <th>Ürün Açıklaması:</th>
            <th>Ürün Fiyatı:</th>
            <th>Ürün Kategorisi</th>
        </tr>

        <?php
        $productsQuery = $db->prepare("SELECT * from products");
        $productsQuery->execute();
        while ($product = $productsQuery->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>";
            echo $product['name'];
            echo "</td>";
            echo "<td>";
            echo $product['description'];
            echo "</td>";
            echo "<td>";
            echo $product['price'];
            echo "</td>";
            echo "<td>";
            $categoriesQuery = $db->prepare("SELECT * from categories WHERE id=:id");
            $categoriesQuery->execute(['id' => $product['categoryId']]);
            $category = $categoriesQuery->fetch(PDO::FETCH_ASSOC);
            echo $category['name'];
            echo "</td>";
            echo "<td align='center'><a href='updateProductPage.php?id=" . $product['id'] . "'><button class='btn'>Güncelle</button></a></td>";
            echo "<td align='center'><a href='deleteProduct.php?id=" . $product['id'] . "'><button class='btn'>Sil</button></a></td>";
            echo "</tr>";
        }
        ?>

    </table>


</body>

</html>