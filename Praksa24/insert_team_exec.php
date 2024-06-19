<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "rezultati";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $team_name = $_POST['team_name'];
    $games = $_POST['round_number'];
    $wins = $_POST['wins'];
    $losses = $_POST['losses'];
    $draws = $_POST['draws'];
    $goals_scored = $_POST['goals_scored'];
    $goals_conceded = $_POST['goals_conceded'];
    $goal_difference = $_POST['goal_difference'];
    $points = $_POST['points'];

    // Insert data into Teams table
    $sql_team = "INSERT INTO Teams (team_name) VALUES ('$team_name')";

    if ($conn->query($sql_team) === TRUE) {
        $team_id = $conn->insert_id; // Get the auto-generated team_id

        // Calculate total goals scored and conceded
        $sql_goals_stats = "SELECT 
                                SUM(goals_scored) AS total_goals_scored,
                                SUM(goals_conceded) AS total_goals_conceded
                             FROM (
                                SELECT 
                                    SUM(CASE WHEN home_team_id = $team_id THEN home_team_score ELSE away_team_score END) AS goals_scored,
                                    SUM(CASE WHEN home_team_id = $team_id THEN away_team_score ELSE home_team_score END) AS goals_conceded
                                FROM Matches
                                WHERE home_team_id = $team_id
                                UNION ALL
                                SELECT 
                                    SUM(CASE WHEN away_team_id = $team_id THEN away_team_score ELSE home_team_score END) AS goals_scored,
                                    SUM(CASE WHEN away_team_id = $team_id THEN home_team_score ELSE away_team_score END) AS goals_conceded
                                FROM Matches
                                WHERE away_team_id = $team_id
                             ) AS combined_goals_stats";

        $result_goals_stats = $conn->query($sql_goals_stats);

        if ($result_goals_stats->num_rows > 0) {
            $row = $result_goals_stats->fetch_assoc();
            $total_goals_scored = $row['G_SCORED'];
            $total_goals_conceded = $row['G_CONCEDED'];
        } else {
            $total_goals_scored = 0;
            $total_goals_conceded = 0;
        }

        // Update goals_scored and goals_conceded in Teams table
        $sql_update_goals = "UPDATE Teams 
                             SET goals_scored = $total_goals_scored, goals_conceded = $total_goals_conceded 
                             WHERE team_id = $team_id";

        if ($conn->query($sql_update_goals) === TRUE) {
            echo "New team and statistics added successfully!";
        } else {
            echo "Error updating goals scored and conceded: " . $conn->error;
        }
    } else {
        echo "Error inserting team: " . $conn->error;
    }
}

$conn->close();
?>