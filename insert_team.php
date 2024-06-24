<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Team | Premier League</title>
    <link rel="icon" type="image/x-icon" href="Images/logobrowser.jpg">
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="style_insert.css">
    <script src="js.js"></script>
</head>

<body>
<img class="logo1" src="Images/logoANG.png" alt="">
<nav>
    
        <ul>
            <li><a href="ProektPremierLiga.html" class="nvy">Home</a></li>
            <li><a href="AboutUs.html" class="nvy">About Us</a></li>
            <li><a href="Contact.html" class="nvy">Contact</a></li>
            <li><a href="index.php" class="nvy">2024/25</a></li>
            <li><a href="insert_match.php" class="nvy">Insert Match</a></li>
            <li><a href="insert_team.php" class="nvy">Insert Team</a></li>
        </ul>
        
</nav>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rezultati";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT  team_name FROM Teams";
$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
}

?>
<div class="container">
    <h2>Teams</h2>
    </div>
    <table>
        <tr>
            <th>#</th>
            <th>Team Name</th>
            <th>Actions</th>
        </tr>
        <?php
        $number = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$number}</td>";
            echo "<td>{$row['team_name']}</td>";
            echo "<td>
                    <a href=\"edit_team.php?team_id\" class=\"edit-button\">Edit</a>
                    <a href=\"delete_team.php?team_id\" class=\"delete-button\">Delete</a>
                  </td>";
            echo "</tr>";
            $number++;
        }
        $conn->close();
        ?>
    </table>
    

    </form>
    <br>
</div>
    
    <footer class="footer">
        All Rights Reserved - 2024 <br>
        
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>
    </body>
</html>