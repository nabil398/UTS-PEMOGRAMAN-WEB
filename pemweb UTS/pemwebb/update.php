<?php
// update.php

require './config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted via POST

    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['price'])) {
        // Retrieve data from the form
        $productId = $_POST['id'];
        $productName = $_POST['name'];
        $productPrice = $_POST['price'];

        // Update the product in the database
        $updateQuery = "UPDATE products SET name='$productName', price='$productPrice' WHERE id=$productId";
        $result = mysqli_query($db_connect, $updateQuery);

        if ($result) {
            // Redirect to show.php after successful update
            header("Location: show.php?id=$productId");
            exit();
        } else {
            echo "Gagal memperbarui produk.";
        }
    } else {
        echo "Data form tidak lengkap.";
    }
} else {
    echo "Metode HTTP tidak valid.";
}
?>
