<?php
$host = "localhost";
$dbname = "lanparty";
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $message = "Databaseverbinding succesvol!";
} catch (PDOException $e) {
    $message = "Verbinding mislukt: " . $e->getMessage();
}

echo "<script>console.log(" . json_encode($message) . ");</script>";
?>