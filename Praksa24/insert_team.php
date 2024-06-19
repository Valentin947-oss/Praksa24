<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team and Statistics</title>
</head>
<body>
    <h2>Add Team and Statistics</h2>
    <form action="insert_team_exec.php" method="post">
    <label for="team_name">Select Team:</label><br>
        <select id="team_name" name="team_name" required>
            <option value="">Man.City</option>
            <option value="">Liverpool </option>
            <option value="">Chelsea</option>
            <option value="">Man. Utd</option>
            <option value="">Tottenham</option>
            <option value="">Aston Villa</option>
            <option value="">Southampton</option>
            <option value="">Wolves</option>
            <option value="">Ipswich</option>
            <option value="">West Ham</option>
            <option value="">Crystal Palace</option>
            <option value="">Leicester</option>
            <option value="">Nott'm Forest</option>
            <option value="">Fulham</option>
            <option value="">Bournemount</option>
            <option value="">Arsenal</option>
            <option value="">Newcastle</option>
            <option value="">Brighton</option>
            <option value="">Everton</option>
            <option value="">Brentford</option>
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

            // Fetch teams from database
            $sql = "SELECT team_id, team_name FROM Teams";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['team_id'] . "'>" . $row['team_name'] . "</option>";
                }
            }

            $conn->close();
            ?>
        </select><br><br>
        
        <label for="round_number">Games Played:</label><br>
        <input type="number" id="round_number" name="games" required><br><br>
        
        <label for="wins">Wins:</label><br>
        <input type="number" id="wins" name="wins" required><br><br>
        
        <label for="losses">Losses:</label><br>
        <input type="number" id="losses" name="losses" required><br><br>
        
        <label for="draws">Draws:</label><br>
        <input type="number" id="draws" name="draws" required><br><br>
        
        <label for="goals_scored">Goals Scored:</label><br>
        <input type="number" id="goals_scored" name="goals_scored" required><br><br>
        
        <label for="goals_conceded">Goals Conceded:</label><br>
        <input type="number" id="goals_conceded" name="goals_conceded" required><br><br>
        
        <label for="goal_difference">Goal Difference:</label><br>
        <input type="number" id="goal_difference" name="goal_difference" required><br><br>
        
        <label for="points">Points:</label><br>
        <input type="number" id="points" name="points" required><br><br>
        
        <button type="submit">Add Team and Statistics</button>
    </form>
</body>
</html>