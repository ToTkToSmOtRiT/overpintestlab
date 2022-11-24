<?php

include "database.php";

if (isset($_POST["del"])) {
    //$conn = mysqli_connect("localhost", "root", "mypassword", "testdb3");
    // if (!$link) {
    //     die("Ошибка: " . mysqli_connect_error());
    // }
    $id = mysqli_real_escape_string($link, $_POST["del"]);
    $sql = "DELETE FROM `comments` WHERE `id` = '$id'";
    if (mysqli_query($link, $sql)) {
        header("Location: index.php");
    } else {
        echo "Ошибка: " . mysqli_error($link);
    }
}
