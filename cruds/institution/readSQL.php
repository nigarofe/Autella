<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    require_once $_SERVER['DOCUMENT_ROOT'] . '/database/dbConnect.php';
    $sql = "SELECT * FROM institution WHERE id=" . $id;
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) != 0) {
        $array = mysqli_fetch_array($result);
    } else {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/authentication/404.php';
        die();
    }
    $connection->close();
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/authentication/404.php';
    die();
}
