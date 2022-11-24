<?php

$user = 'root';
$password = 'root';
$db = 'comments_section';
$host = 'localhost:3306';
// $port = 3306;

$link = mysqli_connect($host, $user, $password, $db);

if ($link == false)
{
    echo "Соединение не удалось";
}