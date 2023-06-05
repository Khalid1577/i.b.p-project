<?php


$servername = "localhost";
$username = $_POST['username'];
$password = $_POST['password'];
$database = "mydatabase";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM mytable WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row["password"];

        if (password_verify($password, $storedPassword)) {
     
            echo "Login successful!";
        } else {

            echo "Invalid password!";
        }
    } else {
       
        echo "User not found!";
    }
}

$conn->close();
?>
