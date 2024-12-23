<?php
// insecure/index.php
$host = 'localhost';
$dbname = 'test_db';
$username = 'root';
$password = 'Dublinbus47';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Getting user input from form
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // SQL Injection vulnerability: not using prepared statements
    $query = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
    $stmt = $conn->query($query);

    if ($stmt->rowCount() > 0) {
        echo "Login successful!";
    } else {
        echo "Invalid credentials.";
    }
}
?>

<form method="POST" action="index.php">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>