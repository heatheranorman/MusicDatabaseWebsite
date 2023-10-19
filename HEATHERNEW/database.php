<?php
$dsn = 'mysql:host=localhost;dbname=music';
$username = 'root';
$password = 'sesame';
$options = [];
try {
    $connection = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
}
