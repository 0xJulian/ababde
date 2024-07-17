<?php
global $conn;
include("includes/db.php");

session_start();

if (!isset($_SESSION["loggedIn"])) {
    $_SESSION["loggedIn"] = false;
}

if ($_SESSION["loggedIn"] === true) {
    header("Location: /pages/main.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $stmt = $conn->prepare("SELECT * FROM users WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION["username"] = $username;
        $_SESSION["loggedIn"] = true;
        header("Location: /pages/main.php");
        exit();
    } else {
        exit("Username or password is incorrect");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="main">
    <h1>Login</h1>
    <form action="index.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your Username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your Password" required>

        <div class="wrap">
            <button type="submit">Login</button>
        </div>
    </form>
    <p>Not registered?
        <a href="/pages/register.php" style="text-decoration: none;">Create an account</a>
    </p>
</div>
</body>
</html>
