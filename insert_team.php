<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rezultati";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_team'])) {
        $team_name = $_POST['team_name'];
        $logoPath =  $_POST['logo_path'];
        $sql = "INSERT INTO Teams (team_name, logo_path) VALUES ('$team_name','$logoPath')";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("New team added successfully");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

   
    if (isset($_POST['edit_team'])) {
        $team_id = $_GET['team_id'];
        $team_name = $_POST['team_name'];
        

        $sql = "UPDATE Teams SET team_name = '$team_name' WHERE team_id = $team_id";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Team updated successfully");</script>';
        } else {
            echo "Error updating team: " . $conn->error;
        }
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['team_id'])) {
    $team_id = $_GET['team_id'];
    $sql = "DELETE FROM Teams WHERE team_id = $team_id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Team deleted successfully");</script>';
    } else {
        echo "Error deleting team: " . $conn->error;
    }
}


$sql = "SELECT team_id, team_name, logo_path FROM Teams";
$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
}

$conn->close();
?>

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

    <div class="container">
        <h2>Teams</h2>
        <table>
            <tr>
                <th>#</th>
                <th></th>
                <th>Team Name</th>
                <th>Actions</th>
            </tr>
            <?php
            $number = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$number}</td>";
                $logoPath = "Images/" . htmlspecialchars($row['logo_path']); 

if (file_exists($logoPath)) {
    echo "<td><img src='$logoPath' alt='Logo' style='width: 50px; height: 50px;'></td>";
} else {
    echo "<td><img src='Images/default_logo.png' alt='Default Logo' style='width: 50px; height: 50px;'></td>";
}
                echo "<td>{$row['team_name']}</td>";
                echo "<td>
                    <a href='insert_team.php?action=edit&team_id={$row['team_id']}' class='edit-button'>Edit</a>
                    <a href='insert_team.php?action=delete&team_id={$row['team_id']}' class='delete-button'>Delete</a>
                </td>";
                echo "</tr>";
                $number++;
            }
            ?>
        </table>
    </div>
    <div class="container">
    <h2><?php echo isset($_GET['action']) && $_GET['action'] == 'edit' ? 'Edit Team' : 'Add New Team'; ?></h2>
    <form action="insert_team.php<?php echo isset($_GET['team_id']) ? '?team_id=' . $_GET['team_id'] : ''; ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="team_name" placeholder="Enter team name" required
               value="<?php echo isset($_GET['action']) && $_GET['action'] == 'edit' ? htmlspecialchars($row['team_name'], ENT_QUOTES, 'UTF-8') : ''; ?>">
        <input type="text" name="logo_path" placeholder="Enter logo path" required
               value="<?php echo isset($_GET['action']) && $_GET['action'] == 'edit' ? htmlspecialchars($row['logo_path'], ENT_QUOTES, 'UTF-8') : ''; ?>">
        <?php if (isset($_GET['action']) && $_GET['action'] == 'edit'): ?>
            <button type="submit" name="edit_team">Add Team</button>
        <?php else: ?>
            <button type="submit" name="add_team">Add Team</button>
        <?php endif; ?>
    </form>
</div>
    <footer class="footer">
        All Rights Reserved - 2024 <br>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>
</body>
</html>