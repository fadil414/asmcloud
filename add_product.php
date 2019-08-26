<?php
session_start();
require('dbcontroller.php');
$prodName = filter_input(INPUT_POST, 'prodName');
$prodPrice = filter_input(INPUT_POST, 'prodPrice');
$prodImg = $_FILES['prodImg']['name'];
$temp = explode('.', $prodImg);
$prodImg = round(microtime(true)) . '.' . end($temp);
$prodCode = 'prod' . round(microtime(true));
$targetFile = $prodImg;
if (move_uploaded_file($_FILES['prodImg']['tmp_name'], $targetFile)) {
    $db_handle = new DBController();
//    $addProduct = $db_handle->add("INSERT INTO tblproduct SET name = :name, code = :code, image = :image, price = :price", $prodName, $prodCode, $targetFile, $prodPrice);
    $addProduct = $db_handle->add("INSERT INTO tblproduct (name, image, code, price) VALUES ('{$prodName}', '{$targetFile}', '{$prodCode}', $prodPrice)");
    if ($addProduct) {
        unset($_SESSION['msg']);
        header('Location: index.php');
    } else {
        var_dump($addProduct);
    }
} else {
    $_SESSION['msg'] = 'An error occured!';
    header('Location: index.php');
}
?>
