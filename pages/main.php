<?php
global $conn;
include("../includes/db.php");
session_start();

$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        .cart-button {
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        .cart-button img {
            width: 24px; /* Größe des Bildes anpassen */
            height: 24px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
</head>
<body>
    <?php include('../includes/navbar.php'); ?>
    <h2>HTML Table</h2>

    <table>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Order</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            printf("<tr>

                            <td>%s</td>
                            <td>€ %s</td>
                            <td><button class='cart-button'><span class='material-icons-outlined'>shopping_cart</span></button></td>
                           </tr>", $row["name"], $row["price"]);
        }
        ?>

        <tr>
            <td>Alfreds Futterkiste</td>
            <td>Maria Anders</td>
            <td>Germany</td>
        </tr>

    </table>

</body>
</html>
