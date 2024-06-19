<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Team Form</title>
</head>
<body>
    <h2>Add a New Team</h2>
    <form action="add_team.php" method="post">
        <label for="team_name">Team Name:</label><br>
        <input type="text" id="team_name" name="team_name" required><br><br>
        
        <label for="team_city">City:</label><br>
        <input type="text" id="team_city" name="team_city" required><br><br>
        
        <label for="team_country">Country:</label><br>
        <input type="text" id="team_country" name="team_country" required><br><br>
        
        <button type="submit">Add Team</button>
    </form>
</body>
</html>