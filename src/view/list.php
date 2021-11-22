<?php session_unset(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Crud MVC</title>
</head>

<body>
    <h1>Crud MVC</h1>
    <p><a href="index.php">Home</a></p>
    <p><a href="view/insert.php">Add New</a></p>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tbody>";
        echo "<tr>";
        echo    "<td>id</td>";
        echo    "<td>first_name</td>";
        echo   " <td>last_name</td>";
        echo    "<td>email</td>";
        echo    "<td>update</td>";
        echo    "<td>delete</td>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>";

            echo "<a href='index.php?act=update&id=" . $row['id'] . "'>" . $row['id'] . "</a>";
            echo "</td>";
            echo "<td>";
            echo "<a href='index.php?act=delete&id=" . $row['id'] . "'>" . $row['id'] . "</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo   "</tbody>";
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else {
        echo "<p class='lead'><em>No records were found.</em></p>";
    }
    ?>
</body>

</html>