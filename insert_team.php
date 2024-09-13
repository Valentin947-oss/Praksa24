<?php
 $servername="localhost";
 $username="root";
 $password="";
 $database="rezultati";

$conn =new mysqli($servername, $username, $password, $database);


if (!$conn) {
die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_team'])) {
        $team_name = $_POST['team_name'];

        
        $sql = "INSERT INTO Teams (team_name) VALUES ('$team_name')";
        
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("New team added successfully");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['team_id'])) {
    $team_id = $_GET['team_id'];

    // Delete team od bazata
    $sql = "DELETE FROM Teams WHERE team_id = $team_id";
    
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Team deleted successfully");</script>';
    } else {
        echo "Error deleting team: " . $conn->error;
    }
}

$sql = "SELECT team_id, team_name FROM Teams";
$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
}
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
                        <a href=\"insert_team.php?action=edit&team_id={$row['team_id']}\" class=\"edit-button\">Edit</a>
                        <a href=\"insert_team.php?action=delete&team_id={$row['team_id']}\" class=\"delete-button\">Delete</a>
                      </td>";
                echo "</tr>";
                $number++;
            }
            ?>
        </table>
    </div>

    <div class="container">
        <h2>Add New Team</h2>
        <form action="insert_team.php" method="post">
            <input type="text" name="team_name" placeholder="Enter team name" required>
            <button type="submit" name="add_team">Add Team</button>
        </form>
    </div>
    <div class="container">
        <h2>Add New Team Logo</h2>
        <form action="insert_team.php" method="post">
            <input type="text" name="team_name" placeholder="Enter logo path" required>
            <button type="submit" name="add_team">Add Team Logo</button>
        </form>
    </div>

    <?php
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['team_id'])) {
    $team_id = $_GET['team_id'];

    

    
    $stmt = $conn->prepare("SELECT team_name FROM Teams WHERE team_id = ?");
    $stmt->bind_param("i", $team_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $team_name = $row['team_name'];
?>
        <div class="container">
            <h2>Edit Team</h2>
            <form action="insert_team.php?action=edit&team_id=<?php echo htmlspecialchars($team_id); ?>" method="post">
                <input type="text" name="team_name" value="<?php echo htmlspecialchars($team_name); ?>" required>
                <button type="submit" name="edit_team">Update Team</button>
            </form>
        </div>
<?php
    } else {
        echo "Team not found.";
    }

    
    $stmt->close();
} else {
    echo "Invalid request.";
}
?>



<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_team'])) {
    $team_id = $_GET['team_id'];
    $team_name = $_POST['team_name'];

    // Update team name vo bazata
    $sql = "UPDATE Teams SET team_name = '$team_name' WHERE team_id = $team_id";
    
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Team updated successfully");</script>';
    } else {
        echo "Error updating team: " . $conn->error;
    }
}

$conn->close();
?>
    
    <footer class="footer">
        All Rights Reserved - 2024 <br>
        
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>
    </body>
</html>