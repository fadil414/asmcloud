<?php
session_start();
require('dbcontroller.php');
$db_handle = new DBController();
if (isset($_GET['code'])) {
    $prodCode = filter_input(INPUT_GET, 'code');
    $prodImage = $db_handle->runQuery("SELECT image FROM tblproduct WHERE code = '{$prodCode}'");
    foreach($prodImage as $key => $value) {
        $prodImage = $prodImage[$key]['image'];
        if (unlink($prodImage)) {
            $delete_product = $db_handle->query("DELETE FROM tblproduct WHERE code = '{$prodCode}'");
            if ($delete_product) {
                unset($_SESSION['msg']);
                header('Location: index.php');
            } else {
                echo $db_handle->printError();
            }
        } else {
            $_SESSION['msg'] = 'An error occured!';
            header('Location: index.php');
        }
    }
} else {
    $_SESSION['msg'] = 'An error occured!';
    header('Location: index.php');
}
?>
