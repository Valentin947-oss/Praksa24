<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team and Statistics</title>
</head>
<body>
    <h2>Add Team and Statistics</h2>
    <form action="insert_team.php" method="post">
        <label for="team_name">Team Name:</label><br>
        <input type="text" id="team_name" name="team_name" required><br><br>
        
        <label for="games">Games Played:</label><br>
        <input type="number" id="games" name="games" required><br><br>
        
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