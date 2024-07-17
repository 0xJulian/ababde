<?php
global $conn;
include "../includes/db.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST["username"]);
    $password_hash = password_hash(htmlspecialchars($_POST["password"]), PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name, password_hash) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password_hash);

    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
<div class="main">
    <h1>Register</h1>
    <form action="register.php" method="post">
        <label for="first">
            Username:
        </label>
        <input type="text"
               id="username"
               name="username"
               placeholder="Enter your Username" required>

        <label for="password">
            Password:
        </label>
        <input type="password"
               id="password"
               name="password"
               placeholder="Enter your Password" required>
        <label for="confirmPassword">
            Confirm Password:
        </label>
        <input type="password"
               id="confirmPassword"
               name="confirmPassword"
               placeholder="ReEnter your Password" required>
        <div class="wrap">
            <button type="submit"
                    onclick="solve()">
                Register
            </button>
        </div>
    </form>
    <p>Already registered?
        <a href="../index.php"
           style="text-decoration: none;">
            Login instead
        </a>
    </p>
</div>
</body>

</html>