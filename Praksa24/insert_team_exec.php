
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
   
    
    $points = intval($_POST['points']);
    $round_number = intval($_POST['round_number']);
    $home_team_id = intval($_POST['home_team_id']);
    $away_team_id = intval($_POST['away_team_id']);
    $home_team_score = intval($_POST['home_team_score']);
    $away_team_score = intval($_POST['away_team_score']);
    $match_date = $_POST['match_date'];
    $match_time = $_POST['match_time'];

   
    $sql_teams = "INSERT INTO teams (team_name, points) VALUES ('$team_name')";
    if ($conn->query($sql_teams) === TRUE) {
        $team_id = $conn->insert_id;
        $sql_teams = "INSERT INTO statisticss ( points) VALUES ('$points')";
        if ($conn->query($sql_statistics) === TRUE) {
            
            $sql_matches = "INSERT INTO matches (round_number, home_team_id, away_team_id, home_team_score, away_team_score, match_date, match_time) 
                            VALUES ($round_number, $home_team_id, $away_team_id, $home_team_score, $away_team_score, '$match_date', '$match_time')";
            if ($conn->query($sql_matches) === TRUE) {
                echo "New record added successfully";
            } else {
                echo "Error inserting into Matches table: " . $conn->error;
            }
        } else {
            echo "Error inserting into Statistics table: " . $conn->error;
        }
    } else {
        echo "Error inserting into Teams table: " . $conn->error;
    }
}

$conn->close();
?>