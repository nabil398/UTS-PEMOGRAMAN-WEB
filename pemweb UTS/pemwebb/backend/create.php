<?php

require './../config/db.php';

if (isset($_POST['submit'])) {
    global $db_connect;

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];

    // Check if the product with the same name and price already exists
    $existingProductQuery = "SELECT id FROM products WHERE name = '$name' AND price = '$price'";
    $existingProductResult = mysqli_query($db_connect, $existingProductQuery);

    if (mysqli_num_rows($existingProductResult) > 0) {
        echo "Produk dengan nama dan harga yang sama sudah ada.";
    } else {
        $randomFilename = time() . '-' . md5(rand()) . '-' . $image;

        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
        $uploadPath = $uploadDirectory . $randomFilename;

        // Check if the upload directory exists, if not, create it
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        $upload = move_uploaded_file($tempImage, $uploadPath);

        if ($upload) {
            mysqli_query($db_connect, "INSERT INTO products (name,price,image)
                        VALUES ('$name','$price','/upload/$randomFilename')");
            echo "berhasil upload";
        } else {
            echo "gagal upload";
        }
    }
}

?>
