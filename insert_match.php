<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Match | Premier League</title>
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
        <li>
            <div class="headerr">
                <form action="logout.php" method="post">
                    <button type="submit" class="logouttt">Logout</button>
                </form>
            </div>
        </li>
    </ul>    
</nav>
<div class="container">
    <h2>Add Match Result</h2>
    <form action="" method="POST">
        <label for="round_number">Round Number:</label><br>
        <input type="number" id="round_number" name="round_number" value="<?php echo getNextRoundNumber(); ?>" required><br><br>
        <label for="home_team">Home Team:</label><br>
        <select id="home_team" name="home_team" required>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "rezultati";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT team_id, team_name FROM teams";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $team_id = $row["team_id"];
                    $team_name = $row["team_name"];
                    echo "<option value=\"$team_id\">$team_name</option>";
                }
            } else {
                echo "<option value=\"\">No teams found</option>";
            }
            ?>
        </select><br><br>

        <label for="away_team">Away Team:</label><br>
        <select id="away_team" name="away_team" required>
            <?php
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $team_id = $row["team_id"];
                    $team_name = $row["team_name"];
                    echo "<option value=\"$team_id\">$team_name</option>";
                }
            } else {
                echo "<option value=\"\">No teams found</option>";
            }
            $conn->close();
            ?>
        </select><br><br>
        <label for="home_team_score">Home Team Score:</label><br>
        <input type="number" id="home_team_score" name="home_team_score" required><br><br>
        
        <label for="away_team_score">Away Team Score:</label><br>
        <input type="number" id="away_team_score" name="away_team_score" required><br><br>
        
        <label for="match_datetime">Match Date and Time:</label><br>
        <input type="datetime-local" id="match_datetime" name="match_datetime" required><br><br>
        
        <button type="submit" name="add_match">Add Match Result</button>
    </form>
    <?php
    function getNextRoundNumber() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "rezultati";
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql_count_matches = "SELECT COUNT(*) AS total_matches FROM matches";
        $result_count_matches = $conn->query($sql_count_matches);

        if ($result_count_matches->num_rows > 0) {
            $row = $result_count_matches->fetch_assoc();
            $total_matches = $row['total_matches'];

            $rounds_completed = floor($total_matches / 10); 
            $next_round_number = $rounds_completed + 5; 

            if ($next_round_number < 5) {
                $next_round_number = 5;
            }
        } else {
            $next_round_number = 5; 
        }
        $conn->close();
        return $next_round_number;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $round_number = $_POST['round_number'];
        $home_team_id = $_POST['home_team'];
        $away_team_id = $_POST['away_team'];
        $home_team_score = $_POST['home_team_score'];
        $away_team_score = $_POST['away_team_score'];
        $match_datetime = $_POST['match_datetime']; 

        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql_max_match_id = "SELECT MAX(match_id) AS max_id FROM matches";
        $result_max_id = $conn->query($sql_max_match_id);
    
        if ($result_max_id->num_rows > 0) {
            $row = $result_max_id->fetch_assoc();
            $next_match_id = $row['max_id'] + 1;
        } else {
            $next_match_id = 1; 
        }
        $sql_insert = "INSERT INTO matches (match_id, round_number, home_team_id, away_team_id, home_team_score, away_team_score, match_datetime)
                       VALUES ('$next_match_id', '$round_number', '$home_team_id', '$away_team_id', '$home_team_score', '$away_team_score', '$match_datetime')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "New record added successfully";

            
            updateTeamStats($conn, $home_team_id, $home_team_score, $away_team_score);
            updateTeamStats($conn, $away_team_id, $away_team_score, $home_team_score);
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }

        $conn->close();
    }
    function updateTeamStats($conn, $team_id, $team_score, $opponent_score) {
        $points = getPoints($team_score, $opponent_score);
        
        $wins = ($points == 3) ? 1 : 0;
        $draws = ($points == 1) ? 1 : 0;
        
        $sql_update = "UPDATE teams 
                       SET goals_scored = goals_scored + $team_score,
                           goals_conceded = goals_conceded + $opponent_score,
                           points = points + $points,
                           wins = wins + $wins,
                           draws = draws + $draws
                       WHERE team_id = '$team_id'";
    
        if ($conn->query($sql_update) !== TRUE) {
            echo "Error updating team stats: " . $conn->error;
        }
    }
    // Funkcioniranje na poenite
    function getPoints($team_score, $opponent_score) {
        if ($team_score > $opponent_score) {
            return 3; // pobeda
        } elseif ($team_score == $opponent_score) {
            return 1; // neresheno
        } else {
            return 0; // poraz
        }
    }
    ?>
</div>
<footer class="footer">
    All Rights Reserved - 2024 <br>
    <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
</footer>
</body>
</html>
