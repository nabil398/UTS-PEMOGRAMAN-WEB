<?php
// edit.php

require './config/db.php';

if(isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch product data from the database based on the ID
    $result = mysqli_query($db_connect, "SELECT * FROM products WHERE id = $productId");

    if(mysqli_num_rows($result) == 1) {
        $product = mysqli_fetch_assoc($result);

        // Display the form for editing
        // You can customize this part based on your specific requirements
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Produk</title>
        </head>
        <body>
            <h1>Edit Produk</h1>
            <form action="update.php" method="post">
                <input type="hidden" name="id" value="<?=$productId;?>">
                <!-- Add other form fields for editing -->
                <label for="name">Nama produk:</label>
                <input type="text" name="name" value="<?=$product['name'];?>" required>

                <label for="price">Harga:</label>
                <input type="text" name="price" value="<?=$product['price'];?>" required>

                <!-- Add other form fields as needed -->

                <button type="submit">Simpan Perubahan</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Produk tidak ditemukan.";
    }
} else {
    echo "ID produk tidak valid.";
}
?>
