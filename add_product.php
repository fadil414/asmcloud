<?php
session_start();
require('dbcontroller.php');
$prodName = filter_input(INPUT_POST, 'prodName');
$prodPrice = filter_input(INPUT_POST, 'prodPrice');
$prodImg = $_FILES['prodImg']['name'];
$temp = explode('.', $prodImg);
$prodImg = round(microtime(true)) . '.' . end($temp);
$prodCode = 'prod' . round(microtime(true));
$targetDir = 'product-images/';
$targetFile = $targetDir . $prodImg;
if (move_uploaded_file($_FILES['prodImg']['tmp_name'], $targetFile)) {
    $db_handle = new DBController();
    $addProduct = $db_handle->query("INSERT INTO tblproduct (name, code, image, price) VALUES ('{$prodName}', '{$prodCode}', 'product-images/{$prodImg}', ${prodPrice})");
    if ($addProduct) {
        unset($_SESSION['msg']);
        header('Location: index.php');
    } else {
        echo $db_handle->printError();
    }
} else {
    $_SESSION['msg'] = 'An error occured!';
    header('Location: index.php');
}
?>
