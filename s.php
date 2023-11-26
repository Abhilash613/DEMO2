<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];


    echo "Username: $username <br>";
    echo "Email: $email <br>";
    echo "Phone: $phone <br>";

}
?>