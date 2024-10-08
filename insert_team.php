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
        $logoPath = $_POST['logo_path'];
        $sql = "INSERT INTO Teams (team_name, logo_path) VALUES ('$team_name','$logoPath')";
        if ($conn->query($sql) === TRUE) {
           // echo '<script>alert("New team added successfully");</script>';
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    if (isset($_POST['edit_team'])) {
        $team_id = $_POST['team_id'];
        $team_name = $_POST['team_name'];
        $logoPath = $_POST['logo_path'];

        $sql = "UPDATE Teams SET team_name = '$team_name', logo_path = '$logoPath' WHERE team_id = $team_id";
        if ($conn->query($sql) === TRUE) {
            //echo '<script>alert("Team updated successfully");</script>';
        } else {
            //echo "Error updating team: " . $conn->error;
        }
    }
}
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['team_id'])) {
    $team_id = $_GET['team_id'];
    $sql = "DELETE FROM Teams WHERE team_id = $team_id";
    if ($conn->query($sql) === TRUE) {
        //echo '<script>alert("Team deleted successfully");</script>';
    } else {
        //echo "Error deleting team: " . $conn->error;
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
    <style>
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto;
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
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
        <button onclick="openAddModal()">Add New Team</button>
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
                echo "<td>
                    <span>{$row['team_name']}</span>
                </td>";
                echo "<td>
                    <a href='javascript:void(0);' class='edit-button' onclick='openModal({$row['team_id']}, \"" . htmlspecialchars($row['team_name'], ENT_QUOTES) . "\", \"" . htmlspecialchars($row['logo_path'], ENT_QUOTES) . "\");'>Edit</a>
                    <a href='insert_team.php?action=delete&team_id={$row['team_id']}' class='delete-button'>Delete</a>
                </td>";
                echo "</tr>";
                $number++;
            }
            ?>
        </table>
    </div>
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit Team</h2>
            <form id="editForm" action="insert_team.php" method="post">
                <input type="hidden" name="team_id" id="team_id">
                <input type="text" name="team_name" id="team_name" placeholder="Enter team name" required>
                <input type="text" name="logo_path" id="logo_path" placeholder="Enter logo path" required>
                <button type="submit" name="edit_team">Update Team</button>
            </form>
        </div>
    </div>
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddModal()">&times;</span>
            <h2>Add New Team</h2>
            <form id="addForm" action="insert_team.php" method="post">
                <input type="text" name="team_name" placeholder="Enter team name" required>
                <input type="text" name="logo_path" placeholder="Enter logo path" required>
                <button type="submit" name="add_team">Add Team</button>
            </form>
        </div>
    </div>
    <footer class="footer">
        All Rights Reserved - 2024 <br>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>
    <script>
        function openModal(teamId, teamName, logoPath) {
            document.getElementById('team_id').value = teamId;
            document.getElementById('team_name').value = teamName;
            document.getElementById('logo_path').value = logoPath;
            document.getElementById('editModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('editModal').style.display = "none";
        }

        function openAddModal() {
            document.getElementById('addModal').style.display = "block";
        }

        function closeAddModal() {
            document.getElementById('addModal').style.display = "none";
        }

        window.onclick = function(event) {
            const editModal = document.getElementById('editModal');
            const addModal = document.getElementById('addModal');
            if (event.target == editModal) {
                closeModal();
            }
            if (event.target == addModal) {
                closeAddModal();
            }
        }
    </script>
</body>
</html>
